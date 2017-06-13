<?php
/**
 * Projet, Base de donn�es
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Phone extends Model {
	static $tableName = "phones";

	public function target() {
		return $this->belongsTo('Target');
	}
}