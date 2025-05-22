<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getFormSchema(): array
    {
        return [
            Select::make('country_id')
                ->label('Country')
                ->options(Country::all()->pluck('name', 'id')->toArray())
                ->required()
                ->reactive()
                ->afterStateUpdated(fn(callable $set) => $set('state_id', null)),

            Select::make('state_id')
                ->label('State')
                ->required()
                ->options(function (callable $get) {
                    $country = Country::find($get('country_id'));
                    return $country ? $country->states->pluck('name', 'id') : State::all()->pluck('name', 'id');
                })
                ->reactive()
                ->afterStateUpdated(fn(callable $set) => $set('city_id', null)),

            Select::make('city_id')
                ->label('City')
                ->required()
                ->options(function (callable $get) {
                    $state = State::find($get('state_id'));
                    return $state ? $state->cities->pluck('name', 'id') : City::all()->pluck('name', 'id');
                })
                ->reactive(),

            Select::make('department_id')
                ->relationship('department', 'name')
                ->required(),

            TextInput::make('first_name')->required()->maxLength(255),
            TextInput::make('last_name')->required()->maxLength(255),
            TextInput::make('address')->required()->maxLength(255),
            TextInput::make('zip_code')->required()->maxLength(7),
            DatePicker::make('birth_date')->required(),
            DatePicker::make('date_hired')->required(),
        ];
    }
}
