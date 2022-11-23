<?php

use Elfcms\Simplebox\Models\SimpleboxDataType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$adminPath = Config::get('elfcms.basic.admin_path') ?? '/admin';

Route::group(['middleware'=>['web','cookie','start']],function() use ($adminPath) {

    Route::name('admin.')->middleware('admin')->group(function() use ($adminPath) {

        Route::name('simplebox.')->group(function() use ($adminPath) {
            Route::resource($adminPath . '/simplebox/items', \Elfcms\Simplebox\Http\Controllers\Resources\SimpleboxItemController::class)->names(['index' => 'items']);
        });
        Route::get($adminPath . '/ajax/json/simplebox/datatypes',function(Request $request){
            $result = [];
            if ($request->ajax()) {
                $result = SimpleboxDataType::all()->toArray();
                $result = json_encode($result);
            }
            return $result;
        });

    });

});
