<?php
use Illuminate\Support\Facades\Route;

Route::get('greeting', function () {
    return 'Hi, this is your awesome package! Unw';
});

Route::get('unw/test', 'EdgeWizz\Unw\Controllers\UnwController@test')->name('test');

Route::post('fmt/unjumblewords/store', 'EdgeWizz\Unw\Controllers\UnwController@store')->name('fmt.unw.store');

Route::post('fmt/unjumblewords/csv_upload/store', 'EdgeWizz\Unw\Controllers\UnwController@uploadFile')->name('fmt.unw.csv_upload');

Route::post('fmt/unjumblewords/update/{id}', 'EdgeWizz\Unw\Controllers\UnwController@update')->name('fmt.unw.update');
Route::any('fmt/unjumblewords/inactive/{id}',  'EdgeWizz\Unw\Controllers\UnwController@inactive')->name('fmt.unw.inactive');
Route::any('fmt/unjumblewords/active/{id}',  'EdgeWizz\Unw\Controllers\UnwController@active')->name('fmt.unw.active');
