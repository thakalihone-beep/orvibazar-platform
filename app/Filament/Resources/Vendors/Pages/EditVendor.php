<?php

namespace App\Filament\Resources\Vendors\Pages;

use App\Filament\Resources\Vendors\VendorResource;
use App\Mail\VendorApprovedNotification;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Override;

class EditVendor extends EditRecord
{
    protected static string $resource = VendorResource::class;

    protected ?string $approvalPassword = null;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    #[Override]
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $storedPassword = $this->record->user?->password;
        $hasBcryptPassword = is_string($storedPassword)
            && password_get_info($storedPassword)['algo'] === PASSWORD_BCRYPT;

        if ($data['status'] === 'approved' && ($this->record->status !== 'approved' || ! $hasBcryptPassword)) {
            $this->approvalPassword = (string) random_int(100000, 999999);
        }

        return $data;
    }

    protected function afterSave(): void
    {
        if ($this->approvalPassword === null) {
            return;
        }

        $this->record->user()->update([
            'password' => Hash::make($this->approvalPassword),
        ]);

        Mail::to($this->record->email)->send(
            new VendorApprovedNotification($this->record, $this->approvalPassword),
        );
    }
}
