<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\LibroResource\Pages;
use App\Filament\User\Resources\LibroResource\RelationManagers;
use App\Models\Libro;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LibroResource extends Resource
{
    protected static ?string $model = Libro::class;
    protected static ?string $label = 'Libri ';

    protected static ?string $navigationLabel = 'Libri';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('titolo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('autore')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('codice_isbn')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('trama')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('numero_di_letture_complete')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titolo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('autore')
                    ->searchable(),
                Tables\Columns\TextColumn::make('codice_isbn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_di_letture_complete')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLibros::route('/'),
            'create' => Pages\CreateLibro::route('/create'),
            'view' => Pages\ViewLibro::route('/{record}'),
            'edit' => Pages\EditLibro::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {

        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}
