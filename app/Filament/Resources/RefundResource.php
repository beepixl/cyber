<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RefundResource\Pages;
use App\Models\Refund;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;

class RefundResource extends Resource
{
    protected static ?string $model = Refund::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-rupee';

    protected static ?string $navigationLabel = 'Refunds';

    protected static ?string $navigationGroup = 'Cyber Applications';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Refund Details')->schema([
                Forms\Components\TextInput::make('acknowledgement_no')
                    ->label('Acknowledgement Number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('applicant_name')
                    ->label('Applicant Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('suspect_bank_account_name')
                    ->label('Suspect Bank Account Name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->label('Amount')
                    ->numeric()
                    ->prefix('₹'),
                Forms\Components\TextInput::make('suspect_account_number')
                    ->label('Suspect Account Number')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('email_date')
                    ->label('Email Date')
                    ->displayFormat('d/m/Y'),
                Forms\Components\Select::make('status')
                    ->label('Refund Status')
                    ->options([
                        'refund' => 'Refund',
                        'partial refund' => 'Partial Refund',
                        'not refunded' => 'Not Refunded',
                        'under process' => 'Under Process',
                    ])
                    ->default('not refunded')
                    ->required()
                    ->native(false)
                    ->live(),
                Forms\Components\TextInput::make('amount_refunded')
                    ->label('Amount Refunded')
                    ->numeric()
                    ->prefix('₹')
                    ->visible(fn (Forms\Get $get) => in_array($get('status'), ['refund', 'partial refund']))
                    ->helperText(fn (Forms\Get $get) => $get('amount') ? 'Total Amount: ₹' . number_format($get('amount'), 2) : null),
            ])->columns(2),

            Forms\Components\Section::make('Email Reminders')
                ->description('Add multiple reminder dates')
                ->schema([
                    Forms\Components\Repeater::make('email_reminders')
                        ->label('Reminder Dates')
                        ->schema([
                            Forms\Components\DatePicker::make('date')
                                ->label('Reminder Date')
                                ->required()
                                ->displayFormat('d/m/Y'),
                        ])
                        ->defaultItems(0)
                        ->addActionLabel('Add Reminder')
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => isset($state['date']) ? \Carbon\Carbon::parse($state['date'])->format('d/m/Y') : null)
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                            // Update reminder count and last reminder date
                            if (is_array($state) && !empty($state)) {
                                $dates = array_filter(array_column($state, 'date'));
                                $set('reminder_count', count($dates));
                                if (!empty($dates)) {
                                    $lastDate = max($dates);
                                    $set('last_reminder_date', $lastDate);
                                }
                            }
                        }),
                ]),

            Forms\Components\Section::make('Additional Information')->schema([
                Forms\Components\Textarea::make('remarks')
                    ->label('Remarks')
                    ->rows(3),
             
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('acknowledgement_no')
                    ->label('Ack. No.')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('applicant_name')
                    ->label('Applicant Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('suspect_bank_account_name')
                    ->label('Suspect Bank Account')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->money('INR', true)
                    ->summarize(Tables\Columns\Summarizers\Sum::make()),
                Tables\Columns\TextColumn::make('amount_refunded')
                    ->label('Amount Refunded')
                    ->money('INR', true)
                    ->sortable()
                    ->toggleable()
                    ->summarize(Tables\Columns\Summarizers\Sum::make()),
                Tables\Columns\TextColumn::make('suspect_account_number')
                    ->label('Account Number')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email_date')
                    ->label('Email Date')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('reminder_count')
                    ->label('Reminders Sent')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(function (string $state): string {
                        if ($state === 'refund') {
                            return 'success';
                        } elseif ($state === 'partial refund') {
                            return 'warning';
                        } elseif ($state === 'not refunded') {
                            return 'danger';
                        } elseif ($state === 'under process') {
                            return 'info';
                        }
                        return 'gray';
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('remarks')
                    ->label('Remarks')
                    ->toggleable(),
              
                Tables\Columns\TextColumn::make('last_reminder_date')
                    ->label('Last Reminder')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(true),
            ])
            ->filters([
                Tables\Filters\Filter::make('email_date')
                    ->form([
                        Forms\Components\DatePicker::make('email_from')
                            ->label('Email Date From'),
                        Forms\Components\DatePicker::make('email_until')
                            ->label('Email Date Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['email_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('email_date', '>=', $date),
                            )
                            ->when(
                                $data['email_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('email_date', '<=', $date),
                            );
                    }),
                Tables\Filters\SelectFilter::make('source_file')
                    ->label('Source File')
                    ->options(fn () => Refund::query()
                        ->distinct()
                        ->whereNotNull('source_file')
                        ->pluck('source_file', 'source_file')
                        ->toArray())
                    ->searchable(),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Refund Status')
                    ->options([
                        'refund' => 'Refund',
                        'partial refund' => 'Partial Refund',
                        'not refunded' => 'Not Refunded',
                        'under process' => 'Under Process',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('print')
                    ->label('Print')
                    ->icon('heroicon-o-printer')
                    ->url(fn ($record) => route('print-refund-pdf', ['record' => $record->getKey()]))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ],position: ActionsPosition::BeforeColumns)
          
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('email_date', 'desc');
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
            'index' => Pages\ListRefunds::route('/'),
            'create' => Pages\CreateRefund::route('/create'),
            'edit' => Pages\EditRefund::route('/{record}/edit'),
        ];
    }
}

