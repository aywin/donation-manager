<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Core;


class Autoloader {

	public static function register() {
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	public static function autoload($class) {
		
		$class = str_replace('App\\', '', $class);
		$class = str_replace('\\', '/', $class);
		
		require_once __DIR__ . '/../' . $class . '.php';
	}
	 

}