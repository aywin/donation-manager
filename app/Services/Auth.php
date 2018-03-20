<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Services;

use App\Models\Member;
use Core\Dao\Dao;

class Auth {

	public static function lookFor($username, $password) {
		return Dao::getInstance()->lookFor($username, $password);
	}
}