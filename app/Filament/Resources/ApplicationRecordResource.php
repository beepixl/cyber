<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationRecordResource\Pages;
use App\Filament\Resources\ApplicationRecordResource\RelationManagers;
use App\Models\ApplicationRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApplicationRecordResource extends Resource
{
	protected static ?string $model = ApplicationRecord::class;

	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	public static function getNavigationGroup(): ?string
	{
		return 'Feedback Management';
	}

	public static function shouldRegisterNavigation(): bool
	{
		$user = auth()->user();
		return $user && in_array($user->user_type, ['admin', 'sp_office']);
	}

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\Section::make('Applicant Details')
					->schema([
						Forms\Components\FileUpload::make('photo')
							->label('Photo')
							->image()
							->directory('application-photos')
							->disk('public')
							->visibility('public')
							->imageEditor()->imageEditorAspectRatios([
								'16:9',
								'4:3',
								'1:1',
							]),
						Forms\Components\Select::make('status')
							->options([
								'pending' => 'Pending',
							
								'completed' => 'Completed',
							])
							->default('pending')
							->native(false),
						Forms\Components\TextInput::make('name')->label('Name')->maxLength(255)->required(),
						
						Forms\Components\Textarea::make('address')->label('Address')->columnSpanFull()->required(),
						Forms\Components\TextInput::make('mobile_no')->label('Mobile No')->tel()->maxLength(20)->required(),
						Forms\Components\DatePicker::make('date')->label('Date')->default(now())->required(),
						Forms\Components\TimePicker::make('time')->label('Time')->seconds(false)->default(now()->format('H:i'))->required(),
						Forms\Components\Textarea::make('details_of_application')->label('Details of Application')->rows(4)->columnSpanFull(),
					
					
					])
					->columns(2),

				Forms\Components\Section::make('Sp Sir Instruction')
					->schema([
						Forms\Components\Textarea::make('sp_instructions')->label('Instruction')->rows(4)->columnSpanFull(),
						Forms\Components\TextInput::make('io_name')->label('IO Name')->maxLength(255),
						Forms\Components\TextInput::make('io_mobile')->label('IO Mobile')->tel()->maxLength(20),
						Forms\Components\Textarea::make('action_taken')->label('Action Taken')->rows(3)->columnSpanFull(),
						
					])
					->columns(2),

				Forms\Components\Section::make('Feedback')
					->schema([
						
						Forms\Components\Textarea::make('io_feedback')
							->label('IO Feedback')
							->rows(10)
							->columnSpanFull()
							->readOnly()
							->disabled()
							->autosize()
							->helperText('Read-only: full feedback shown'),
						Forms\Components\Textarea::make('applicant_feedback')
							->label('Applicant Feedback')
							->rows(10)
							->columnSpanFull()
							->readOnly()
							->disabled()
							->autosize()
							->helperText('Read-only: full feedback shown'),
					])
					->columns(2),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\ImageColumn::make('photo')->label('Photo')->disk('public')->square(),
				Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
				Tables\Columns\TextColumn::make('mobile_no')->label('Mobile')->searchable(),
				Tables\Columns\TextColumn::make('date')->date()->sortable(),
				Tables\Columns\TextColumn::make('time')->time('H:i'),
				Tables\Columns\TextColumn::make('officer')->toggleable(),
				Tables\Columns\BadgeColumn::make('status')
					->colors([
						'warning' => 'pending',
						'info' => 'in_progress',
						'success' => 'completed',
					])
					->sortable(),
				Tables\Columns\TextColumn::make('created_at')->dateTime()->since()->toggleable(isToggledHiddenByDefault: true),
				Tables\Columns\TextColumn::make('updated_at')->dateTime()->since()->toggleable(isToggledHiddenByDefault: true),
			])
			->filters([
				Tables\Filters\SelectFilter::make('status')
					->options([
						'pending' => 'Pending',
						'in_progress' => 'In Progress',
						'completed' => 'Completed',
					]),
			])
			->actions([
				// Tables\Actions\Action::make('Applicant Link')
				// 	->icon('heroicon-o-link')
				// 	->url(fn ($record) => route('feedback.applicant', ['hash' => md5($record->getKey())]))
				// 	->openUrlInNewTab(),
				// Tables\Actions\Action::make('IO Link')
				// 	->icon('heroicon-o-link')
				// 	->url(fn ($record) => route('feedback.io', ['hash' => md5($record->getKey())]))
				// 	->openUrlInNewTab(),

				

				Tables\Actions\Action::make('WhatsApp Applicant')
					->icon('heroicon-o-paper-airplane')
					->url(function ($record) {
						$link = route('feedback.applicant', ['hash' => md5($record->getKey())]);
						$phone = preg_replace('/\D+/', '', (string) $record->mobile_no);
						$text = urlencode("Please share your feedback: {$link}");
						return $phone ? "https://wa.me/{$phone}?text={$text}" : "https://wa.me/?text={$text}";
					})
					->openUrlInNewTab(),

				Tables\Actions\Action::make('WhatsApp IO')
					->icon('heroicon-o-paper-airplane')
					->url(function ($record) {
						$link = route('feedback.io', ['hash' => md5($record->getKey())]);
						$phone = preg_replace('/\D+/', '', (string) $record->io_mobile);
						$text = urlencode("Please share your IO feedback: {$link}");
						return $phone ? "https://wa.me/{$phone}?text={$text}" : "https://wa.me/?text={$text}";
					})
					->openUrlInNewTab(),

				Tables\Actions\EditAction::make(),
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
			'index' => Pages\ListApplicationRecords::route('/'),
			'create' => Pages\CreateApplicationRecord::route('/create'),
			'edit' => Pages\EditApplicationRecord::route('/{record}/edit'),
		];
	}
}
