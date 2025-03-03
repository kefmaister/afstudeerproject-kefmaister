<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogoResource\Pages;
use App\Models\Logo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LogoResource extends Resource
{
    protected static ?string $model = Logo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // File upload for the logo image.
                Forms\Components\FileUpload::make('path')
                    ->label('Logo')
                    ->image() // This tells Filament to expect an image and provides a preview.
                    ->directory('logos') // Optional: specify storage directory.
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Display the logo image.
                Tables\Columns\ImageColumn::make('path')
                    ->label('Logo'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime(),
            ])
            ->filters([
                // Add filters if needed.
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
            // Add relation managers if needed.
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListLogos::route('/'),
            'create' => Pages\CreateLogo::route('/create'),
            'edit'   => Pages\EditLogo::route('/{record}/edit'),
        ];
    }
}
