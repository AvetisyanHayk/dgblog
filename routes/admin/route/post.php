<?php

Route::group(['prefix' => 'manage/post'], function () {

    Route::get('new', function () {
        return view('admin.post');
    });

    Route::post('new', [
        'uses' => 'PostController@postAdminCreate',
        'as' => '_admin.post.create'
    ]);

    Route::get('report', [
        'uses' => 'PostController@postAdminReport',
        'as' => '_admin.post.report'
    ]);

    Route::get('{reference}', [
        'uses' => 'PostController@postAdminEdit',
        'as' => '_admin.post.edit'
    ]);

    Route::post('{reference}', [
        'uses' => 'PostController@postAdminUpdate',
        'as' => '_admin.post.edit'
    ]);

    Route::post('{id}/remove', [
        'uses' => 'PostController@postAdminDelete',
        'as' => '_admin.post.delete'
    ]);

});

