<?php

namespace App\Filament\Vendor\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->label('Product Name')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('images')
                    ->default(null)
                    ->multiple()
                    ->columnSpanFull(),
                TagsInput::make('tags')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('NRs.'),
                TextInput::make('discount_price')
                    ->numeric()
                    ->default(null)
                    ->prefix('NRs.'),
                TextInput::make('stock_qty')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published', 'out_of_stock' => 'Out of stock'])
                    ->default('draft')
                    ->required(),
            ]);
    }
}
