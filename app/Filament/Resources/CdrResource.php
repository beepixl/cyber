<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CdrResource\Pages;
use App\Filament\Resources\CdrResource\RelationManagers;
use App\Models\Cdr;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Enums\ActionsPosition;

class CdrResource extends Resource
{
    protected static ?string $model = Cdr::class;

    protected static ?string $navigationGroup = 'IP & CDR Management';
        protected static ?string $navigationLabel = 'CDR Records';
 protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type !== 'sp_office';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('nodal_officer')
                    ->options([
                        'VODAFONE IDEA' => 'VODAFONE IDEA',
                        'RELAINCE JIO' => 'RELAINCE JIO',
                        'BSNL' => 'BSNL',
                        'AIRTEL' => 'AIRTEL',
                    ])
                    ->default(null)->hiddenOn('create')->hiddenOn('edit'),

                Forms\Components\TextInput::make('sho')
                    ->maxLength(255)
                    ->default('U L Modi'),

                Forms\Components\TextInput::make('contact_sho')
                    ->maxLength(255)
                    ->default('7574819920'),

                    Forms\Components\TextInput::make('officer')
                    ->maxLength(255)
                    ->default('S K Rai'),
                Forms\Components\DatePicker::make('date')->default(now()),
                Forms\Components\TextInput::make('outward_no')
                    ->maxLength(255)
                    ->default(null),
           
                Forms\Components\Select::make('police_station')
                ->options([
                    'Bilimora' => 'Bilimora',
                    'Chikhli' => 'Chikhli',
                    'Cyber Crime' => 'Cyber Crime',
                    'Dholai Marine' => 'Dholai Marine',
                    'Gandevi' => 'Gandevi',
                    'Jalalpore' => 'Jalalpore',
                    'Khergam' => 'Khergam',
                    'Maroli' => 'Maroli',
                    'Navsari Rural' => 'Navsari Rural',
                    'Navsari Town' => 'Navsari Town',
                    'Vansda' => 'Vansda',
                    'Vijalpore' => 'Vijalpore',
                ])->required(),
                Forms\Components\Textarea::make('mobile_or_imei_no')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('period_from'),
                Forms\Components\DatePicker::make('period_to'),
                Forms\Components\TextInput::make('fir_or_case_no')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nodal_officer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('outward_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('police_station')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile_or_imei_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('period_from')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('period_to')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fir_or_case_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                ReplicateAction::make(),
            Tables\Actions\Action::make('print_cdr')
                ->label('Print CDR')
                ->icon('heroicon-o-printer')
                ->url(fn ($record) => route('print-cdr-pdf', ['record' => $record->getKey()]))
                ->openUrlInNewTab(),
            ],position: ActionsPosition::BeforeColumns)
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
            'index' => Pages\ListCdrs::route('/'),
            'create' => Pages\CreateCdr::route('/create'),
            'edit' => Pages\EditCdr::route('/{record}/edit'),
        ];
    }
}
