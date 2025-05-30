<?php

namespace App\Filament\Resources\CountryResource\Pages;

use App\Filament\Resources\CountryResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\TextInput;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('country_code')
                ->label('Code')
                ->required()
                ->maxLength(3),

            TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),
        ];
    }
}
