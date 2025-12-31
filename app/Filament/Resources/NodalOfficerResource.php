<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NodalOfficerResource\Pages;
use App\Models\NodalOfficer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NodalOfficerResource extends Resource
{
    protected static ?string $model = NodalOfficer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Bank Management';

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type !== 'sp_office' && $user->user_type !== 'police_station';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bank')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_of_officer')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('designation')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mobile_no')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bank')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name_of_officer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('designation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('bank')
                    ->options(function () {
                        return NodalOfficer::distinct()->pluck('bank', 'bank')->toArray();
                    })
                    ->searchable()
                    ->preload()
                    ->label('Filter by Bank'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([

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
            'index' => Pages\ListNodalOfficers::route('/'),
            'create' => Pages\CreateNodalOfficer::route('/create'),
            'edit' => Pages\EditNodalOfficer::route('/{record}/edit'),
        ];
    }
}
