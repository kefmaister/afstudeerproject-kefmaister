<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->label('User')
                ->relationship('user', 'email')
                ->searchable()
                ->required(),

            Select::make('class')
                ->options([
                    'A' => 'Class A',
                    'B' => 'Class B',
                    'C' => 'Class C',
                ])
                ->required(),

            Select::make('studyfield_id')
                ->label('Study Field')
                ->relationship('studyfield', 'name')
                ->searchable()
                ->required(),

            Select::make('year')
                ->label('Graduation Year')
                ->options([
                    '2022' => '2022',
                    '2023' => '2023',
                    '2024' => '2024',
                    '2025' => '2025',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.firstname')->label('First Name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('user.lastname')->label('Last Name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('user.email')->label('Email')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('class')->sortable(),
            Tables\Columns\TextColumn::make('year')->label('Graduation Year')->sortable(),
            Tables\Columns\TextColumn::make('studyfield.name')->label('Study Field')->sortable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('studyfield')->relationship('studyfield', 'name'),
            Tables\Filters\SelectFilter::make('year')->options([
                '2022' => '2022',
                '2023' => '2023',
                '2024' => '2024',
                '2025' => '2025',
            ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            // You could add CVs or Proposals as relation managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
