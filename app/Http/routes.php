<?php

use Blade;

/*
|--------------------------------------------------------------------------
| Blade Configuration
|--------------------------------------------------------------------------
*/
Blade::setEscapedContentTags('[[', ']]');
Blade::setContentTags('[[[', ']]]');
Blade::extend(function($view, $compiler){
	$pattern = $compiler->createPlainMatcher('spaceless');
	return preg_replace($pattern, '$1<?php ob_start(); ?>$2', $view);
});
Blade::extend(function($view, $compiler){
	$pattern = $compiler->createPlainMatcher('endspaceless');
	return preg_replace($pattern, '$1<?php echo trim(preg_replace(\'/>\s+</\', \'><\', ob_get_clean())); ?>$2', $view);
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/view/{view}', 'UiController@handle');

Route::group(['prefix' => 'api'], function() {

	Route::resource('top-application', 'Api\TopApplicationController');
	Route::resource('application', 'Api\ApplicationController');
	Route::resource('application/{requestId}/status', 'Api\ApplicationStatusController');
});