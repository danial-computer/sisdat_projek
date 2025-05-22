<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use App\Models\Country;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card as OverviewCard;

class EmployeeStatsOverview extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        $us = Country::where('country_code', 'US')->withCount('employees')->first();
        $uk = Country::where('country_code', 'UK')->withCount('employees')->first();

        return [
            OverviewCard::make('All Employees', Employee::count()),
            OverviewCard::make('UK Employees', $uk?->employees_count ?? 0),
            OverviewCard::make('US Employees', $us?->employees_count ?? 0),
        ];
    }
}
