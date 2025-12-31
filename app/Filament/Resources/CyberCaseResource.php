<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CyberCaseResource\Pages;
use App\Filament\Resources\CyberCaseResource\RelationManagers;
use App\Models\CyberCase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CyberCaseResource extends Resource
{
    protected static ?string $model = CyberCase::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';

    protected static ?string $navigationGroup = 'Case Management';

    protected static ?int $navigationSort = 1;

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type !== 'sp_office' && $user->user_type !== 'police_station';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Case Information')
                    ->schema([
                        Forms\Components\TextInput::make('acknowledgement_no')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('nccrp_no')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\DatePicker::make('application_date')
                            ->required(),

                        Forms\Components\Select::make('category')
                            ->required()
                            ->options([
                                'Online Financial Fraud' => 'Online Financial Fraud',
                                'Cyber Harassment' => 'Cyber Harassment',
                                'Data Breach' => 'Data Breach',
                                'Identity Theft' => 'Identity Theft',
                                'Social Media' => 'Social Media',
                                'Other' => 'Other',
                            ]),
                        Forms\Components\Select::make('sub_category')
                            ->required()
                            ->options([
                                'UPI Related Frauds' => 'UPI Related Frauds',
                                'Credit Card Fraud' => 'Credit Card Fraud',
                                'Social Media' => 'Social Media',
                                'Email Fraud' => 'Email Fraud',
                                'Other' => 'Other',
                            ]),
                        Forms\Components\Select::make('status')
                            ->required()
                            ->options([
                                'pending' => 'Pending',
                                'assigned' => 'Assigned',
                                'in_progress' => 'In Progress',
                                'resolved' => 'Resolved',
                                'closed' => 'Closed',
                            ])
                            ->default('pending'),

                    ])->columns(2),

                Forms\Components\Section::make('Complainant Details')
                    ->schema([
                        Forms\Components\TextInput::make('complainant_name')
                            ->required(),
                        Forms\Components\TextInput::make('complainant_mobile')
                            ->required()
                            ->tel(),
                        Forms\Components\TextInput::make('complainant_email')
                            ->email(),
                        Forms\Components\TextInput::make('complainant_pincode')
                            ->required(),

                        Forms\Components\TextInput::make('complainant_address'),
                        Forms\Components\Select::make('police_station')
                            ->label('Police Station')
                            ->options(function () {
                                return \App\Models\PoliceStation::pluck('name', 'name')->toArray();
                            })
                            ->required(),
                        Forms\Components\TextInput::make('fraud_amount'),
                        Forms\Components\TextInput::make('lean_amount'),

                    ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nccrp_no')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('acknowledgement_no')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('application_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('complainant_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sub_category')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'pending',
                        'warning' => 'assigned',
                        'info' => 'in_progress',
                        'success' => 'resolved',
                        'gray' => 'closed',
                    ]),
                Tables\Columns\TextColumn::make('incident_datetime')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('police_station')
                    ->searchable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'assigned' => 'Assigned',
                        'in_progress' => 'In Progress',
                        'resolved' => 'Resolved',
                        'closed' => 'Closed',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Social Media' => 'Social Media',
                        'Online Financial Fraud' => 'Online Financial Fraud',
                        'Cyber Harassment' => 'Cyber Harassment',
                        'Data Breach' => 'Data Breach',
                        'Identity Theft' => 'Identity Theft',
                        'Other' => 'Other',
                    ]),
            ])
            ->actions([

                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('print')
                    ->icon('heroicon-o-printer')
                    ->url(fn ($record) => route('filament.resources.cyber-case-resource.pages.print-cyber-case-pdf', ['record' => $record->id]))
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
            RelationManagers\AccusedProfilesRelationManager::class,
            RelationManagers\FehristRelationManager::class,

            RelationManagers\BankTransactionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCyberCases::route('/'),
            'create' => Pages\CreateCyberCase::route('/create'),

            'edit' => Pages\EditCyberCase::route('/{record}/edit'),
            'print' => Pages\PrintCyberCase::route('/print'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
