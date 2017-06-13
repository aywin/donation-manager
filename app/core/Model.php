<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

abstract class Model extends Database {

	protected static $primaryKey = "id";
	protected static $tableName;		

	public function save($child = null, $tableName = null) {
		$tableName = $tableName ?? static::$tableName;
		$primaryKey = static::$primaryKey;
		$properties = $this->getProperties($child);

		$params = [];


		if($this->getPrimaryKey() AND !$child) {
			$query = "UPDATE {$tableName} SET ";

			foreach($properties as $key => $value) {
				$query .= "{$key} = ?";
				if(end($properties) !== $value) $query .= ', ';
				$params[] = $value;
			}

			$params[] = $this->getPrimaryKey();
			$query .= " WHERE {$primaryKey} = ?";
		} else {
			$fields = '';
			$values = '';

			foreach($properties as $key => $value) {
				$fields .= "{$key}";
				$values .= "?";
				$params[] = $value;				
				if(end($properties) !== $value) {$fields .= ', '; $values .= ', ';}
			}	

			$query = "INSERT INTO {$tableName} (" . $fields . ") VALUES (" . $values . ")";
		}
	
		$stmt = static::$db->prepare($query);	

		var_dump($this->getPrimaryKey());
		echo "<br />";
		var_dump($child);

		if ($stmt->execute($params)) return ($this->getPrimaryKey() ?? $child) ?? static::$db->lastInsertId();
		else return false;

	}

	public function delete() {
		$tableName = static::$tableName;
		$primaryKey = static::$primaryKey;

		$query = "DELETE FROM {$tableName} WHERE {$primaryKey} = :id";

		$stmt = static::$db->prepare($query);
		$stmt->bindParam(':id', $this->getPrimaryKey(), \PDO::PARAM_INT);
		return $stmt->execute();
	}

	public static function addAssoc($tableName, $properties) {		
		$query = "INSERT INTO {$tableName} VALUES (?,?)";
		$stmt = static::$db->prepare($query);
		return $stmt->execute($properties);
	}

	public static function deleteAssoc($primaryClass, $foreignClass, $properties) {
		$tableName = strtolower($primaryClass) . '_' . strtolower($foreignClass);
		$keys = array_keys($properties);
		$properties = array_values($properties);
		$query = "DELETE FROM {$tableName} WHERE {$keys[0]} = ? AND {$keys[1]} = ?";
		$stmt = static::$db->prepare($query);
		return $stmt->execute($properties);
	}

	public static function find($id) {
		$tableName = static::$tableName;
		$primaryKey =  static::$primaryKey;

		$query = "SELECT * FROM {$tableName} WHERE {$primaryKey} = ? LIMIT 1";

		return static::fetch($query, [$id], get_called_class());
	}


	public static function all() {
		$tableName = static::$tableName;
		$primaryKey = static::$primaryKey;
		$objects = [];

		$query = "SELECT * FROM {$tableName} ORDER BY {$primaryKey} DESC";

		$stmt = static::$db->query($query);

		return static::fetchAll($query, [], get_called_class());
	}


	public function hasOne($foreignClass, $foreignKey = null) {
		$tableName = $foreignClass::$tableName;
		$primaryKey = static::$primaryKey;
		$foreignKey = $foreignKey ?? strtolower(get_called_class()) . '_' . $foreignClass::$primaryKey;
		
		$query = "SELECT * FROM {$tableName} WHERE {$foreignKey} = ?";		


		return static::fetch($query, [$this->$primaryKey], $foreignClass);
	}


	public function hasMany($foreignClass, $foreignKey = null) {
		$tableName = $foreignClass::$tableName;
		$primaryKey = static::$primaryKey;
		$foreignKey = $foreignKey ?? strtolower(get_called_class()) . '_' . $foreignClass::$primaryKey;

		$query = "SELECT * FROM {$tableName} WHERE {$foreignKey} = ?";		

		return static::fetchAll($query, [$this->$primaryKey], $foreignClass);
	}

	public function hasManyThrough($tables = [], $condition = null) {
		$foreignClass = $tables[0][0];
		$tableName = $foreignClass::$tableName;
		$primaryKey = static::$primaryKey;

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

		return static::fetchAll($query, [$this->$primaryKey], $foreignClass);

	}


	public function belongsTo($foreignClass, $foreignKey = null) {
		$tableName = $foreignClass::$tableName;
		$primaryKey = $foreignClass::$primaryKey;
		$foreignKey = $foreignKey ?? strtolower($foreignClass) . '_' . $foreignClass::$primaryKey;

		$query = "SELECT * FROM {$tableName} WHERE {$primaryKey} = ?";		

		return static::fetch($query, [$this->$foreignKey], $foreignClass);
	}		


	public function belongsToMany($foreignClass, $pivotTable = null, $localPivotKey = null, $foreignPivotKey = null) {
		$pivotTable = $pivotTable ?? strtolower(get_called_class()) . '_' . strtolower($foreignClass);
		$localPivotKey = $localPivotKey ?? strtolower(get_called_class()) . '_' . static::$primaryKey;
		$foreignPivotKey = $foreignPivotKey ?? strtolower($foreignClass) . '_' . $foreignClass::$primaryKey;

		$tableName = $foreignClass::$tableName;		
		$primaryKey = $foreignClass::$primaryKey;

		$query = "SELECT {$tableName}.*, {$pivotTable}.* FROM {$tableName} INNER JOIN {$pivotTable} ON {$pivotTable}.{$foreignPivotKey} = {$tableName}.{$primaryKey} AND {$pivotTable}.{$localPivotKey} = ?";

		return static::fetchAll($query, [$this->$primaryKey], $foreignClass);
	}

	public static function fetch($query, $params = [], $className) {
		$stmt = static::$db->prepare($query);

		if(!$stmt->execute($params)) {
			error($stmt->errorInfo()[2]);
			exit();
		}

		return $stmt->fetchObject($className);

	}

	public static function fetchAll($query, $params = [], $className) {
		$objects = [];

		$stmt = static::$db->prepare($query);

		if(!$stmt->execute($params)) {
			error($stmt->errorInfo()[2]);
			exit();
		}

		while ($object = $stmt->fetchObject($className)) {
			$objects[] = $object;
		}

		return $objects;
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
		$tableName = static::$tableName;
		$query = "SELECT COUNT(*) as count FROM {$tableName}";
		return static::query($query)->count;
	}	


}