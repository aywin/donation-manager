<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

class Controller {

	public function __construct() {
		if(getController() != 'login' && !Session::check()) {
			redirect('login');
		}
	}

}