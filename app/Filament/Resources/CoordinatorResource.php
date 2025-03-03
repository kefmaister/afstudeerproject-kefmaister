<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoordinatorResource\Pages;
use App\Models\Coordinator;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class CoordinatorResource extends Resource
{
    protected static ?string $model = Coordinator::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group'; // More appropriate icon
    protected static ?string $navigationGroup = 'Management'; // Optional group organization

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('firstname')
                    ->label('First Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('lastname')
                    ->label('Last Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->unique(Coordinator::class, 'email', ignoreRecord: true)
                    ->required()
                    ->maxLength(255),

                TextInput::make('password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->nullable()
                    ->maxLength(255),

                Select::make('studyfield_id')
                    ->label('Study Field')
                    ->relationship('studyfield', 'name')
                    ->required()
                    ->native(false), // Better UX for select
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('firstname')
                    ->label('First Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('lastname')
                    ->label('Last Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('studyfield.name')
                    ->label('Study Field')
                    ->sortable(),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoordinators::route('/'),
            'create' => Pages\CreateCoordinator::route('/create'),
            'edit' => Pages\EditCoordinator::route('/{record}/edit'),
        ];
    }
}
