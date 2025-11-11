<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\Aarji;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationGroup = 'User Management';

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type === 'admin';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),

            Forms\Components\Select::make('user_type')
                ->label('User Type')
                ->options([
                    'admin' => 'Admin',
                    'IT Expert' => 'IT Expert',
                    'sp_office' => 'Sp Office',
                    'police_station' => 'Police Station',
                    'demo' => 'Demo',
                ])
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, Forms\Set $set) {
                    if ($state !== 'police_station') {
                        $set('police_station', 'All');
                    }
                }),

            Forms\Components\Select::make('police_station')
                ->label('Police Station')
                ->options(fn () => array_merge(
                    ['All' => 'All'],
                    Aarji::query()
                        ->distinct()
                        ->whereNotNull('police_station')
                        ->pluck('police_station', 'police_station')
                        ->toArray()
                ))
                ->default('All')
                ->required()
                ->visible(fn (Forms\Get $get) => $get('user_type') === 'police_station'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_type')
                    ->badge()
                    ->label('User Type'),
                Tables\Columns\TextColumn::make('police_station')
                    ->label('Police Station')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}


