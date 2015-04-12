<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| This testing database will override the default database settings.
	|
	*/


	'connections' => array(

		'testing' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'art-test',
			'username'  => 'root',
			'password'  => 'root',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		)
	),

);
