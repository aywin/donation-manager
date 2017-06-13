<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Session extends Model {

	public static $keyName = "username";

	public static function lookFor($username, $password) {
		$password = md5($password);
		$query = "SELECT username FROM admins WHERE username = :username AND password = :password";
		$stmt = static::$db->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();

		return $stmt->fetchColumn();
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