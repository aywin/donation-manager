<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class DaoImpl implements Dao {
	private $db;
	private static $instance;

	private function __construct() {
		$this->db = Database::getPDO();
	}

	public static function getInstance() {
		if(!isset(static::$instance))
			static::$instance = new DaoImpl();

		return static::$instance;
	}

	public function save($object, $child = null, $tableName = null) {
		$class = get_class($object);
		$tableName = $tableName ?? $class::$tableName;
		$primaryKey = $class::$primaryKey;
		$properties = $object->getProperties($child);

		$params = [];


		if($object->getPrimaryKey() AND !$child) {
			$query = "UPDATE {$tableName} SET ";

			foreach($properties as $key => $value) {
				$query .= "{$key} = ?";
				if(end($properties) !== $value) $query .= ', ';
				$params[] = $value;
			}

			$params[] = $object->getPrimaryKey();
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
			return ($object->getPrimaryKey() ?? $child) ?? $this->db->lastInsertId();
		else 
			return false;

	}

	public function delete($object) {
		$class = get_class($object);
		$tableName = $class::$tableName;
		$primaryKey = $class::$primaryKey;

		$query = "DELETE FROM {$tableName} WHERE {$primaryKey} = :id";

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $object->getPrimaryKey(), \PDO::PARAM_INT);
		return $stmt->execute();
	}

	public function addAssoc($tableName, $properties) {		
		$query = "INSERT INTO {$tableName} VALUES (?,?)";
		$stmt = $this->db->prepare($query);
		return $stmt->execute($properties);
	}

	public function deleteAssoc($primaryClass, $foreignClass, $properties) {
		$tableName = strtolower($primaryClass) . '_' . strtolower($foreignClass);
		$keys = array_keys($properties);
		$properties = array_values($properties);
		$query = "DELETE FROM {$tableName} WHERE {$keys[0]} = ? AND {$keys[1]} = ?";
		$stmt = $this->db->prepare($query);
		return $stmt->execute($properties);
	}

	public function find($class, $id) {
		$tableName = $class::$tableName;
		$primaryKey =  $class::$primaryKey;

		$query = "SELECT * FROM {$tableName} WHERE {$primaryKey} = ? LIMIT 1";

		return $this->fetch($query, [$id], $class);
	}


	public function all($class) {
		$tableName = $class::$tableName;
		$primaryKey = $class::$primaryKey;
		$objects = [];

		$query = "SELECT * FROM {$tableName} ORDER BY {$primaryKey} DESC";

		$stmt = $this->db->query($query);

		return $this->fetchAll($query, [], $class);
	}


	public function hasOne($object, $foreignClass, $foreignKey = null) {
		$class = get_class($object);
		$tableName = $foreignClass::$tableName;
		$primaryKey = $class::$primaryKey;
		$foreignKey = $foreignKey ?? $class . '_' . $foreignClass::$primaryKey;
		
		$query = "SELECT * FROM {$tableName} WHERE {$foreignKey} = ?";		


		return $this->fetch($query, [$object->$primaryKey], $foreignClass);
	}


	public function hasMany($object, $foreignClass, $foreignKey = null) {
		$class = get_class($object);
		$tableName = $foreignClass::$tableName;
		$primaryKey = $class::$primaryKey;
		$foreignKey = $foreignKey ?? $class . '_' . $foreignClass::$primaryKey;

		$query = "SELECT * FROM {$tableName} WHERE {$foreignKey} = ?";		

		return static::fetchAll($query, [$object->$primaryKey], $foreignClass);
	}

	public function hasManyThrough($object, $tables = [], $condition = null) {
		$class = get_class($object);
		$foreignClass = $tables[0][0];
		$tableName = $foreignClass::$tableName;
		$primaryKey = $class::$primaryKey;

		$query = "SELECT {$tableName}.* FROM  {$tableName}";

		for ($i = 1; $i < sizeof($tables); $i++) {
			$leftTable = $tables[$i-1][0]::$tableName;
			$rightTable = $tables[$i][0]::$tableName;

			$leftKey = $tables[$i-1][1];
			$rightKey =$tables[$i][0]::$primaryKey;

			$query .= " LEFT JOIN {$rightTable} ON {$leftTable}.{$leftKey}={$rightTable}.{$rightKey}";

		}

		$rightKey = end($tables)[1];
		$query .= " WHERE {$rightTable}.{$rightKey} = ?";
		$query .= $condition ? ' AND '.$condition : '';

		return $this->fetchAll($query, [$object->$primaryKey], $foreignClass);

	}


	public function belongsTo($object, $foreignClass, $foreignKey = null) {
		$tableName = $foreignClass::$tableName;
		$primaryKey = $foreignClass::$primaryKey;
		$foreignKey = $foreignKey ?? strtolower($foreignClass) . '_' . $foreignClass::$primaryKey;

		$query = "SELECT * FROM {$tableName} WHERE {$primaryKey} = ?";		

		return $this->fetch($query, [$object->$foreignKey], $foreignClass);
	}		


	public function belongsToMany($object, $foreignClass, $pivotTable = null, $localPivotKey = null, $foreignPivotKey = null) {
		$class = get_class($object);
		$pivotTable = $pivotTable ?? $class . '_' . strtolower($foreignClass);
		$localPivotKey = $localPivotKey ?? $class . '_' . $class::$primaryKey;
		$foreignPivotKey = $foreignPivotKey ?? strtolower($foreignClass) . '_' . $foreignClass::$primaryKey;

		$tableName = $foreignClass::$tableName;		
		$primaryKey = $foreignClass::$primaryKey;

		$query = "SELECT {$tableName}.*, {$pivotTable}.* FROM {$tableName} INNER JOIN {$pivotTable} ON {$pivotTable}.{$foreignPivotKey} = {$tableName}.{$primaryKey} AND {$pivotTable}.{$localPivotKey} = ?";

		return $this->fetchAll($query, [$object->$primaryKey], $foreignClass);
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

	public function count($class) {
		$tableName = $class::$tableName;
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