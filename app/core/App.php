<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


class App {

	protected $controller = 'HomeController';
	protected $method = "index";
	protected $params = [];

	static $controllersDir = "../app/controllers/";

	public function __construct() {
		$url = $this->parseUrl();

		if(file_exists(static::$controllersDir.ucfirst(strtolower($url[0])).'Controller.php')) {
			$this->controller = ucfirst(strtolower($url[0])).'Controller';
			unset($url[0]);
		}

		require_once static::$controllersDir.$this->controller.'.php';

		$this->controller = new $this->controller;

		if(isset($url[1])) {
			if(method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : []; 

		call_user_func_array([$this->controller, $this->method], $this->params); 



	}

	protected function parseUrl() {
		if(isset($_GET['url'])) {
			 return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}

	 

}