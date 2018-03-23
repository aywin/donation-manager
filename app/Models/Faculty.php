<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

use Core\Database\Model;

class Faculty extends Model {
	protected $tableName = "faculties";

	public function departments() {
		return $this->hasMany(Department::class);
	}

}