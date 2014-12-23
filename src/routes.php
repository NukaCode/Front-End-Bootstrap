<?php

$router->group(['namespace' => 'NukaCode\Bootstrap\Controllers'], function ($router) {
	/*
	|--------------------------------------------------------------------------
	| Admin
	|--------------------------------------------------------------------------
	*/
	$router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
		/*
		|--------------------------------------------------------------------------
		| Style
		|--------------------------------------------------------------------------
		*/
		$router->group(['prefix' => 'style'], function ($router) {
			$router->get('/theme', [
				'as'   => 'admin.style.theme',
				'uses' => 'StyleController@getTheme'
			]);
			$router->post('/theme', [
				'as'   => 'admin.style.theme',
				'uses' => 'StyleController@postTheme'
			]);
			$router->get('/', [
				'as'   => 'admin.style.index',
				'uses' => 'StyleController@index'
			]);
		});
	});
});