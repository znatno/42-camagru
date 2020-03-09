<?php

return [

	// Main Controller
	'' => [
		'controller' => 'main',
		'action' => 'index'
	],

	// Account Controller
	'account/login' => [
		'controller' => 'account',
		'action' => 'login'
	],
	'account/register' => [
		'controller' => 'account',
		'action' => 'register'
	],
	'account/forgot' => [
		'controller' => 'account',
		'action' => 'forgot'
	],

	// Create Controller
	'create/new' => [
		'controller' => 'create',
		'action' => 'new'
	],

];