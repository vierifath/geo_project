<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\LectureSubjectController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\RMKController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ThesisController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::get('/', [AuthController::class, 'index'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [AuthController::class, 'home']);
    Route::post('/home', [AuthController::class, 'postHome']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/template-excel', [AccountController::class, 'templateExcel']);
    Route::post('/password/update', [AuthController::class, 'updatePassword']);
    Route::post('/password/reset', [AuthController::class, 'resetPassword']);
    
    Route::prefix('dropdownlist')->group(function () {
        Route::get('/getDosen/{id}', [AccountController::class, 'getDosenByRMK']);
    });
    
    Route::middleware(['admin'])->group(function () {
        Route::prefix('mahasiswa')->group(function () {
            Route::prefix('tugas-akhir')->group(function () {
                Route::post('/tolak-status', [ThesisController::class, 'tolakTA']);
                Route::post('/setuju-status', [ThesisController::class, 'setujuTA']);
                Route::post('/revisi-status', [ThesisController::class, 'revisiTA']);
            });
        });
        Route::prefix('sidang')->group(function () {
            Route::prefix('proposal')->group(function () {
                Route::get('/', [ScheduleController::class, 'proposalAll']);
                Route::get('/{id}', [ScheduleController::class, 'proposal']);
                Route::post('/update', [ScheduleController::class, 'proposalUpdate']);
            });
            Route::prefix('tugas-akhir')->group(function () {
                Route::get('/', [ScheduleController::class, 'taAll']);
                Route::get('/{id}', [ScheduleController::class, 'ta']);
                Route::post('/update', [ScheduleController::class, 'taUpdate']);
            });
        });
        Route::prefix('schedule')->group(function () {
            Route::get('/', [ConfigController::class, 'index']);
            Route::post('/update', [ConfigController::class, 'update']);
        });
        Route::prefix('news')->group(function () {
          Route::get('/', [NewsController::class, 'index']);
            Route::get('/add', [NewsController::class, 'add']);
            Route::get('/edit/{id}', [NewsController::class, 'edit']);
            Route::post('/add', [NewsController::class, 'post']);
            Route::post('/update/{id}', [NewsController::class, 'update']);
            Route::post('/hapus', [NewsController::class, 'delete']);
        });
        Route::prefix('account')->group(function () {
            Route::get('/add/{role}', [AccountController::class, 'add']);
            Route::get('/edit/{id}', [AccountController::class, 'edit']);
            Route::get('/{role}', [AccountController::class, 'all']);
            Route::post('/add', [AccountController::class, 'postAccount']);
            Route::post('/add/template', [AccountController::class, 'addTemplate']);
            Route::post('/update', [AccountController::class, 'update']);
            Route::post('/hapus', [AccountController::class, 'deleteAccount']);
        });
        Route::prefix('rmk')->group(function () {
            Route::get('/', [RMKController::class, 'index']);
            Route::get('/add', [RMKController::class, 'add']);
            Route::get('/edit/{id}', [RMKController::class, 'edit']);
            Route::post('/add', [RMKController::class, 'post']);
            Route::post('/update/{id}', [RMKController::class, 'update']);
            Route::post('/hapus', [RMKController::class, 'delete']);
        });
        Route::prefix('admin-question')->group(function () {
            Route::get('/', [QuestionController::class, 'index']);
            Route::post('/add', [QuestionController::class, 'add']);
            Route::post('/update', [QuestionController::class, 'update']);
            Route::post('/delete', [QuestionController::class, 'delete']);
        });
        Route::prefix('admin-lecture-subject')->group(function () {
            Route::get('/', [LectureSubjectController::class, 'index']);
            Route::post('/add', [LectureSubjectController::class, 'add']);
            Route::post('/update', [LectureSubjectController::class, 'update']);
            Route::post('/delete', [LectureSubjectController::class, 'delete']);
        });
    });
    Route::middleware(['mahasiswa'])->group(function () {
        Route::prefix('proposal')->group(function () {
            Route::get('/', [ProposalController::class, 'index']);
            Route::post('/add', [ProposalController::class, 'postProposal']);
            Route::post('/update', [ProposalController::class, 'updateProposal']);
        });
        Route::prefix('tugas-akhir')->group(function () {
            Route::get('/', [ThesisController::class, 'index']);
            Route::post('/update', [ThesisController::class, 'postTA']);
        });
        Route::prefix('logbook')->group(function () {
            Route::get('/', [LogbookController::class, 'index']);
            Route::post('/add', [LogbookController::class, 'postLogbook']);
        });
    });
    Route::middleware(['dosen'])->group(function () {
        Route::prefix('mahasiswa')->group(function () {
            Route::get('/', [ProposalController::class, 'mahasiswa']);
            Route::post('/add', [ProposalController::class, 'postProposal']);
            Route::prefix('proposal')->group(function () {
                Route::get('/{mahasiswa_id}', [ProposalController::class, 'proposalMahasiswa']);
                Route::post('/tolak', [ProposalController::class, 'tolakProposal']);
                Route::post('/setuju', [ProposalController::class, 'setujuProposal']);
                Route::post('/revisi', [ProposalController::class, 'revisiProposal']);
            });
            Route::prefix('tugas-akhir')->group(function () {
                Route::get('/{mahasiswa_id}', [ThesisController::class, 'TAMahasiswa']);
                Route::post('/maju-sidang', [ThesisController::class, 'majuSidang']);
                Route::post('/revisi', [ThesisController::class, 'revisi']);
                Route::post('/revisi/ok', [ThesisController::class, 'revisiOk']);
                Route::post('/jurnal/ok', [ThesisController::class, 'jurnalOk']);
                Route::post('/pomits/ok', [ThesisController::class, 'pomitsOk']);
                Route::post('/nilai', [GradesController::class, 'update']);
                Route::post('/soal', [QuestionController::class, 'soal']);
            });
            Route::prefix('logbook')->group(function () {
                Route::get('/{mahasiswa_id}', [LogbookController::class, 'logbookMahasiswa']);
                Route::post('/tolak', [LogbookController::class, 'tolakLogbook']);
                Route::post('/setuju', [LogbookController::class, 'setujuLogbook']);
                Route::post('/setujuAll', [LogbookController::class, 'setujuAllLogbook']);
            });
        });
        Route::prefix('soal')->group(function () {
            Route::get('/', [QuestionController::class, 'index']);
            Route::post('/add', [QuestionController::class, 'add']);
            Route::post('/update', [QuestionController::class, 'update']);
            Route::post('/delete', [QuestionController::class, 'delete']);
        });
    });
});