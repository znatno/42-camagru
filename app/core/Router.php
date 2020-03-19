<?php

namespace app\core;


class Router {

	protected $routes = [];
	protected $params = [];

	function __construct() {
		$arr = require 'app/config/routes.php';
		foreach ($arr as $key => $val) {
			$this->add($key, $val);
		}
	}

	public function add($route, $params) {
		$route = '#^'.$route.'$#';
		$this->routes[$route] = $params;
	}

	public function match() {
		$url = trim($_SERVER['REQUEST_URI'], '/');

		if (!empty($_GET)) {
			$url = strstr($url, '?', true);
		}

		foreach ($this->routes as $route => $params) {
			if (preg_match($route, $url, $matches)) {
				$this->params = $params;

				return true;
			}
		}

		return false;
	}

	public function run() {
		if ($this->match()) {
			$path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
			if (class_exists($path)) {
				$action = $this->params['action'].'Action';
				if (method_exists($path, $action)) {
					$controller = new $path($this->params);
					$controller->$action();
				} else {
					echo "<i>No such method: ".$action."</i><br>";
					View::errorCode(404);
				}
			} else {
				echo "<i>No such class: ".$path."</i><br>";
				View::errorCode(404);
			}
		} else {
			echo "<i>No such route</i><br>";
			View::errorCode(404);
		}
	}


}