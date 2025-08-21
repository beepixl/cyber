<?php

use App\Filament\Resources\CrimeRecordCardResource\Pages\PrintCrimeRecordCard;
use App\Filament\Resources\CyberCaseResource\Pages\PrintBankTransaction;
use App\Filament\Resources\CyberCaseResource\Pages\PrintCyberCase;
use App\Http\Controllers\AccusedProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/cyber/public/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/cyber/public/livewire/update', $handle);
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/cyber-cases/print/{record}', [PrintCyberCase::class, 'generatePdf'])->name('filament.resources.cyber-case-resource.pages.print-cyber-case-pdf');
Route::get('/bank-transactions/print/{record}', [PrintBankTransaction::class, 'generatePdf'])->name('print-bank-pdf');
Route::get('/reports/view', [ReportController::class, 'view'])->name('reports.view');
Route::get('/transactions/tree/{acknowledgement_no}', [ReportController::class, 'showTransactionTree']);
Route::get('/accused-profiles/{accusedProfile}', [AccusedProfileController::class, 'show'])->name('accused-profiles.show');
Route::get('/crime-record-cards/print/{record}', [PrintCrimeRecordCard::class, 'generatePdf'])->name('print-crime-record-card-pdf');


Route::get('/mule-accounts/print/{record}', [ReportController::class, 'printMuleAccountPdf'])->name('print-mule-account-pdf');
Route::get('/cdr/print/{record}', [ReportController::class, 'printCdrPdf'])->name('print-cdr-pdf');

