<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Group extends Model {
	static $tableName = "groups";

	public function members() {
		return $this->hasMany('Member');
	}

	public function countMembers() {
		$tableName = static::$tableName;
		$primaryKey = static::$primaryKey;

		$query = "SELECT COUNT(*) as count FROM members WHERE members.group_id = ?";
		return static::query($query, [$this->$primaryKey])->count ?? 0;
	}
}