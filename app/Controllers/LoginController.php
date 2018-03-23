<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace App\Controllers;

use App\Services\Session;

class LoginController extends Controller {

	public function index() {
		return view('login');
	}

	public function login() {
		if(requestMethod() == 'POST' && allSet() === true) {
			$username = trim(request('username'));
			$password = trim(request('password'));
			if (Session::setSession($username, $password)) return redirect('home');
			else return error('Utilisateur / mot de passe incorrect(s).');
		}
	}

	public function logout() {
		Session::destroy();
		return redirect('login');
	}
}