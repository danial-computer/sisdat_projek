<?php

namespace App\Filament\Resources\StateResource\Pages;

use App\Filament\Resources\StateResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;

class ListStates extends ListRecords
{
    protected static string $resource = StateResource::class;

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('country.name')->sortable(),
            TextColumn::make('created_at')->dateTime(),
        ];
    }
}
