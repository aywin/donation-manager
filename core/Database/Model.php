<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace Core\Database;

use Core\Dao\Dao;


class Model {

	protected $primaryKey = "id";
	protected $tableName;		
	protected $pivotName;
	protected $dao;

	public function __construct() {
		$this->tableName = $this->tableName ?? strtolower(class_basename($this));
		$this->pivotName = $this->pivotName ?? strtolower(class_basename($this));
		$this->dao = Dao::getInstance();
	}

	public function getPrimaryKey() {
		return $this->primaryKey;
	}

	public function getTableName() {
		return $this->tableName;
	}

	public function getPivotName() {
		return $this->pivotName;
	}

	public function setPK($pk) {
		$this->primaryKey = $pk;
	}

	public function setTableName($t) {
		$this->tableName = $t;
	}

	public function setPivotName($p) {
		$this->pivotName = $p;
	}

	public function save($child = null, $tableName = null) {
		return $this->dao->save($this, $child, $tableName);

	}

	public function delete() {
		return $this->dao->delete($this);
	}

	public static function addAssoc($tableName, $properties) {		
		return (new static)->dao->addAssoc($tableName, $properties);
	}

	public static function deleteAssoc($primaryClass, $foreignClass, $properties) {
		return (new static)->dao->deleteAssoc($primaryClass, $foreignClass, $properties);
	}

	public static function find($id) {
		$model = new static;
		return $model->dao->find($model, $id);
	}


	public static function all() {
		$model = new static;
		return $model->dao->all($model);
	}


	public function hasOne($foreignClass, $foreignKey = null) {
		return $this->dao->hasOne($this, new $foreignClass, $foreignKey);
	}


	public function hasMany($foreignClass, $foreignKey = null) {
		return $this->dao->hasMany($this, new $foreignClass, $foreignKey);
	}

	public function hasManyThrough($tables = [], $condition = null) {
		return $this->dao->hasManyThrough($this, $tables, $condition);

	}


	public function belongsTo($foreignClass, $foreignKey = null) {
		return $this->dao->belongsTo($this, new $foreignClass, $foreignKey);
	}		


	public function belongsToMany($foreignClass, $pivotTable = null, $localPivotKey = null, $foreignPivotKey = null) {
		return $this->dao->belongsToMany($this, new $foreignClass, $pivotTable, $localPivotKey, $foreignPivotKey);
	}

	public function getId() {
		return $this->{$this->primaryKey};
	}

	public function getProperties($child = false) {
		$properties = get_object_vars($this);
		$unused = [$this->primaryKey, 'primaryKey', 'tableName', 'pivotName', 'dao'];

		return $child ? $properties : array_diff_key($properties, array_flip($unused));
	}

	public static function count() {
		$model = new static;
		return $model->dao->count($model);
	}

}