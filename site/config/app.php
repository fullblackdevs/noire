<?php
return [
	'App' => [
		'name' => 'noire',
		'version' => '0.1.0',
	],
	'Registry' => [
		'default' => [
			'connection' => env('REGISTRY_CONNECTION'),
			'format' => env('REGISTRY_FORMAT'),
		],
		'dev' => [
			'format' => 'json',
			'connection' => 'local',
		],
		'live' => [
			'format' => 'json',
			'connection' => 'aws',
		],
	],
];
