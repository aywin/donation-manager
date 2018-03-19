<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

interface Dao {	

	public function save($object, $child = null, $tableName = null);

	public function delete($object);

	public function addAssoc($tableName, $properties);

	public function deleteAssoc($primaryClass, $foreignClass, $properties);

	public function find($class, $id);

	public function all($class);
	
	public function hasOne($object, $foreignClass, $foreignKey = null);

	public function hasMany($object, $foreignClass, $foreignKey = null);

	public function hasManyThrough($object, $tables = [], $condition = null);

	public function belongsTo($object, $foreignClass, $foreignKey = null);

	public function belongsToMany($object, $foreignClass, $pivotTable = null, $localPivotKey = null, $foreignPivotKey = null);
}