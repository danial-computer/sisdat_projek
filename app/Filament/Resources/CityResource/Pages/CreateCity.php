<?php

namespace App\Filament\Resources\CityResource\Pages;

use App\Filament\Resources\CityResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class CreateCity extends CreateRecord
{
    protected static string $resource = CityResource::class;

    protected function getFormSchema(): array
    {
        return [
            Select::make('state_id')
                ->relationship('state', 'name')
                ->required(),

            TextInput::make('name')
                ->required()
                ->maxLength(255),
        ];
    }
}
