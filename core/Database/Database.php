<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace Core\Database;

use Core\Interfaces\IDatabase;
use Core\Config;
use PDO;

class Database implements IDatabase {
	private static $db;

	public static function connect() {
		$connectionString = 'mysql:host='. env('DB_HOST') . ';dbname=' . env('DB_NAME') ;
		static::$db = new PDO($connectionString, env('DB_USER'), env('DB_PASSWORD'));		
		static::$db->exec('SET NAMES utf8');		
	}

	public static function query($query, $params = []) {
		$stmt = static::$db->prepare($query);
		$stmt->execute($params);

		return $stmt->fetchObject();
	}	

	public static function queryAll($query, $params = []) {
		$objects = [];

		$stmt = static::$db->prepare($query);
		$stmt->execute($params);

		while ($object = $stmt->fetchObject()) {
			$objects[] = $object;
		}

		return $objects;
	}

	public static function getPDO() {
		return static::$db;
	}

	// public static function getParams($properties = []) {
	// 	$subQuery = "";
	// 	foreach($properties as $key => $value) {
	// 		$subQuery .= " :{$key}";
	// 		if(end($properties) !== $value) $subQuery .= ',';
	// 	}

	// 	return $subQuery;
	// }

	// public static function getFields($properties = []) {
	// 	$subQuery = "";
	// 	foreach ($properties as $key => $value) {
	// 		$query .= "{$key}";
	// 		if(end($properties) !== $value) $query .= ', ';
	// 	}

	// 	return $subQuery;
	// }	
}