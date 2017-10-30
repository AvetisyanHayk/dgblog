<?php

Route::group(['prefix' => 'manage/posts'], function () {

    Route::get('/', [
        'uses' => 'PostController@postsAdminGetPosts',
        'as' => '_admin.posts'
    ]);

});

