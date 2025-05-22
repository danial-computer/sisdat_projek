<?php

namespace App\Filament\Resources\StateResource\RelationManagers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';
    protected static ?string $recordTitleAttribute = 'first_name';

    public function form(Form $form):Form
    {
        return $form
            ->schema([
                Select::make('country_id')
                    ->label('Country')
                    ->options(Country::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('state_id', null)),

                Select::make('state_id')
                    ->label('State')
                    ->required()
                    ->options(
                        fn(callable $get) => ($country = Country::find($get('country_id')))
                        ? $country->states->pluck('name', 'id')
                        : State::all()->pluck('name', 'id')
                    )
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('city_id', null)),

                Select::make('city_id')
                    ->label('City')
                    ->required()
                    ->options(
                        fn(callable $get) => ($state = State::find($get('state_id')))
                        ? $state->cities->pluck('name', 'id')
                        : City::all()->pluck('name', 'id')
                    )
                    ->reactive(),

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
                    ->maxLength(255),

                TextInput::make('zip_code')
                    ->required()
                    ->maxLength(7),

                DatePicker::make('birth_date')->required(),
                DatePicker::make('date_hired')->required(),
            ]);
    }

    public function table(Table $table):Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('first_name')->sortable()->searchable(),
                TextColumn::make('last_name')->sortable()->searchable(),
                TextColumn::make('department.name')->sortable(),
                TextColumn::make('date_hired')->date(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
