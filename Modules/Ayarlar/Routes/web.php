<?php
    use Modules\Ayarlar\Http\Controllers\AyarlarController;
    Route::prefix('Ayarlar')->group(function (){
        Route::middleware('auth')->group(function (){
            Route::get('/', [AyarlarController::class, 'index'])->name('Ayarlar.index');
            Route::get('/getSirket', [AyarlarController::class, 'getSirket'])->name('Ayarlar.getSirket');
            Route::post('/storeSube', [AyarlarController::class, 'storeSube'])->name('Ayarlar.storeSube');
            Route::post('/storeDepartman', [AyarlarController::class, 'storeDepartman'])->name('Ayarlar.storeDepartman');
            Route::post('/storeUnvan', [AyarlarController::class, 'storeUnvan'])->name('Ayarlar.storeUnvan');

            Route::get('/getTatil', [AyarlarController::class, 'getTatil'])->name('Ayarlar.getTatil');
            Route::post('/storeTatil', [AyarlarController::class, 'storeTatil'])->name('Ayarlar.storeTatil');
        });
    });
//    Route::resource('/ayarlar', 'AyarlarController')->middleware('auth');

