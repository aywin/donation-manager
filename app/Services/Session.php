<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Services;

use App\Models\Member;


class Session {

	public static $keyName = "username";

	public static function lookFor($username, $password) {
		return Member::lookFor($username, $password);
	}

	public static function check() {
		return isset($_SESSION[static::$keyName]);
	}

	public static function setSession($username, $password) {
		if($username = static::lookFor($username, $password)) {
			$_SESSION[static::$keyName] = $username;
			return true;
		} else {
			return false;
		}
	}

	public static function getSession($key) {
		return $_SESSION[$key];
	}

	public static function start() {
		session_start();
	}

	public static function destroy() {
		session_destroy();
		session_unset();
	}

}