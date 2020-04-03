<?php

return [

	// Main Controller
	'' => [
		'controller' => 'main',
		'action' => 'index'
	],
	'action/like' => [
		'controller' => 'main',
		'action' => 'changeLike'
	],
	'action/dislike' => [
		'controller' => 'main',
		'action' => 'changeLike'
	],

	// Account Controller
	'account/login' => [
		'controller' => 'account',
		'action' => 'login'
	],
	'account/login-validate' => [
		'controller' => 'account',
		'action' => 'loginValidate'
	],
	'account/logout' => [
		'controller' => 'account',
		'action' => 'logout'
	],
	// - Sign Up Flow
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
	// - Reset Password Flow
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
	'account/reset-password-success' => [
		'controller' => 'account',
		'action' => 'resetPasswordSuccess'
	],
	// - Profile Flow
	'account/profile' => [
		'controller' => 'account',
		'action' => 'showProfile'
	],
	'account/profile-save' => [
		'controller' => 'account',
		'action' => 'showProfileSaveChanges'
	],

	// Create Controller
	'create/new' => [
		'controller' => 'create',
		'action' => 'newPost'
	],
	'create/new-upload' => [
		'controller' => 'create',
		'action' => 'uploadFile'
	],
	'create/remove' => [
		'controller' => 'create',
		'action' => 'removeImage'
	],

];