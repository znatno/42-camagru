<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller{

	public function loginAction() {
		// $this->view->redirect('/');
		$this->view->render('Login');
	}

	public function registerAction() {
		$this->view->render('Register');
	}

	// - ONLY for AJAX tests
	// TODO: RM this
	public function formsAction() {
		$this->view->render('Forms Test');
	}
	public function form1Action() {
		$this->view->render('Forms Test');
	}
	public function form2Action() {
		$this->view->render('Forms Test');
	}

}