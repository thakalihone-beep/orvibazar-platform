<?php

namespace App\Filament\Resources\Vendors\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VendorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('shop_name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('contact')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('pan_no')
                    ->required(),
                TextInput::make('logo')
                    ->default(null),
                TextInput::make('banner')
                    ->default(null),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'suspended' => 'Suspended',
                    ])
                    ->default('pending')
                    ->required(),
                TextInput::make('commission_rate')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                DateTimePicker::make('approved_at'),
            ]);
    }
}
