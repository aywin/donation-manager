<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace Core\Dao;

use Core\Interfaces\IDao;
use Core\Database\Database;

class Dao implements IDao {
	private $db;
	private static $instance;

	private function __construct() {
		$this->db = Database::getPDO();
	}

	public static function getInstance() {
		return static::$instance ?? new Dao();
	}

	public function getDB() {
		return $this->db;
	}

	public function save($object, $child = null, $tableName = null) {
		$tableName = $tableName ?? $object->getTableName();
		$primaryKey = $object->getPrimaryKey();
		$properties = $object->getProperties($child);

		$params = [];


		if($object->getId() AND !$child) {
			$query = "UPDATE {$tableName} SET ";

			foreach($properties as $key => $value) {
				$query .= "{$key} = ?";
				if(end($properties) !== $value) $query .= ', ';
				$params[] = $value;
			}

			$params[] = $object->getId();
			$query .= " WHERE {$primaryKey} = ?";
		} else {
			$fields = '';
			$values = '';

			foreach($properties as $key => $value) {
				$fields .= "{$key}";
				$values .= "?";
				$params[] = $value;				
				if($key !== key(array_slice($properties, -1, 1, TRUE ))) {$fields .= ', '; $values .= ', ';}
			}	

			$query = "INSERT INTO {$tableName} (" . $fields . ") VALUES (" . $values . ")";
		}
	
		$stmt = $this->db->prepare($query);	



		if ($stmt->execute($params)) 
			return ($object->getId() ?? $child) ?? $this->db->lastInsertId();
		else 
			return false;

	}

	public function delete($object) {
		$tableName = $object->getTableName();
		$primaryKey = $object->getPrimaryKey();

		$query = "DELETE FROM {$tableName} WHERE {$primaryKey} = :id";

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $object->getId(), \PDO::PARAM_INT);
		return $stmt->execute();
	}

	public function addAssoc($tableName, $properties) {		
		$query = "INSERT INTO {$tableName} VALUES (?,?)";
		$stmt = $this->db->prepare($query);
		return $stmt->execute($properties);
	}

	public function deleteAssoc($tableName, $properties) {
		$keys = array_keys($properties);
		$properties = array_values($properties);
		$query = "DELETE FROM {$tableName} WHERE {$keys[0]} = ? AND {$keys[1]} = ?";
		$stmt = $this->db->prepare($query);
		return $stmt->execute($properties);
	}

	public function find($model, $id) {
		$tableName = $model->getTableName();
		$primaryKey =  $model->getPrimaryKey();

		$query = "SELECT * FROM {$tableName} WHERE {$primaryKey} = ? LIMIT 1";

		return $this->fetch($query, [$id], get_class($model));
	}


	public function all($model) {
		$tableName = $model->getTableName();
		$primaryKey = $model->getPrimaryKey();
		$objects = [];

		$query = "SELECT * FROM {$tableName} ORDER BY {$primaryKey} DESC";

		$stmt = $this->db->query($query);

		return $this->fetchAll($query, [], get_class($model));
	}


	public function hasOne($object, $foreignObject, $foreignKey = null) {
		$tableName = $foreignObject->getTableName();
		$primaryKey = $object->getPrimaryKey();
		$foreignKey = $foreignKey ?? $object->getPivotName() . '_' . $foreignObject->getPrimaryKey();
		
		$query = "SELECT * FROM {$tableName} WHERE {$foreignKey} = ?";		


		return $this->fetch($query, [$object->getId()], get_class($foreignObject));
	}


	public function hasMany($object, $foreignObject, $foreignKey = null) {
		$tableName = $foreignObject->getTableName();
		$primaryKey = $object->getPrimaryKey();
		$foreignKey = $foreignKey ?? $object->getPivotName() . '_' . $foreignObject->getPrimaryKey();

		$query = "SELECT * FROM {$tableName} WHERE {$foreignKey} = ?";		

		return static::fetchAll($query, [$object->getId()], get_class($foreignObject));
	}

	public function hasManyThrough($object, $tables = [], $condition = null) {
		$foreignObject = new $tables[0][0];

		$tableName = $foreignObject->getTableName();
		$primaryKey = $object->getPrimaryKey();

		$query = "SELECT {$tableName}.* FROM  {$tableName}";

		for ($i = 1; $i < sizeof($tables); $i++) {
			$leftTable = (new $tables[$i-1][0])->getTableName();
			$rightTable = (new $tables[$i][0])->getTableName();

			$leftKey = $tables[$i-1][1];
			$rightKey = (new $tables[$i][0])->getPrimaryKey();

			$query .= " LEFT JOIN {$rightTable} ON {$leftTable}.{$leftKey}={$rightTable}.{$rightKey}";

		}

		$rightKey = end($tables)[1];
		$query .= " WHERE {$rightTable}.{$rightKey} = ?";
		$query .= $condition ? ' AND '.$condition : '';

		return $this->fetchAll($query, [$object->getId()], get_class($foreignObject));

	}


	public function belongsTo($object, $foreignObject, $foreignKey = null) {
		$tableName = $foreignObject->getTableName();
		$primaryKey = $foreignObject->getPrimaryKey();
		$foreignKey = $foreignKey ?? $foreignObject->getPivotName() . '_' . $foreignObject->getPrimaryKey();

		$query = "SELECT * FROM {$tableName} WHERE {$primaryKey} = ?";		

		return $this->fetch($query, [$object->$foreignKey], get_class($foreignObject));
	}		


	public function belongsToMany($object, $foreignObject, $pivotTable = null, $localPivotKey = null, $foreignPivotKey = null) {
		$pivotTable = $pivotTable ?? $object->getPivotName() . '_' . $foreignObject->getPivotName();
		$localPivotKey = $localPivotKey ?? $object->getPivotName() . '_' . $object->getPrimaryKey();
		$foreignPivotKey = $foreignPivotKey ?? $foreignObject->getPivotName() . '_' . $foreignObject->getPrimaryKey();

		$tableName = $foreignObject->getTableName();		
		$primaryKey = $foreignObject->getPrimaryKey();

		$query = "SELECT {$tableName}.*, {$pivotTable}.* FROM {$tableName} INNER JOIN {$pivotTable} ON {$pivotTable}.{$foreignPivotKey} = {$tableName}.{$primaryKey} AND {$pivotTable}.{$localPivotKey} = ?";

		return $this->fetchAll($query, [$object->getId()], get_class($foreignObject));
	}

	public function fetch($query, $params = [], $className) {
		$stmt = $this->db->prepare($query);

		if(!$stmt->execute($params)) {
			error($stmt->errorInfo()[2]);
			exit();
		}

		return $stmt->fetchObject($className);

	}

	public function fetchAll($query, $params = [], $className) {
		$objects = [];

		$stmt = $this->db->prepare($query);

		if(!$stmt->execute($params)) {
			error($stmt->errorInfo()[2]);
			exit();
		}

		while ($object = $stmt->fetchObject($className)) {
			$objects[] = $object;
		}

		return $objects;
	}

	public function count($model) {
		$tableName = $model->getTableName();
		$query = "SELECT COUNT(*) as count FROM {$tableName}";
		return Database::query($query)->count;
	}	



	public function lookFor($username, $password) {
		$password = md5($password);
		$query = "SELECT username FROM admins WHERE username = :username AND password = :password";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();

		return $stmt->fetchColumn();
	}

}