<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\StateResource\Pages;
use Filament\Forms\Components\Select;
use App\Filament\Resources\StateResource\RelationManagers\CitiesRelationManager;
use App\Filament\Resources\StateResource\RelationManagers\EmployeesRelationManager;
use App\Models\State;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;

use function Laravel\Prompts\select;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'heroicon-m-building-office';
    protected static ?string $navigationGroup = 'System Management';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('country_id')
                    ->relationship('country', 'name')
                    ->required(),
                TextInput::make('name')
                    ->label('State Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }


    public static function table(Table $Table): Table
    {
        return $Table
            ->columns([
                TextColumn::make('name')
                    ->label('State Name')
                    ->sortable()
                    ->searchable(),
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
        ;
    }
    public static function getRelations(): array
    {
        return [
            EmployeesRelationManager::class,
            CitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }
}
