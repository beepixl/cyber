<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CrimeRecordCardResource\Pages;
use App\Models\CrimeRecordCard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Actions\ReplicateAction;

class CrimeRecordCardResource extends Resource
{
    protected static ?string $model = CrimeRecordCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type !== 'sp_office';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('police_station_name')->label('Police Station Name (પોલીસ સ્ટેશનનું નામ)'),
                Forms\Components\TextInput::make('name')->label('1. Name (નામ)'),
                Forms\Components\TextInput::make('alias')->label('2. Alias (ઉપનામ)'),
                Forms\Components\TextInput::make('age')->label('3. Age (ઉંમર)'),
                Forms\Components\TextInput::make('fp_classification')->label('3. FP Classification (ફિંગરપ્રિન્ટ વર્ગીકરણ)'),
                Forms\Components\TextInput::make('place_of_birth')->label('4. Place of Birth (જન્મસ્થળ)'),
                Forms\Components\TextInput::make('height')->label('5. Height (ઊંચાઈ)'),
                Forms\Components\TextInput::make('complexion')->label('6. Complexion (ચામડીનો રંગ)'),
                Forms\Components\TextInput::make('build')->label('7. Build (શારીરિક બંધારણ)'),
                Forms\Components\TextInput::make('eyes')->label('8. Eyes (આંખો)'),
                Forms\Components\TextInput::make('hair')->label('9. Hair (વાળ)'),
                Forms\Components\TextInput::make('occupation')->label('10. Occupation (ધંધો)'),
                Forms\Components\TextInput::make('identification_marks')->label('11. Identification Marks (ઓળખના નિશાન)'),
                Forms\Components\TextInput::make('religion_caste')->label('12. Religion/Caste (ધર્મ/જાતિ)'),
                Forms\Components\TextInput::make('education')->label('13. Education (શિક્ષણ)'),
                Forms\Components\TextInput::make('red_no_of_p_stn')->label('14. Red No of P. Stn (પોલીસ સ્ટેશનનો રેડ નંબર)'),
                Forms\Components\TextInput::make('dist_mob_no')->label('15. Dist M.O.B. No. (જિલ્લો M.O.B. નંબર)'),
                Forms\Components\TextInput::make('cid_no')->label('16. C.I.D No. (C.I.D નંબર)'),

                Forms\Components\Textarea::make('address')->label('17. Address (સરનામું)'),
                // 18 is Photographs
                Forms\Components\TextInput::make('frequents_of_stays_at')->label('19. Frequents of Stays at (વારંવાર રહેવાની જગ્યાઓ)'),

                Forms\Components\TextInput::make('movements_info')->label('20. Movements Info (હલચલની માહિતી)'),
                Forms\Components\TextInput::make('police_officers')->label('21. Police Officers (પોલીસ અધિકારીઓ)'),
                Forms\Components\Repeater::make('convictions_summary')
                    ->label('22.Summary of Convictions  (સજા સંક્ષિપ્ત)')
                    ->schema([
                        Forms\Components\TextInput::make('s_no')->label('S.No'),
                        Forms\Components\TextInput::make('ps_crime_no')->label('P.S. Crime No'),
                        Forms\Components\TextInput::make('sentence')->label('Sentence'),
                        Forms\Components\TextInput::make('section')->label('Section'),
                        Forms\Components\DatePicker::make('date')->label('Date'),
                    ])
                    ->columns(5)
                    ->columnSpanFull()
                    ->visibleOn('edit'),
                Forms\Components\Textarea::make('mo')->label('M.O.'),
                Forms\Components\Textarea::make('relatives_friends')->label('23 .Relatives/Friends (સગા-સંબંધીઓ/મિત્રો)'),
                Forms\Components\TextInput::make('father_name')->label('24. Father Name (પિતાનું નામ)'),
                Forms\Components\TextInput::make('spouse_name')->label('25. Spouse Name (પત્ની/પતિનું નામ)'),
                Forms\Components\TextInput::make('associates_in_crime')->label('26. Associates in Crime (ગુનામાં સાથીદાર)'),
                Forms\Components\TextInput::make('receivers')->label('27. Receivers (પ્રાપ્તકર્તા)'),
                Forms\Components\TextInput::make('mo_classification')->label('28. Classification (કાર્યપદ્ધતિ વર્ગીકરણ)'),
                Forms\Components\Textarea::make('general_particulars')->label('29. General Particulars (સામાન્ય વિગતો)'),
                Forms\Components\Textarea::make('dress_description')->label('30. Dress Description (પોશાક વર્ણન)'),
                Forms\Components\Textarea::make('habits_vices')->label('31 .Habits/Vices (આદતો/દુર્ગુણો)'),
                Forms\Components\Textarea::make('sphere_of_activity')->label('32. Sphere of Activity (પ્રવૃત્તિ ક્ષેત્ર)'),
                Forms\Components\Textarea::make('antecedents')->label('33. Antecedents (પૂર્વવૃત્ત)'),
                // Non-numbered or unnumbered fields (keep at the end)

                Forms\Components\DatePicker::make('record_date')->label('Record Date (નોંધ તારીખ)'),
                Forms\Components\TextInput::make('languages_known')->label('Languages Known (આવડતી ભાષાઓ)'),
                Forms\Components\TextInput::make('date_of_photograph')->label('Date of Photograph (ફોટો તારીખ)'),
                Forms\Components\TextInput::make('fir_numbers')->label('FIR Numbers (FIR નંબર)'),
                Forms\Components\Textarea::make('style_description')->label('Style Description (શૈલી વર્ણન)'),
                Forms\Components\TextInput::make('cp_reference')->label('CP Reference (CP સંદર્ભ)'),
                Forms\Components\TextInput::make('ho_memo_no')->label('HO Memo No (HO મેમો નંબર)'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('police_station_name')->limit(20),
                //    Tables\Columns\TextColumn::make('record_date')->limit(20),
                Tables\Columns\TextColumn::make('name')->limit(20),
                Tables\Columns\TextColumn::make('alias')->limit(20),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                  ReplicateAction::make(),
                Tables\Actions\Action::make('Pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document')
                    ->url(fn ($record) => route('print-crime-record-card-pdf', ['record' => $record->id]))
                    ->openUrlInNewTab(),
            ]  ,position: ActionsPosition::BeforeColumns)
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
            'index' => Pages\ListCrimeRecordCards::route('/'),
            'create' => Pages\CreateCrimeRecordCard::route('/create'),
            'edit' => Pages\EditCrimeRecordCard::route('/{record}/edit'),
        ];
    }
}
