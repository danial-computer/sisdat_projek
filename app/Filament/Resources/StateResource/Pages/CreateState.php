<?php

namespace App\Filament\Resources\StateResource\Pages;

use App\Filament\Resources\StateResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class CreateState extends CreateRecord
{
    protected static string $resource = StateResource::class;

    protected function getFormSchema(): array
    {
        return [
            Select::make('country_id')
                ->relationship('country', 'name')
                ->required(),
            TextInput::make('name')
                ->required()
                ->maxLength(255),
        ];
    }
}
