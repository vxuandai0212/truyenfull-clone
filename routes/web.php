<?php
Route::get('/search/ajax', 'SearchController@search');
Route::get('ajax-subcathot', 'SearchController@hotCategory');
Route::get('ajax-subcatnew', 'SearchController@newCategory');
Route::get('ajax-hotlist', 'SearchController@hotlist');

Route::resource('authors', 'AuthorController', ['except' => 'show']);
Route::resource('genders', 'GenderController', ['except' => 'show']);
Route::resource('catalogs', 'CatalogController', ['except' => 'show']);
Route::resource('books', 'BookController', ['except' => 'show']);
Route::resource('chapters', 'ChapterController', ['except' => 'show']);

Route::get('tac-gia/{author_slug}', 'AuthorController@show')->name('author');


Route::get('the-loai/{genre_slug}', 'GenderController@show')->name('genre');


Route::get('danh-sach/truyen-moi', 'CatalogController@updatedBooks');
Route::get('danh-sach/truyen-hot', 'CatalogController@hotBooks');
Route::get('danh-sach/truyen-full', 'CatalogController@completeBooks');
Route::get('danh-sach/ngon-tinh-sac', 'CatalogController@ngontinhsac');
Route::get('danh-sach/ngon-tinh-nguoc', 'CatalogController@ngontinhnguoc');
Route::get('danh-sach/ngon-tinh-sung', 'CatalogController@ngontinhsung');
Route::get('danh-sach/dam-my-h-van', 'CatalogController@dammi');


Route::get('{book_slug}', 'BookController@show')->name('book')->middleware('filter');


Route::get('{book_slug}/{chapter_slug}', 'ChapterController@show')->name('chapter');


Route::get('/', 'BookController@home')->name('home');



