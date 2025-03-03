<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('firstname')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('lastname')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(Student::class, 'email', ignoreRecord: true)
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->nullable()
                    ->maxLength(255),

                Forms\Components\Select::make('class')
                    ->options([
                        'A' => 'Class A',
                        'B' => 'Class B',
                        'C' => 'Class C',
                    ])
                    ->required(),

                Forms\Components\Select::make('studyfield_id')
                    ->label('Study Field')
                    ->relationship('studyfield', 'name')
                    ->required()
                    ->native(false),

                // Updated year selection with academic years
                Forms\Components\Select::make('year')
                    ->options([
                        '2023' => '2023 (Start Year)',
                        '2024' => '2024',
                        '2025' => '2025 (Graduation Year)',
                    ])
                    ->required(),

                Forms\Components\Select::make('proposal_id')
                    ->label('Proposal')
                    ->relationship('proposal', 'title')
                    ->nullable()
                    ->native(false),

                Forms\Components\Select::make('cv_id')
                    ->label('CV')
                    ->relationship('cv', 'name')
                    ->nullable()
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('firstname')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('lastname')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('class')
                    ->sortable(),

                Tables\Columns\TextColumn::make('year')
                    ->sortable()
                    ->label('Academic Year'),

                Tables\Columns\TextColumn::make('studyfield.name')
                    ->label('Study Field')
                    ->sortable(),

                Tables\Columns\TextColumn::make('proposal.title')
                    ->label('Proposal')
                    ->sortable(),

                Tables\Columns\TextColumn::make('cv.name')
                    ->label('CV')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('studyfield')
                    ->relationship('studyfield', 'name'),

                // Updated year filter with academic years
                Tables\Filters\SelectFilter::make('year')
                    ->options([
                        '2023' => '2023',
                        '2024' => '2024',
                        '2025' => '2025',
                    ])
                    ->label('Academic Year'),
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

    // ... rest of the resource remains the same

public static function getRelations(): array
{
    return [
        //
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
