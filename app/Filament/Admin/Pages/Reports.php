<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use App\Models\Survey;

class Reports extends Page
{
    protected static ?int $navigationSort = 2; // Abaixo de Surveys (que é 1)

    public function getTitle(): string
    {
        return 'Relatórios';
    }

    public function getView(): string
    {
        return 'filament.admin.reports';
    }

    protected function getViewData(): array
    {
        return [
            'surveys' => Survey::query()
                ->withCount('responses')
                ->withMax('responses', 'created_at')
                ->orderBy('year', 'desc')
                ->orderBy('name')
                ->get(),
        ];
    }
}