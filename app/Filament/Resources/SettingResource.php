<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'System';

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type !== 'sp_office' && $user->user_type !== 'police_station';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Settings')
                    ->schema([
                        TextInput::make('site_name')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('site_logo')
                            ->image()
                            ->directory('settings')
                            ->visibility('public'),
                        FileUpload::make('site_favicon')
                            ->image()
                            ->directory('settings')
                            ->visibility('public'),
                    ])->columns(2),

                Forms\Components\Section::make('Email Settings')
                    ->schema([
                        TextInput::make('email_from_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email_from_address')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Select::make('mail_mailer')
                            ->options([
                                'smtp' => 'SMTP',
                                'mailgun' => 'Mailgun',
                                'ses' => 'Amazon SES',
                                'postmark' => 'Postmark',
                            ])
                            ->required(),
                        TextInput::make('smtp_host')
                            ->maxLength(255),
                        TextInput::make('smtp_port')
                            ->numeric()
                            ->maxLength(255),
                        TextInput::make('smtp_username')
                            ->maxLength(255),
                        TextInput::make('smtp_password')
                            ->password()
                            ->maxLength(255),
                        Select::make('smtp_encryption')
                            ->options([
                                'tls' => 'TLS',
                                'ssl' => 'SSL',
                            ]),

                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_from_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mail_mailer')
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
                Action::make('test_smtp')
                    ->label('Test SMTP Connection')
                    ->action(function (Setting $record) {
                        try {
                            // Configure mail settings
                            // Config::set('mail.mailer', $record->mail_mailer);
                            // Config::set('mail.from.address', $record->email_from_address);
                            // Config::set('mail.from.name', $record->email_from_name);

                            // if ($record->mail_mailer === 'smtp') {
                            //     Config::set('mail.mailers.smtp.host', $record->smtp_host);
                            //     Config::set('mail.mailers.smtp.port', $record->smtp_port);
                            //     Config::set('mail.mailers.smtp.username', $record->smtp_username);
                            //     Config::set('mail.mailers.smtp.password', $record->smtp_password);
                            //     Config::set('mail.mailers.smtp.encryption', $record->smtp_encryption);
                            // }

                            // Send test email
                            $mail = Mail::raw('This is a test email to verify your SMTP configuration.', function ($message) {
                                $message->to('info@beepixl.com')
                                    ->subject('SMTP Test Email');
                            });

                            dd($mail);

                            Notification::make()
                                ->title('SMTP Test Successful')
                                ->body('The test email was sent successfully.')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Log::info('Error: '.$e->getMessage());
                            Notification::make()
                                ->title('SMTP Test Failed')
                                ->body('Error: '.$e->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Test SMTP Connection')
                    ->modalDescription('This will send a test email to verify your SMTP configuration.')
                    ->modalSubmitActionLabel('Send Test Email'),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
