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
	'account/confirm' => [
		'controller' => 'account',
		'action' => 'confirm'
	],
	'account/activate' => [
		'controller' => 'account',
		'action' => 'activate'
	],
	'account/forgot' => [
		'controller' => 'account',
		'action' => 'forgot'
	],
	'account/forgot-sent' => [
		'controller' => 'account',
		'action' => 'forgotSent'
	],
	'account/reset-password' => [
		'controller' => 'account',
		'action' => 'resetPassword'
	],
	'account/reset-password-change' => [
		'controller' => 'account',
		'action' => 'resetPasswordChange'
	],
	'account/reset-password-done' => [
		'controller' => 'account',
		'action' => 'resetPasswordDone'
	],

	// Create Controller
	'create/new' => [
		'controller' => 'create',
		'action' => 'new'
	],

];