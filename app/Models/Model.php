<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Models;


abstract class Model {

	public static $primaryKey = "id";
	public static $tableName;		
	protected static $dao;

	public function save($child = null, $tableName = null) {
		return static::$dao->save($this, $child, $tableName);

	}

	public function delete() {
		return static::$dao->delete($this);
	}

	public static function addAssoc($tableName, $properties) {		
		return static::$dao->addAssoc($tableName, $properties);
	}

	public static function deleteAssoc($primaryClass, $foreignClass, $properties) {
		return static::$dao->deleteAssoc($primaryClass, $foreignClass, $properties);
	}

	public static function find($id) {
		return static::$dao->find(static::class, $id);
	}


	public static function all() {
		return static::$dao->all(static::class);
	}


	public function hasOne($foreignClass, $foreignKey = null) {
		return static::$dao->hasOne($this, $foreignClass, $foreignKey);
	}


	public function hasMany($foreignClass, $foreignKey = null) {
		return static::$dao->hasMany($this, $foreignClass, $foreignKey);
	}

	public function hasManyThrough($tables = [], $condition = null) {
		return static::$dao->hasManyThrough($this, $tables, $condition);

	}


	public function belongsTo($foreignClass, $foreignKey = null) {
		return static::$dao->belongsTo($this, $foreignClass, $foreignKey);
	}		


	public function belongsToMany($foreignClass, $pivotTable = null, $localPivotKey = null, $foreignPivotKey = null) {
		return static::$dao->belongsToMany($this, $foreignClass, $pivotTable, $localPivotKey, $foreignPivotKey);
	}

	public function getPrimaryKey() {
		$properties = get_object_vars($this);
		if(isset($properties[static::$primaryKey]))
			return $properties[static::$primaryKey];
		else
			return null;
	}

	public function getProperties($child = false) {
		$properties = get_object_vars($this);
		return $child ? $properties : array_diff($properties, [static::$primaryKey => $this->getPrimaryKey()]);
	}

	public static function count() {
		return static::$dao->count(static::class);
	}

	public static function staticInit($daoImpl) {
		static::$dao = $daoImpl;
	}


}