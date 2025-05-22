<?php

namespace App\Filament\Resources\CityResource\Pages;

use App\Filament\Resources\CityResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;

class ListCities extends ListRecords
{
    protected static string $resource = CityResource::class;

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('state.name')->sortable(),
            TextColumn::make('created_at')->dateTime(),
        ];
    }
}
