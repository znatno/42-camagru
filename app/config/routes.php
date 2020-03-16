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
	'account/logout' => [
		'controller' => 'account',
		'action' => 'logout'
	],
	'account/register' => [
		'controller' => 'account',
		'action' => 'register'
	],
	'account/forgot' => [
		'controller' => 'account',
		'action' => 'forgot'
	],
	'account/confirm' => [
		'controller' => 'account',
		'action' => 'confirm'
	],

	// Create Controller
	'create/new' => [
		'controller' => 'create',
		'action' => 'new'
	],

];