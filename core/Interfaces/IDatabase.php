<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace Core\Interfaces;

interface IDatabase {
	
	public static function connect() ;

	public static function query($query, $params = []);

	public static function queryAll($query, $params = []);

	public static function getPDO();
}