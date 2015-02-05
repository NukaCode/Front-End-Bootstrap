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
			$router->get('/theme-colors', [
				'as'   => 'admin.style.theme.colors',
				'uses' => 'StyleController@getThemeColors'
			]);
			$router->post('/theme-colors', [
				'as'   => 'admin.style.theme.colors',
				'uses' => 'StyleController@postThemeColors'
			]);
			$router->get('/theme-change', [
				'as'   => 'admin.style.theme.change',
				'uses' => 'StyleController@getThemeChange'
			]);
			$router->post('/theme-change', [
				'as'   => 'admin.style.theme.change',
				'uses' => 'StyleController@postThemeChange'
			]);
			$router->get('/theme-versions/{name}', [
				'as'   => 'admin.style.theme.versions',
				'uses' => 'StyleController@getBowerThemeVersions'
			]);
			$router->get('/kitchen-sink', [
				'as'   => 'admin.style.kitchenSink',
				'uses' => 'StyleController@kitchenSink'
			]);
			$router->get('/config-refresh', [
				'as'   => 'admin.style.config.refresh',
				'uses' => 'StyleController@configRefresh'
			]);
			$router->get('/', [
				'as'   => 'admin.style.index',
				'uses' => 'StyleController@index'
			]);
		});
	});
});