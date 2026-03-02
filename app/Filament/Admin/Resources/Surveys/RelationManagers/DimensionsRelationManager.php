<?php

namespace App\Filament\Admin\Resources\Surveys\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Filament\Forms\Components\Textarea;

class DimensionsRelationManager extends RelationManager
{
    protected static string $relationship = 'dimensions';

    public function form(Schema $schema): Schema
    {
        return $schema
        ->schema([
            TextInput::make('name')
                ->required(),

            Textarea::make('description')
                ->rows(3),

            TextInput::make('order')
                ->numeric()
                ->default(1)
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('order')
                ->sortable(),

            TextColumn::make('name')
                ->searchable(),
        ]);
    }
}
