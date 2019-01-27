<?php

Route::group(['middleware' => 'guest:api', 'prefix' => 'auth'], function () {
    Route::post('register', App\Users\Actions\RegisterUserAction::class);
    Route::post('login', App\Users\Actions\LoginUserAction::class);
    Route::post('forgot-password', App\Users\Actions\ForgotUserPasswordAction::class)->name('forgot.password');
    Route::post('reset-password', App\Users\Actions\ResetUserPasswordAction::class)->name('password.reset');
});
Route::get('section', App\Forum\Actions\IndexSectionAction::class);
Route::get('section/{section}',App\Forum\Actions\ShowSectionAction::class);

Route::group(['middleware' => 'auth:api'], function () {
	Route::get('/user', App\Users\Actions\AuthorizedUserAction::class);
	Route::post('/section', App\Forum\Actions\StoreSectionAction::class);
    Route::delete('section/{section}',App\Forum\Actions\DeleteSectionAction::class);
    Route::post('section/{section}/update', App\Forum\Actions\UpdateSectionAction::class);
    Route::post('auth/logout', App\Users\Actions\LogoutUserAction::class);

    Route::post('/topic', App\Forum\Actions\StoreTopicAction::class);
    Route::delete('/topic/{topic}', App\Forum\Actions\DeleteTopicAction::class);
    Route::post('/topic/{topic}/update', App\Forum\Actions\UpdateTopicAction::class);

    Route::post('/topic/{topic}/post', App\Forum\Actions\StorePostAction::class);
    Route::post('/topic/{topic}/post/{post}/update', App\Forum\Actions\UpdatePostAction::class);
    Route::delete('/topic/{topic}/post/{post}', App\Forum\Actions\DeletePostAction::class);
});
Route::get('/topic', App\Forum\Actions\IndexTopicAction::class);
Route::get('/topic/{topic}', App\Forum\Actions\ShowTopicAction::class);



