<?php

namespace App\Filament\Resources\CountryResource\Pages;

use App\Filament\Resources\CountryResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\TextInput;

class EditCountry extends EditRecord
{
    protected static string $resource = CountryResource::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('country_code')
                ->label('Country Code')
                ->required()
                ->maxLength(5),

            TextInput::make('name')
                ->label('Country Name')
                ->required()
                ->maxLength(255),
        ];
    }
}
