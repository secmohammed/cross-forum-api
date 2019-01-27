<?php

Route::get('section',App\Forum\Actions\IndexSectionAction::class);
Route::post('section',App\Forum\Actions\StoreSectionAction::class);
Route::delete('section/{section}',App\Forum\Actions\DeleteSectionAction::class);
Route::put('section/{section}', App\Forum\Actions\UpdateSectionAction::class);
Route::get('section/{section}',App\Forum\Actions\ShowSectionAction::class);
