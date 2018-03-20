<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App;

use \Core\Router;

class App {
	private $router;

	public function __construct() {
		$this->router = new Router();
		$this->router->route($this->parseUrl());
	}

	protected function parseUrl() {
		if(isset($_GET['url'])) {
			 return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}

	 

}