<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Client
use App\Filament\Admin\Resources\ClientResource\Api\Handlers\CreateHandler as ClientCreateHandler;
use App\Filament\Admin\Resources\ClientResource\Api\Handlers\DeleteHandler as ClientDeleteHandler;
use App\Filament\Admin\Resources\ClientResource\Api\Handlers\DetailHandler as ClientDetailHandler;
use App\Filament\Admin\Resources\ClientResource\Api\Handlers\PaginationHandler as ClientPaginationHandler;
use App\Filament\Admin\Resources\ClientResource\Api\Handlers\UpdateHandler as ClientUpdateHandler;

// Employee
use App\Filament\Admin\Resources\EmployeeResource\Api\Handlers\CreateHandler as EmployeeCreateHandler;
use App\Filament\Admin\Resources\EmployeeResource\Api\Handlers\DeleteHandler as EmployeeDeleteHandler;
use App\Filament\Admin\Resources\EmployeeResource\Api\Handlers\DetailHandler as EmployeeDetailHandler;
use App\Filament\Admin\Resources\EmployeeResource\Api\Handlers\PaginationHandler as EmployeePaginationHandler;
use App\Filament\Admin\Resources\EmployeeResource\Api\Handlers\UpdateHandler as EmployeeUpdateHandler;

// Hasil Pertandingan
use App\Filament\Admin\Resources\HasilPertandinganResource\Api\Handlers\CreateHandler as HasilPertandinganCreateHandler;
use App\Filament\Admin\Resources\HasilPertandinganResource\Api\Handlers\DeleteHandler as HasilPertandinganDeleteHandler;
use App\Filament\Admin\Resources\HasilPertandinganResource\Api\Handlers\DetailHandler as HasilPertandinganDetailHandler;
use App\Filament\Admin\Resources\HasilPertandinganResource\Api\Handlers\PaginationHandler as HasilPertandinganPaginationHandler;
use App\Filament\Admin\Resources\HasilPertandinganResource\Api\Handlers\UpdateHandler as HasilPertandinganUpdateHandler;

// Pelatihan
use App\Filament\Admin\Resources\PelatihanResource\Api\Handlers\CreateHandler as PelatihanCreateHandler;
use App\Filament\Admin\Resources\PelatihanResource\Api\Handlers\DeleteHandler as PelatihanDeleteHandler;
use App\Filament\Admin\Resources\PelatihanResource\Api\Handlers\DetailHandler as PelatihanDetailHandler;
use App\Filament\Admin\Resources\PelatihanResource\Api\Handlers\PaginationHandler as PelatihanPaginationHandler;
use App\Filament\Admin\Resources\PelatihanResource\Api\Handlers\UpdateHandler as PelatihanUpdateHandler;

// Pertandingan
use App\Filament\Admin\Resources\PertandinganResource\Api\Handlers\CreateHandler as PertandinganCreateHandler;
use App\Filament\Admin\Resources\PertandinganResource\Api\Handlers\DeleteHandler as PertandinganDeleteHandler;
use App\Filament\Admin\Resources\PertandinganResource\Api\Handlers\DetailHandler as PertandinganDetailHandler;
use App\Filament\Admin\Resources\PertandinganResource\Api\Handlers\PaginationHandler as PertandinganPaginationHandler;
use App\Filament\Admin\Resources\PertandinganResource\Api\Handlers\UpdateHandler as PertandinganUpdateHandler;

// Ranking
use App\Filament\Admin\Resources\RankingResource\Api\Handlers\CreateHandler as RankingCreateHandler;
use App\Filament\Admin\Resources\RankingResource\Api\Handlers\DeleteHandler as RankingDeleteHandler;
use App\Filament\Admin\Resources\RankingResource\Api\Handlers\DetailHandler as RankingDetailHandler;
use App\Filament\Admin\Resources\RankingResource\Api\Handlers\PaginationHandler as RankingPaginationHandler;
use App\Filament\Admin\Resources\RankingResource\Api\Handlers\UpdateHandler as RankingUpdateHandler;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    // Protected route
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Client
    Route::prefix('clients')->group(function () {
        Route::post('/', [ClientCreateHandler::class, 'handler'])->name('api.clients.create');
        Route::get('/', [ClientPaginationHandler::class, 'handler'])->name('api.clients.pagination');
        Route::get('/{id}', [ClientDetailHandler::class, 'handler'])->name('api.clients.detail');
        Route::put('/{id}', [ClientUpdateHandler::class, 'handler'])->name('api.clients.update');
        Route::delete('/{id}', [ClientDeleteHandler::class, 'handler'])->name('api.clients.delete');
    });

    // Employee
    Route::prefix('employees')->group(function () {
        Route::post('/', [EmployeeCreateHandler::class, 'handler'])->name('api.employees.create');
        Route::get('/', [EmployeePaginationHandler::class, 'handler'])->name('api.employees.pagination');
        Route::get('/{id}', [EmployeeDetailHandler::class, 'handler'])->name('api.employees.detail');
        Route::put('/{id}', [EmployeeUpdateHandler::class, 'handler'])->name('api.employees.update');
        Route::delete('/{id}', [EmployeeDeleteHandler::class, 'handler'])->name('api.employees.delete');
    });

    // HasilPertandingan
    Route::prefix('hasilpertandingans')->group(function () {
        Route::post('/', [HasilPertandinganCreateHandler::class, 'handler'])->name('api.hasilpertandingans.create');
        Route::get('/', [HasilPertandinganPaginationHandler::class, 'handler'])->name('api.hasilpertandingans.pagination');
        Route::get('/{id}', [HasilPertandinganDetailHandler::class, 'handler'])->name('api.hasilpertandingans.detail');
        Route::put('/{id}', [HasilPertandinganUpdateHandler::class, 'handler'])->name('api.hasilpertandingans.update');
        Route::delete('/{id}', [HasilPertandinganDeleteHandler::class, 'handler'])->name('api.hasilpertandingans.delete');
    });

    // Pelatihan
    Route::prefix('pelatihans')->group(function () {
        Route::post('/', [PelatihanCreateHandler::class, 'handler'])->name('api.pelatihans.create');
        Route::get('/', [PelatihanPaginationHandler::class, 'handler'])->name('api.pelatihans.pagination');
        Route::get('/{id}', [PelatihanDetailHandler::class, 'handler'])->name('api.pelatihans.detail');
        Route::put('/{id}', [PelatihanUpdateHandler::class, 'handler'])->name('api.pelatihans.update');
        Route::delete('/{id}', [PelatihanDeleteHandler::class, 'handler'])->name('api.pelatihans.delete');
    });

    // Pertandingan
    Route::prefix('pertandingans')->group(function () {
        Route::post('/', [PertandinganCreateHandler::class, 'handler'])->name('api.pertandingans.create');
        Route::get('/', [PertandinganPaginationHandler::class, 'handler'])->name('api.pertandingans.pagination');
        Route::get('/{id}', [PertandinganDetailHandler::class, 'handler'])->name('api.pertandingans.detail');
        Route::put('/{id}', [PertandinganUpdateHandler::class, 'handler'])->name('api.pertandingans.update');
        Route::delete('/{id}', [PertandinganDeleteHandler::class, 'handler'])->name('api.pertandingans.delete');
    });

    // Ranking
    Route::prefix('rankings')->group(function () {
        Route::post('/', [RankingCreateHandler::class, 'handler'])->name('api.rankings.create');
        Route::get('/', [RankingPaginationHandler::class, 'handler'])->name('api.rankings.pagination');
        Route::get('/{id}', [RankingDetailHandler::class, 'handler'])->name('api.rankings.detail');
        Route::put('/{id}', [RankingUpdateHandler::class, 'handler'])->name('api.rankings.update');
        Route::delete('/{id}', [RankingDeleteHandler::class, 'handler'])->name('api.rankings.delete');
    });
});

