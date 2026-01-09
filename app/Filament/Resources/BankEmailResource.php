<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankEmailResource\Pages;
use App\Models\BankEmail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BankEmailResource extends Resource
{
    protected static ?string $model = BankEmail::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

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
                Forms\Components\Select::make('type')
                    ->options([
                        'Co-op Bank' => 'Co-op Bank',
                        'Fintech' => 'Fintech',
                        'Payments Bank' => 'Payments Bank',
                        'E-Commerce' => 'E-Commerce',
                        'Bank/Card' => 'Bank/Card',
                        'Rural Bank' => 'Rural Bank',
                        'Bank' => 'Bank',
                        'Insurance' => 'Insurance',
                        'Finance' => 'Finance',
                        'Govt/PSU' => 'Govt/PSU',
                        'Crypto/Fintech' => 'Crypto/Fintech',
                        'Crypto' => 'Crypto',
                        'Real Estate' => 'Real Estate',
                        'Bank/Corp' => 'Bank/Corp',
                        'Government' => 'Government',
                        'Social Media' => 'Social Media',
                        'Cloud/Tech' => 'Cloud/Tech',
                        'Tech' => 'Tech',
                        'Tech/ISP' => 'Tech/ISP',
                        'Hosting/Domain' => 'Hosting/Domain',
                        'Institutions' => 'Institutions',
                        'Tech/Comms' => 'Tech/Comms',
                        'Logistics/Tech' => 'Logistics/Tech',
                        'Food Tech' => 'Food Tech',
                        'Services Tech' => 'Services Tech',
                        'Retail' => 'Retail',
                        'Travel Tech' => 'Travel Tech',
                        'Social/Matrimony' => 'Social/Matrimony',
                        'Aviation' => 'Aviation',
                        'Placeholder' => 'Placeholder',
                        'Police/Cyber' => 'Police/Cyber',
                    ])
                    ->searchable()
                    ->preload(),
                Forms\Components\Textarea::make('emails')
                    ->required()
                    ->rows(5)
                    ->placeholder('Enter emails separated by commas')
                    ->helperText('Enter multiple emails separated by commas'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bank')
                ->label('Institution Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('emails')
                    ->searchable()
                    ->wrap()
                    ->copyable()
                    ->limit(100),
                    
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
                Tables\Filters\SelectFilter::make('bank')
                    ->options(function () {
                        return BankEmail::distinct()->pluck('bank', 'bank')->toArray();
                    })
                    ->searchable()
                    ->preload()
                    ->label('Filter by Bank'),

                    Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'Co-op Bank' => 'Co-op Bank',
                        'Fintech' => 'Fintech',
                        'Payments Bank' => 'Payments Bank',
                        'E-Commerce' => 'E-Commerce',
                        'Bank/Card' => 'Bank/Card',
                        'Rural Bank' => 'Rural Bank',
                        'Bank' => 'Bank',
                        'Insurance' => 'Insurance',
                        'Finance' => 'Finance',
                        'Govt/PSU' => 'Govt/PSU',
                        'Crypto/Fintech' => 'Crypto/Fintech',
                        'Crypto' => 'Crypto',
                        'Real Estate' => 'Real Estate',
                        'Bank/Corp' => 'Bank/Corp',
                        'Government' => 'Government',
                        'Social Media' => 'Social Media',
                        'Cloud/Tech' => 'Cloud/Tech',
                        'Tech' => 'Tech',
                        'Tech/ISP' => 'Tech/ISP',
                        'Hosting/Domain' => 'Hosting/Domain',
                        'Institutions' => 'Institutions',
                        'Tech/Comms' => 'Tech/Comms',
                        'Logistics/Tech' => 'Logistics/Tech',
                        'Food Tech' => 'Food Tech',
                        'Services Tech' => 'Services Tech',
                        'Retail' => 'Retail',
                        'Travel Tech' => 'Travel Tech',
                        'Social/Matrimony' => 'Social/Matrimony',
                        'Aviation' => 'Aviation',
                        'Placeholder' => 'Placeholder',
                        'Police/Cyber' => 'Police/Cyber',
                    ])
                    ->searchable()
                    ->preload()
                    ->label('Filter by Type'),
            ])
            ->actions([
                // Tables\Actions\Action::make('copy_emails')
                // ->label('Copy Emails')
                // ->icon('heroicon-s-clipboard-document-check')
                // ->action(function ($livewire, $record) {
                //     $livewire->dispatch('copyToClipboard', text: $record->emails);
                //   //  $livewire->notify('success', 'Emails copied to clipboard!');
                // })
                // ->color('secondary')
                // ->visible(fn ($record) => !empty($record->emails)),

            Tables\Actions\Action::make('send_email')
    ->label('Send Email')
    ->icon('heroicon-s-envelope')
    ->url(fn ($record) =>
        'mailto:' . $record->emails .
        '?subject=' . rawurlencode('Provide complete details of Bank Account Numbers Complaint No. / Ak no.') .
        '&body=' . rawurlencode("Dear Nodal Officer,\n\nProvide complete details of Bank Account Numbers Complaint No. / Ak no.")
    )
    ->openUrlInNewTab()
    ->color('secondary')
    ->visible(fn ($record) => !empty($record->emails)),


            
                Tables\Actions\EditAction::make(),
              //  Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                   // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBankEmails::route('/'),
            'create' => Pages\CreateBankEmail::route('/create'),
            'edit' => Pages\EditBankEmail::route('/{record}/edit'),
        ];
    }
}
