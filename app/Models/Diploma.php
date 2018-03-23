<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */


namespace App\Models;

use Core\Database\Model;

class Diploma extends Model {
	protected $tableName = "diplomas";

	public function department() {
		return $this->belongsTo(Department::class);
	}

}