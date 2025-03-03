<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StageResource\Pages;
use App\Filament\Resources\StageResource\RelationManagers;
use App\Models\Stage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class StageResource extends Resource
{
    protected static ?string $model = Stage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('company_id')
                    ->label('Company')
                    ->relationship('company', 'company_name') // Updated to use company_name
                    ->required(),

                Toggle::make('active')
                    ->label('Active')
                    ->required(),

                Select::make('logo_id')
                    ->label('Logo')
                    ->relationship('logo', 'path') // Updated to use path
                    ->required(),

                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('tasks')
                    ->label('Tasks')
                    ->required(),

                Select::make('studyfield_id')
                    ->label('Studyfield')
                    ->relationship('studyfield', 'name') // Assuming studyfield has a name attribute
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.company_name')->label('Company'), // Updated column
                TextColumn::make('logo.path')->label('Logo'), // Updated column
                TextColumn::make('title')->label('Title'),
                BooleanColumn::make('active')->label('Active'),
                TextColumn::make('studyfield.name')->label('Studyfield'),
            ])
            ->filters([
                // Define your filters here if needed
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
            // Define any relations you might want to manage here (e.g., proposals)
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListStages::route('/'),
            'create' => Pages\CreateStage::route('/create'),
            'edit'   => Pages\EditStage::route('/{record}/edit'),
        ];
    }
}
