<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IpdrResource\Pages;
use App\Models\Ipdr;
use Filament\Forms;
use Filament\Forms\Form;          // ✅ v3
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;        // ✅ v3
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Enums\ActionsPosition;

class IpdrResource extends Resource
{
    protected static ?string $model = Ipdr::class;
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'IP & CDR Management';
    protected static ?string $navigationLabel = 'IPDR Records';

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type !== 'sp_office';
    }

    public static function form(Form $form): Form   // ✅ v3 signature
    {
        return $form->schema([
      Forms\Components\Select::make('select_officer')
    ->label('Select Officer')
    ->options([
        'VODAFONE IDEA' => 'VODAFONE IDEA',
        'RELIANCE JIO' => 'RELIANCE JIO',
        'BSNL' => 'BSNL',
        'AIRTEL' => 'AIRTEL',
        'Other' => 'Other',
    ])
    ->default(null)
    ->live()
    ->required()
    ->afterStateUpdated(function ($state, callable $set) {
        if ($state !== 'Other') {
            // Directly set nodal_officer to the selected option
            $set('nodal_officer', $state);
        } else {
            // Clear nodal_officer, will be filled by text input
            $set('nodal_officer', null);
        }
    }),

Forms\Components\TextInput::make('nodal_officer')
    ->label('Other Nodal Officer')
    ->maxLength(255)
    ->required()
    ->live()
    ->afterStateUpdated(function ($state, callable $set, $get) {
        if ($get('select_officer') === 'Other') {
            $set('nodal_officer', $state); // set typed value
        }
    }),

            Forms\Components\DatePicker::make('date')->default(now()),
            Forms\Components\TextInput::make('outward_no'),
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
            Forms\Components\TextInput::make('officer')
                    ->maxLength(255)
                    ->default('S K Rai'),
            Forms\Components\TextInput::make('fir_or_case_no'),
           Forms\Components\TextInput::make('sho')
                    ->maxLength(255)
                    ->default('U L Modi'),

                Forms\Components\TextInput::make('contact_sho')
                    ->maxLength(255)
                    ->default('7574819920'),
 

            // Repeater storing multiple: timestamp_utc, iptype, ipaddress
            Forms\Components\Repeater::make('entries')
                ->label('IPDR Entries')
                ->schema([
                    Forms\Components\DateTimePicker::make('timestamp_utc')
                        ->label('Timestamp (UTC)')
                        ->seconds(true)
                        ->required(),
                    Forms\Components\Select::make('iptype')
                        ->options([
                            'IPv4' => 'IPv4',
                            'IPv6' => 'IPv6',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('ipaddress')
                        ->label('IP Address')
                        ->required(),
                       

                ])

                ->columns(3)
                ->columnSpanFull()    
                ->collapsible()
                ->default([])->visible(fn (string $operation) => $operation !== 'create'),
        ]);
    }

    public static function table(Table $table): Table   // ✅ v3 signature
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nodal_officer'),
                Tables\Columns\TextColumn::make('date')->date(),
                Tables\Columns\TextColumn::make('outward_no'),
                Tables\Columns\TextColumn::make('police_station'),
                Tables\Columns\TextColumn::make('fir_or_case_no'),
               
               ])
            ->filters([
                TrashedFilter::make(), // ✅ works with SoftDeletes
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
               Tables\Actions\Action::make('print_ipdr')
                ->label('Print IPDR')
                ->icon('heroicon-o-printer')
                ->url(fn ($record) => route('print-ipdr-pdf', ['record' => $record->getKey()]))
                ->openUrlInNewTab(),
            ],position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIpdrs::route('/'),
            'create' => Pages\CreateIpdr::route('/create'),
            'edit' => Pages\EditIpdr::route('/{record}/edit'),
        ];
    }
}
