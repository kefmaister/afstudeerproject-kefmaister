<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudyfieldResource\Pages;
use App\Models\Studyfield;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class StudyfieldResource extends Resource
{
    protected static ?string $model = Studyfield::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Studyfield Name')
                    ->required()
                    ->maxLength(255),

                Select::make('coordinator_id')
                    ->label('Coordinator')
                    ->relationship('coordinator.user', 'email') // Assumes coordinator -> user relationship
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Studyfield')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('coordinator.user.email')
                    ->label('Coordinator')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('students_count')
                    ->counts('students')
                    ->label('Aantal Studenten'),

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
        return [
            // You could define relation managers for students or stages here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudyfields::route('/'),
            'create' => Pages\CreateStudyfield::route('/create'),
            'edit' => Pages\EditStudyfield::route('/{record}/edit'),
        ];
    }
}
