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
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class CvResource extends Resource
{
    protected static ?string $model = Cv::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('student_id')
                ->label('Student')
                ->relationship('student.user', 'lastname')
                ->searchable()
                ->required(),

            FileUpload::make('file')
                ->label('CV Bestand')
                ->directory('cvs')
                ->preserveFilenames()
                ->acceptedFileTypes(['application/pdf'])
                ->required(),

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
                TextColumn::make('file')
                    ->label('CV')
                    ->url(fn ($record) => asset('storage/' . $record->file))
                    ->openUrlInNewTab()
                    ->searchable(),

                TextColumn::make('feedback')
                    ->label('Feedback')
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('student.user.fullname')
                    ->label('Student')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Aangemaakt')
                    ->dateTime(),

                TextColumn::make('updated_at')
                    ->label('Bijgewerkt')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index'  => Pages\ListCvs::route('/'),
            'create' => Pages\CreateCv::route('/create'),
            'edit'   => Pages\EditCv::route('/{record}/edit'),
        ];
    }
}
