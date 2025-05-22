<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

use App\Filament\Resources\DepartmentResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\TextInput;

class EditDepartment extends EditRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
        ];
    }
}
