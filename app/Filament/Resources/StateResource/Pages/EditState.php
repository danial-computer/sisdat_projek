<?php

namespace App\Filament\Resources\StateResource\Pages;

use App\Filament\Resources\StateResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class EditState extends EditRecord
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
