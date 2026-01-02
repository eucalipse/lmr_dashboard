<?php

	Route::group(['middleware' => 'auth'], function () {
		Route::get('lmr_access/', 'Admin@index');
		Route::get('lmr_access/{name}', 'Admin@index')->where('name', '(.*)');
		Route::post('lmr_access/{name}', 'Admin@index')->where('name', '(.*)');
	});

	Route::group(['middleware' => 'web'], function () {
		Route::get('/script/{name}', 'Script@index')->where('name', '(.*)');
		
		Route::get('/statystyka/details', 'Index@mainCategory1');
		Route::get('/jakist-zyttia/details', 'Index@mainCategory2');
		Route::get('/strategia/details', 'Index@mainCategory3');
		Route::get('/concepcia/details', 'Index@mainCategory4');

		Route::get('/', 'Index@index');
		Route::get('/{name}', 'Index@index')->where('name', '(.*)');
		Route::post('/{name}', 'Index@index')->where('name', '(.*)');
	});

?>