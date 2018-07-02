<?php

Route::group([
    
    'middleware' => 'api',
], function ($router) {
    
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink','sendPasswordController@sendEmail');
    Route::post('changePassword','changePasswordController@proccess');
    Route::post('/upload','UploadcsvController@upload');
    Route::post('/upload-material','UploadcsvController@uploadMaterial');
    Route::post('/upload-images','ImagesController@uploadImages');
    Route::apiResource('/quiz', 'QuizController');
    Route::apiResource('/quiz-material', 'QuizmaterialController');
    
});
