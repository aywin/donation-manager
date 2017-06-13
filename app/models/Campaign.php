<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Campaign extends Model {
	static $tableName = "campaigns";

	public function sheets() {
		return $this->hasMany('Sheet');
	}

	public function years() {
		$tableName = static::$tableName;
		return static::queryAll("SELECT DISTINCT year FROM {$tableName}");
	}
}