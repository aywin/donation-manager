<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace Core\Interfaces;


interface IDao {	

	public function save($object, $child = null, $tableName = null);

	public function delete($object);

	public function addAssoc($tableName, $properties);

	public function deleteAssoc($tableName, $properties);

	public function find($model, $id);

	public function all($model);
	
	public function hasOne($object, $foreignObject, $foreignKey = null);

	public function hasMany($object, $foreignObject, $foreignKey = null);

	public function hasManyThrough($object, $tables = [], $condition = null);

	public function belongsTo($object, $foreignObject, $foreignKey = null);

	public function belongsToMany($object, $foreignObject, $pivotTable = null, $localPivotKey = null, $foreignPivotKey = null);
}