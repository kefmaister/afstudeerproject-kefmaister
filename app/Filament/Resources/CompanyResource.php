<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\Toggle;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Management';


    public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('company_name')
                ->label('Company Name')
                ->required()
                ->maxLength(255),

            TextInput::make('street')
                ->label('Street')
                ->required()
                ->maxLength(255),

            TextInput::make('streetNr')
                ->label('Street Number')
                ->required()
                ->numeric(),

            TextInput::make('town')
                ->label('Town')
                ->required()
                ->maxLength(255),

            TextInput::make('zip')
                ->label('ZIP Code')
                ->required()
                ->maxLength(255),

            Toggle::make('accepted')
                ->label('Accepted')
                ->required(),

            TextInput::make('max_students')
                ->label('Max Students')
                ->required()
                ->numeric(),

            TextInput::make('student_amount')
                ->label('Student Amount')
                ->required()
                ->numeric(),

            TextInput::make('logo')
                ->label('Logo Path')
                ->required(),
        ]);
}


public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('company_name')->label('Company Name')->sortable()->searchable(),
            TextColumn::make('street')->label('Street')->sortable()->searchable(),
            TextColumn::make('streetNr')->label('Street Number')->sortable()->searchable(),
            TextColumn::make('town')->label('Town')->sortable()->searchable(),
            TextColumn::make('zip')->label('ZIP Code')->sortable()->searchable(),
            BooleanColumn::make('accepted')->label('Accepted')->sortable(),
            TextColumn::make('max_students')->label('Max Students')->sortable(),
            TextColumn::make('student_amount')->label('Student Amount')->sortable(),
            TextColumn::make('logo')->label('Logo')->sortable(),
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
            // Add relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
