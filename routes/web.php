<?php

declare(strict_types=1);

use App\Http\Controllers\BreedsController;
use App\Http\Controllers\CatsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api'], function () {
    Route::post('/catsList', [CatsController::class, 'catsList'])->name('cats.list');
    Route::post('/breedsList', [BreedsController::class, 'breedsList'])->name('breeds.list');

    Route::post('/getCatData', [CatsController::class, 'getCatData'])->name('cats.data');
    Route::post('/saveCat', [CatsController::class, 'saveCat'])->name('cats.save');
    Route::post('/deleteCat', [CatsController::class, 'deleteCat'])->name('cats.delete');

    Route::post('/refreshPhoto', [CatsController::class, 'refreshPhoto'])->name('cats.refreshPhoto');

    Route::post('/getBreedData', [BreedsController::class, 'getBreedData'])->name('breeds.data');
    Route::post('/saveBreed', [BreedsController::class, 'saveBreed'])->name('breeds.save');
    Route::post('/deleteBreed', [BreedsController::class, 'deleteBreed'])->name('breeds.delete');
});

Route::get('/{any}', fn() => view('spa'))
    ->where('any', '.*')
    ->name('spa');
