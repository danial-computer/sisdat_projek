<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->sortable(),
            TextColumn::make('first_name')->sortable()->searchable(),
            TextColumn::make('last_name')->sortable()->searchable(),
            TextColumn::make('department.name')->sortable(),
            TextColumn::make('date_hired')->date(),
            TextColumn::make('created_at')->dateTime(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('department')->relationship('department', 'name'),
        ];
    }
}
