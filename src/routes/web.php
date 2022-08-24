<?php

use Elfcms\Simplebox\Models\SimpleboxDataType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>['web','cookie','start']],function(){

    Route::name('admin.')->middleware('admin')->group(function(){

        Route::name('simplebox.')->group(function(){
            Route::resource('/admin/simplebox/items', \Elfcms\Simplebox\Http\Controllers\Resources\SimpleboxItemController::class)->names(['index' => 'items']);
        });
        Route::get('/admin/ajax/json/simplebox/datatypes',function(Request $request){
            $result = [];
            if ($request->ajax()) {
                $result = SimpleboxDataType::all()->toArray();
                $result = json_encode($result);
            }
            return $result;
        });

    });

});
