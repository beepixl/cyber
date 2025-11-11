<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AarjiResource\Pages;
use App\Models\Aarji;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\FiltersLayout;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class AarjiResource extends Resource
{
    protected static ?string $model = Aarji::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Aarji';

    protected static ?string $navigationGroup = 'Cyber Applications';

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user && in_array($user->user_type, ['admin', 'police_station']);
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Section::make('Aarji Details')->schema([
                Forms\Components\TextInput::make('ack_no')->label('Acknowledgement Number'),
                Forms\Components\DatePicker::make('complaint_date')->label('Complaint Date'),
                Forms\Components\Select::make('police_station')->label('Police Station')->options(Aarji::pluck('police_station', 'police_station')),
                Forms\Components\TextInput::make('applicant_name')->label('Applicant Name')->required(),
                Forms\Components\TextInput::make('mobile_number')->label('Applicant Mobile Number')->tel()->required(),
                Forms\Components\Textarea::make('address')->label('Address'),
                Forms\Components\TextInput::make('fraud_type')->label('Fraud Type'),
                Forms\Components\TextInput::make('fraud_amount')->label('Fraud Amount')->numeric(),
                Forms\Components\TextInput::make('investigator')->label('Investigator'),
                Forms\Components\Select::make('application_status')
                    ->label('Application Status')
                    ->options([
                        'FIR Registered' => 'FIR Registered',
                        'Closed' => 'Closed',
                        'Under Process' => 'Under Process',
                    ])->default('Under Process'),
                Forms\Components\DatePicker::make('closed_at_police_station')->label('Closed at Police Station Date'),
                Forms\Components\DatePicker::make('closed_at_nccrp')->label('Closed at NCCRP Portal Date'),
                Forms\Components\TextInput::make('fir_number')->label('FIR Number'),
                Forms\Components\DatePicker::make('fir_date')->label('FIR Date'),
                Forms\Components\Textarea::make('remarks')->label('Remarks'),
            ])->columns(2),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('complaint_date')
                    ->date()
                    ->label('Complaint Date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('police_station')
                    ->label('Police Station')
                    ->sortable(),
                Tables\Columns\TextColumn::make('applicant_name')->searchable()->label('Applicant Name'),
                Tables\Columns\TextColumn::make('mobile_number')->label('Mobile Number'),
                Tables\Columns\TextColumn::make('fraud_type')->label('Fraud Type'),
                Tables\Columns\TextColumn::make('fraud_amount')
                    ->label('Fraud Amount')
                    ->money('INR', true)
                    ->summarize(Tables\Columns\Summarizers\Sum::make()),
                Tables\Columns\TextColumn::make('application_status')
                    ->badge()
                    ->colors([
                        'success' => 'FIR Registered',
                        'danger' => 'Closed',
                        'warning' => 'Under Process',
                    ])
                    ->label('Status'),
                Tables\Columns\TextColumn::make('investigator')->label('Investigator'),
                Tables\Columns\TextColumn::make('closed_at_police_station')->date()->label('Closed at Police Station Date'),
                Tables\Columns\TextColumn::make('closed_at_nccrp')->date()->label('Closed at NCCRP Portal Date'),
            ])
            ->filters([
                Tables\Filters\Filter::make('complaint_from')
                    ->label('From Date')
                    ->form([
                        Forms\Components\DatePicker::make('from_date')
                            ->label('From Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['from_date'] ?? null,
                            fn (Builder $query, $date) => $query->whereDate('complaint_date', '>=', $date)
                        );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from_date'] ?? null) {
                            $indicators[] = 'From: ' . \Carbon\Carbon::parse($data['from_date'])->toFormattedDateString();
                        }
                        return $indicators;
                    }),

                Tables\Filters\Filter::make('complaint_until')
                    ->label('To Date')
                    ->form([
                        Forms\Components\DatePicker::make('until_date')
                            ->label('To Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['until_date'] ?? null,
                            fn (Builder $query, $date) => $query->whereDate('complaint_date', '<=', $date)
                        );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['until_date'] ?? null) {
                            $indicators[] = 'Until: ' . \Carbon\Carbon::parse($data['until_date'])->toFormattedDateString();
                        }
                        return $indicators;
                    }),

                
                
                    Tables\Filters\SelectFilter::make('police_station')
                    ->label('Police Station')
                    ->options(fn () => Aarji::query()
                        ->distinct()
                        ->whereNotNull('police_station')
                        ->pluck('police_station', 'police_station')
                        ->toArray())
                    ->searchable(),
                
                    Tables\Filters\SelectFilter::make('application_status')
                    ->options([
                        'FIR Registered' => 'FIR Registered',
                        'Closed' => 'Closed',
                        'Under Process' => 'Under Process',
                    ])
                    ->label('Status'),


                Tables\Filters\Filter::make('closed_from')
                ->label('Closed From Date')
                ->form([
                    Forms\Components\DatePicker::make('closed_from_date')
                        ->label('Closed From Date'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query->when(
                        $data['closed_from_date'] ?? null,
                        fn (Builder $query, $date) => $query->whereDate('closed_at_police_station', '>=', $date)
                    );
                })
                ->indicateUsing(function (array $data): array {
                    $indicators = [];
                    if ($data['closed_from_date'] ?? null) {
                        $indicators[] = 'Closed From: ' . \Carbon\Carbon::parse($data['closed_from_date'])->toFormattedDateString();
                    }
                    return $indicators;
                }),

            Tables\Filters\Filter::make('closed_until')
                ->label('Closed To Date')
                ->form([
                    Forms\Components\DatePicker::make('closed_until_date')
                        ->label('Closed To Date'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query->when(
                        $data['closed_until_date'] ?? null,
                        fn (Builder $query, $date) => $query->whereDate('closed_at_police_station', '<=', $date)
                    );
                })
                ->indicateUsing(function (array $data): array {
                    $indicators = [];
                    if ($data['closed_until_date'] ?? null) {
                        $indicators[] = 'Closed Until: ' . \Carbon\Carbon::parse($data['closed_until_date'])->toFormattedDateString();
                    }
                    return $indicators;
                }),

            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                
                    //  Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->label('Aarji')->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->withFilename('Aarji-'.date('Y-m-d')),

                ]),
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();
        
        $user = auth()->user();
        
        // If user is police_station type and has a specific police station assigned
        if ($user && $user->user_type === 'police_station' && $user->police_station !== 'All') {
            $query->where('police_station', $user->police_station);
        }
        
        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAarjis::route('/'),
            'create' => Pages\CreateAarji::route('/create'),
            'edit' => Pages\EditAarji::route('/{record}/edit'),
        ];
    }

    
}
