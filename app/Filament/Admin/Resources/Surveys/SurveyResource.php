<?php

namespace App\Filament\Admin\Resources\Surveys;

use App\Filament\Admin\Resources\Surveys\Pages\CreateSurvey;
use App\Filament\Admin\Resources\Surveys\Pages\EditSurvey;
use App\Filament\Admin\Resources\Surveys\Pages\ListSurveys;
use App\Filament\Admin\Resources\Surveys\Schemas\SurveyForm;
use App\Filament\Admin\Resources\Surveys\Tables\SurveysTable;
use App\Models\Survey;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Enums\AudienceType;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class SurveyResource extends Resource
{
    protected static ?string $model = Survey::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->required(),

            Select::make('audience')
                ->options(
                    collect(AudienceType::cases())
                        ->mapWithKeys(fn ($case) => [
                            $case->value => $case->label()
                        ])
                )
                ->required(),

            TextInput::make('year')
                ->numeric()
                ->default(2026)
                ->required(),

            TextInput::make('version')
                ->numeric()
                ->default(1)
                ->required(),

            Toggle::make('is_active')
                ->label('Ativo'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return SurveysTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveys::route('/'),
            'create' => CreateSurvey::route('/create'),
            'edit' => EditSurvey::route('/{record}/edit'),
        ];
    }
}
