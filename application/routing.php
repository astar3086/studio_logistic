<?php
/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('default', '')
		->defaults([
				'controller' => 'index',
				'action'     => 'index',
		]);


// Mobile routes
Route::set('MobileRoute', 'mobile(/<controller>(/<action>(/<id>)))')
		->defaults(array(
				'directory'  => 'Mobile',
				'controller' => 'Places',
				'action'     => 'index',
		));

// Admin routes
Route::set('SystemRoute', 'admin(/<controller>(/<action>(/<id>)))')
		->defaults(array(
				'directory'  => 'Admin',
				'controller' => 'Main',
				'action'     => 'index',
		));

Route::set('register', 'register')
		->defaults([
				'controller' => 'Auth',
				'action'     => 'register',
		]);

Route::set('page', 'pages/alias/<alias>')
		->defaults([
				'controller' => 'pages',
				'action'     => 'display',
		]);

Route::set('recovery', 'auth/recovery/(<recovery>)')
		->defaults([
				'controller' => 'auth',
				'action'     => 'recovery',
		]);

Route::set('pages', '<controller>(/<action>)(/<id>)(/&page=<page>&)(/recovery/<recovery>)(/alias/<alias>)', array('page' => '[0-9]+'))
		->defaults([
				'controller' => '',
				'action'     => 'index',
		]);
