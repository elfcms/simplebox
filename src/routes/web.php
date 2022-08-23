<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>['web','cookie','start']],function(){

    Route::name('admin.')->middleware('admin')->group(function(){

        Route::name('simplebox.')->group(function(){
            Route::resource('/admin/simplebox/items', Elfcms\Simplebox\Http\Controllers\Resources\SimpleboxItemController::class)->names(['index' => 'items']);
        });

    });

});
