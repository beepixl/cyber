<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyReportResource\Pages;
use App\Models\DailyReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DailyReportResource extends Resource
{
    protected static ?string $model = DailyReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type !== 'sp_office';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')->required(),
                Forms\Components\TextInput::make('day')
                    ->label('Day')
                    ->disabled()
                    ->visible(false) // Hide this field from the form
                    ->dehydrated(false),
                Forms\Components\TextInput::make('user_id')
                    ->default(fn () => auth()->id())
                    ->label('User ID')
                    ->visible(false) // Hide this field from the form
                    ->required(),
                Forms\Components\TimePicker::make('from_time')->required(),
                Forms\Components\TimePicker::make('to_time')->required(),
                Forms\Components\Textarea::make('work_done')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')->date()->sortable(),
                Tables\Columns\TextColumn::make('day'),
                Tables\Columns\TextColumn::make('user_id')
                    ->label('Submitted By')
                    ->formatStateUsing(fn ($state) => \App\Models\User::find($state)->name ?? 'Unknown'),

                Tables\Columns\TextColumn::make('from_time')->time(),
                Tables\Columns\TextColumn::make('to_time')->time(),
                Tables\Columns\TextColumn::make('work_done')->limit(50),
            ])->actions([
                DeleteAction::make(),
                ReplicateAction::make(),

            ])->filters([
                Tables\Filters\Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('From Date'),
                        Forms\Components\DatePicker::make('to')->label('To Date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q, $from) => $q->whereDate('date', '>=', $from))
                            ->when($data['to'], fn ($q, $to) => $q->whereDate('date', '<=', $to));
                    }),
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('User')
                    ->options(\App\Models\User::pluck('name', 'id')->toArray())
                    ->searchable()
                    ->query(function ($query, $data) {

                        return $query; // Return all records if no user is selected

                        //  return $query->where('user_id', $data);
                    }),

            ])

            ->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyReports::route('/'),
            'create' => Pages\CreateDailyReport::route('/create'),
            'edit' => Pages\EditDailyReport::route('/{record}/edit'),

        ];
    }

    public static function getEloquentQuery(): Builder
    {

        if (auth()->user()->user_type == 'admin') {
            return parent::getEloquentQuery()->orderBy('id', 'desc');
        }
        $userid = auth()->user()->id;

        return parent::getEloquentQuery()->where('user_id', $userid)->orderBy('id', 'desc');
    }
}
