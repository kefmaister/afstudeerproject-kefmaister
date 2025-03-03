<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CvResource\Pages;
use App\Models\Cv;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class CvResource extends Resource
{
    protected static ?string $model = Cv::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Optional: if you want to associate the CV with a student,
                // ensure your database/migration has a student_id column.
                Select::make('student_id')
                    ->label('Student')
                    ->relationship('student', 'lastname') // Assumes Student model has a "name" attribute.
                    ->searchable()
                    ->required(),

                // File upload field for the CV file.
                FileUpload::make('file')
                    ->label('CV File')
                    ->required(),

                // Textarea for feedback.
                Textarea::make('feedback')
                    ->label('Feedback')
                    ->rows(4)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('file')->label('File'),
                TextColumn::make('feedback')
                    ->label('Feedback')
                    ->limit(50),
                TextColumn::make('student.lastname')
                    ->label('Student'),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime(),
            ])
            ->filters([
                // Add filters here if needed.
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
            // Define any relation managers if needed.
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCvs::route('/'),
            'create' => Pages\CreateCv::route('/create'),
            'edit'   => Pages\EditCv::route('/{record}/edit'),
        ];
    }
}
