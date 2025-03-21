<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoordinatorResource\Pages;
use App\Models\Coordinator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Hash;

class CoordinatorResource extends Resource
{
    protected static ?string $model = Coordinator::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('User Information')
                ->relationship('user')
                ->schema([
                    TextInput::make('firstname')
                        ->label('First Name')
                        ->required(),

                    TextInput::make('lastname')
                        ->label('Last Name')
                        ->required(),

                    TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required(),

                    TextInput::make('password')
                        ->label('Password')
                        ->password()
                        ->dehydrated(fn ($state) => filled($state))
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->required(fn (string $context): bool => $context === 'create')
                        ->nullable(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.firstname')->label('First Name')->sortable()->searchable(),
                TextColumn::make('user.lastname')->label('Last Name')->sortable()->searchable(),
                TextColumn::make('user.email')->label('Email')->sortable()->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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
