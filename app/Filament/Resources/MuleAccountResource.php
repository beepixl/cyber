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
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Forms\Components\Select;

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
        return $user && $user->user_type !== 'sp_office' && $user->user_type !== 'police_station';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                
                Forms\Components\Section::make('Account Details')
                    ->schema([
                        Forms\Components\TextInput::make('bank_branch')
                            ->label('Bank Branch')
                            ->maxLength(255)
                            ->default(fn ($record) => $record->nodal_officer ?? null),
                      
                    Forms\Components\TextInput::make('acknowledgement_no')
                        ->label('Acknowledgement No')
                        ->maxLength(255),
                        Forms\Components\TextInput::make('account_no')
                            ->label('Account No')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ifsc_code')
                            ->label('IFSC Code')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('bank_branch_address')
                            ->label('Bank Branch Address')
                            ->rows(2)
                            ->default(fn ($record) => $record?->address ?? null),
                        Forms\Components\Textarea::make('address')
                            ->label('Address')
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('district')
                            ->label('District')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('state')
                            ->label('State')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('pin_code')
                            ->label('Pin Code')
                            ->maxLength(10),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Transaction Details')
                    ->schema([
                        Forms\Components\TextInput::make('transaction_amount')
                            ->label('Transaction Amount')
                            ->numeric()
                            ->prefix('₹'),
                        Forms\Components\TextInput::make('disputed_amount')
                            ->label('Disputed Amount')
                            ->numeric()
                            ->prefix('₹'),
                        Forms\Components\TextInput::make('bank_fis')
                            ->label('Bank/Fls')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('layers')
                            ->label('Layers')
                            ->numeric(),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Letter')
                    ->schema([
                        Forms\Components\TextInput::make('outward_no')
                        ->label('Outward No')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('nodal_officer')
                        ->label('Nodal Officer')
                        ->maxLength(255),
                        Forms\Components\DatePicker::make('reply_letter_sent_to_bank_dt')
                            ->label('Reply Letter - Sent to Bank Dt')
                            ->displayFormat('d/m/Y'),
                        Forms\Components\DatePicker::make('reply_letter_received_from_bank_dt')
                            ->label('Reply Letter - Received from Bank Dt')
                            ->displayFormat('d/m/Y'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Account Holder Information')
                    ->schema([
                        Forms\Components\Textarea::make('acc_holder_address')
                            ->label('Acc Holder Address')
                            ->rows(2)
                            ->columnSpanFull(),
                  

                            Select::make('acc_holder_police_station')
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
                        Forms\Components\DatePicker::make('holder_nivedan_taken_dt')
                            ->label('Holder Nivedan Taken Dt')
                            ->displayFormat('d/m/Y'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Remarks & Action')
                    ->schema([
                        Forms\Components\Select::make('remarks')
                        ->label('Remarks')
                        ->options([
                            'Mule' => 'Mule',
                            'Gaming' => 'Gaming',
                            'Genuine' => 'Genuine',
                            'Under Investigation' => 'Under Investigation',
                        ])
                        ->required(),
                        Forms\Components\Textarea::make('action_taken')
                            ->label('Action Taken')
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('action_taken_date')
                            ->label('Action Taken Date')
                            ->displayFormat('d/m/Y'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('account_no')
                    ->label('Account No.')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ifsc_code')
                    ->label('IFSC Code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank_branch_address')
                    ->label('Bank Branch Address')
                    ->searchable()
                    ->wrap()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('district')
                    ->label('District')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pin_code')
                    ->label('Pin Code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_amount')
                    ->label('Transaction Amount')
                    ->money('INR', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('disputed_amount')
                    ->label('Disputed Amount')
                    ->money('INR', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank_fis')
                    ->label('Bank/Fls')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('layers')
                    ->label('Layers')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reply_letter_sent_to_bank_dt')
                    ->label('Reply Letter - Sent to Bank Dt')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('reply_letter_received_from_bank_dt')
                    ->label('Reply Letter - Received from Bank Dt')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('acc_holder_address')
                    ->label('Acc Holder Address')
                    ->searchable()
                    ->wrap()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('acc_holder_police_station')
                    ->label('Acc Holder Police Station')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('holder_nivedan_taken_dt')
                    ->label('Holder Nivedan Taken Dt')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('remarks')
                    ->label('Remarks')
                    ->searchable()
                    ->wrap()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('action_taken')
                    ->label('Action Taken')
                    ->searchable()
                    ->wrap()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('action_taken_date')
                    ->label('Action Taken Date')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
                // Additional columns for reference
                Tables\Columns\TextColumn::make('outward_no')
                    ->label('Outward No')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('acknowledgement_no')
                    ->label('Ack. No')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
        Tables\Filters\Filter::make('reply_letter_sent_to_bank_dt')
            ->label('Reply Letter Sent Date')
            ->form([
                Forms\Components\DatePicker::make('reply_letter_from')
                    ->label('From Date'),
                Forms\Components\DatePicker::make('reply_letter_until')
                    ->label('To Date'),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['reply_letter_from'] ?? null,
                        fn (Builder $query, $date): Builder => $query->whereDate('reply_letter_sent_to_bank_dt', '>=', $date),
                    )
                    ->when(
                        $data['reply_letter_until'] ?? null,
                        fn (Builder $query, $date): Builder => $query->whereDate('reply_letter_sent_to_bank_dt', '<=', $date),
                    );
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
                    ExportBulkAction::make()
                        ->label('Export Mule Accounts')
                        ->exports([
                            ExcelExport::make()
                                ->fromTable()
                                ->withFilename('Mule Accounts-' . date('Y-m-d')),
                        ]),
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
