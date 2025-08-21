<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PoliceStationResource\Pages;
use App\Filament\Resources\PoliceStationResource\RelationManagers;
use App\Models\PoliceStation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PoliceStationResource extends Resource
{
    protected static ?string $model = PoliceStation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Police Station Name')
                    ->required(),
                Forms\Components\TextInput::make('pi_name')
                    ->label('PI Name')
                    ->required(),
                Forms\Components\FileUpload::make('pi_sign')
                    ->label('PI Sign')
                    ->directory('police-stations')
                    ->image()
                    ->nullable(),
                Forms\Components\FileUpload::make('seal')
                    ->label('Seal')
                    ->directory('police-stations')
                    ->image()
                    ->nullable(),
                Forms\Components\Textarea::make('address')
                    ->label('Address')
                    ->required(),
                    Forms\Components\TextInput::make('phone_no')
                        ->label('Phone Number')
                        ->tel()
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Police Station Name')->searchable(),
                Tables\Columns\TextColumn::make('pi_name')->label('PI Name')->searchable(),
                Tables\Columns\ImageColumn::make('pi_sign')->label('PI Sign'),
                Tables\Columns\ImageColumn::make('seal')->label('Seal'),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('phone_no')->label('Phone Number')->searchable(),
              
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPoliceStations::route('/'),
            'create' => Pages\CreatePoliceStation::route('/create'),
            'edit' => Pages\EditPoliceStation::route('/{record}/edit'),
        ];
    }
}
