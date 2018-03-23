<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Controllers;

use App\Services\Session;


class Controller {

	public function __construct() {
		if(getController() != 'login' && !Session::check()) {
			redirect('login');
		}
	}

}