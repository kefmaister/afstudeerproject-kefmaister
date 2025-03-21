<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProposalResource\Pages;
use App\Models\Proposal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('student_id')
                ->label('Student')
                ->relationship('student.user', 'lastname')
                ->searchable()
                ->required(),

            Forms\Components\Select::make('stage_id')
                ->label('Stage')
                ->relationship('stage', 'title')
                ->searchable()
                ->required(),

            Forms\Components\Textarea::make('tasks')
                ->label('Tasks')
                ->required(),

            Forms\Components\Textarea::make('motivation')
                ->label('Motivation')
                ->required(),

            Forms\Components\Select::make('coordinator_id')
                ->label('Coordinator')
                ->relationship('coordinator.user', 'lastname')
                ->searchable()
                ->required(),

            Forms\Components\Textarea::make('feedback')
                ->label('Feedback')
                ->nullable(),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'draft'    => 'Draft',
                    'pending'  => 'In afwachting',
                    'approved' => 'Goedgekeurd',
                    'denied'   => 'Afgewezen',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('student.user.lastname')
                ->label('Student')
                ->searchable()
                ->sortable(),

            TextColumn::make('stage.title')
                ->label('Stage')
                ->sortable()
                ->searchable(),

            TextColumn::make('coordinator.user.lastname')
                ->label('Coordinator')
                ->sortable()
                ->searchable(),

            TextColumn::make('tasks')->limit(40)->label('Tasks'),
            TextColumn::make('motivation')->limit(40)->label('Motivation'),

            TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'approved' => 'success',
                    'denied'   => 'danger',
                    'pending'  => 'warning',
                    'draft'    => 'gray',
                    default    => 'secondary',
                }),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProposals::route('/'),
            'create' => Pages\CreateProposal::route('/create'),
            'edit'   => Pages\EditProposal::route('/{record}/edit'),
        ];
    }
}
