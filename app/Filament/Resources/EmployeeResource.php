<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-m-briefcase';
    protected static ?string $navigationLabel = 'Employees';
    protected static ?string $pluralModelLabel = 'Employees';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('country_id')
                    ->relationship('country', 'name')
                    ->required(),
                Select::make('state_id')
                    ->relationship('state', 'name')
                    ->required(),
                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->required(),
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required(),
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('address')
                    ->required()
                    ->maxLength(500),
                TextInput::make('zip_code')
                    ->required()
                    ->maxLength(10),
                DatePicker::make('birth_date')
                    ->required(),
                DatePicker::make('date_hired')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->sortable(),
                TextColumn::make('first_name')
                ->searchable()
                ->sortable(),
                TextColumn::make('last_name')
                ->searchable()
                ->sortable(),
                TextColumn::make('country.name')
                ->label('Country')
                ->sortable(),
                TextColumn::make('state.name')
                ->label('State')
                ->sortable(),
                TextColumn::make('city.name')
                ->label('City')
                ->sortable(),
                TextColumn::make('department.name')
                ->label('Department')
                ->sortable(),
                TextColumn::make('zip_code')
                ->label('Kode pos'),
                TextColumn::make('birth_date')
                ->date(),
                TextColumn::make('date_hired')
                ->date(),
            ])
            ->filters([
                // add filters here
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateActions([
                CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
