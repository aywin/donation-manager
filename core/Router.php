<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace Core;

class Router {

	protected $controller = 'App\\Controllers\\HomeController';
	protected $method = "index";
	protected $params = [];
	protected $controllersNamespace = "App\\Controllers\\";

	public function route($url) {

		$controllerClass = $this->controllersNamespace . ucfirst(strtolower($url[0])).'Controller';

		if(class_exists($controllerClass) && isset($url[0])) {
			$this->controller = $controllerClass;
			unset($url[0]);
		}

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
	 

}