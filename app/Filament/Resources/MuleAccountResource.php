<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MuleAccountResource\Pages;
use App\Filament\Resources\MuleAccountResource\RelationManagers;
use App\Models\MuleAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MuleAccountResource extends Resource
{
    protected static ?string $model = MuleAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return 'Samanvaya';
    }

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type !== 'sp_office';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('outward_no')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('nodal_officer')
                    ->maxLength(255)
                    ->default(null),
                    Forms\Components\TextInput::make('bank_branch')
                    ->maxLength(255)
                    ->default(""),
                Forms\Components\TextInput::make('acknowledgement_no')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('account_no')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('ifsc_code')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('district')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('state')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('pin_code')
                    ->maxLength(10)
                    ->default(null),
                Forms\Components\TextInput::make('transaction_amount')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('disputed_amount')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('bank_fis')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('layers')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('outward_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('acknowledgement_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ifsc_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('district')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pin_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('disputed_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank_fis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('layers')
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
            ->filters([
          Tables\Filters\SelectFilter::make('outward_no')
        ->label('Outward No')
        ->options([
            'blank' => 'Blank',
            'filled' => 'Filled',
        ])
        ->default('blank') // preselect
        ->query(function (Builder $query, $state) {
            // Apply when blank (default)
            if ($state === null || $state === 'blank') {
                return $query->where(function ($q) {
                    $q->whereNull('outward_no')
                      ->orWhere('outward_no', '');
                });
            }

            if ($state === 'filled') {
                return $query->whereNotNull('outward_no')
                             ->where('outward_no', '!=', '');
            }

            return $query;
        }),
            ])
            ->actions([
            //    Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document')
                    ->url(fn ($record) => route('print-mule-account-pdf', ['record' => $record->getKey()]))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListMuleAccounts::route('/'),
            'create' => Pages\CreateMuleAccount::route('/create'),
            'edit' => Pages\EditMuleAccount::route('/{record}/edit'),
        ];
    }
}
