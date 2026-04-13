<?php

namespace App\Filament\Admin\Resources\Surveys\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class SurveysTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('audience')
                    ->label('Público')
                    ->colors([
                        'primary' => 'docente',
                        'success' => 'discente',
                        'warning' => 'tecnico',
                        'danger' => 'gestao',
                        'gray' => 'comunidade_externa',
                        'info' => 'egresso',
                        'secondary' => 'transposicao',
                    ])
                    ->formatStateUsing(fn ($state) => $state->label()),

                TextColumn::make('year')
                    ->label('Ano')
                    ->sortable(),

                TextColumn::make('version')
                    ->label('Versão'),

                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                TextColumn::make('responses_count')
                    ->label('Respostas')
                    ->counts('responses')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('audience')
                    ->label('Público')
                    ->options([
                        'docente' => 'Docente',
                        'discente' => 'Discente',
                        'tecnico' => 'Técnico',
                        'gestao' => 'Gestão',
                        'comunidade_externa' => 'Comunidade Externa',
                        'egresso' => 'Egresso',
                        'transposicao' => 'Transposição',
                    ]),
                SelectFilter::make('is_active')
                    ->label('Ativo')
                    ->options([
                        true => 'Sim',
                        false => 'Não',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
