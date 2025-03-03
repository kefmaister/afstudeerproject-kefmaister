<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProposalResource\Pages;
use App\Models\Proposal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Select the stage for the proposal
                Forms\Components\Select::make('stage_id')
                    ->relationship('stage', 'id') // assuming Stage has a "name" attribute
                    ->required(),

                // Tasks as a textarea
                Forms\Components\Textarea::make('tasks')
                    ->label('Tasks')
                    ->required(),

                // Motivation as a textarea
                Forms\Components\Textarea::make('motivation')
                    ->label('Motivation')
                    ->required(),

                // Coordinator select field
                Forms\Components\Select::make('coordinator_id')
                    ->relationship('coordinator', 'lastname')
                    ->required(),

                // Feedback as a textarea
                Forms\Components\Textarea::make('feedback')
                    ->label('Feedback')
                    ->required(),

                // Status field (e.g., a select with options for approved/denied)
                Forms\Components\Select::make('status')
                    ->options([
                        0 => 'Denied',
                        1 => 'Approved',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('stage.id')->label('Stage_id')->sortable()->searchable(),
                TextColumn::make('coordinator.lastname')->label('Coordinator')->sortable()->searchable(),
                TextColumn::make('tasks')->limit(50)->sortable()->searchable(),
                TextColumn::make('motivation')->limit(50)->sortable()->searchable(),
                TextColumn::make('status')->label('Status')->sortable(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relation managers if needed
        ];
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
