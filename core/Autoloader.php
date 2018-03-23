<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace Core;


class Autoloader {

	public static function register() {
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	public static function autoload($class) {
		

		$class = str_replace('\\', '/', lcfirst($class));
		
		require_once __DIR__ . '/../' . $class . '.php';
	}
	 

}