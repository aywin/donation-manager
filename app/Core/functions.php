<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

// URLs

function asset($path) {
	return PUBLIC_URL.'/'.$path;
}

function url($path) {
	return PUBLIC_URL.'/'.$path;
}

// Views

function view($view, $data = []) {
	extract($data, EXTR_PREFIX_SAME, "data");
	require_once '../app/views/' . $view . '.php';
}

function template($template) {
	require_once '../app/views/templates/' . $template . '.php';
}

function error($message) {
	return view('error', compact('message'));
}

// HTTP Requests

function request($key) {
	return trim($_POST[$key]);
}

function redirect($path) {
	header("Location: ".PUBLIC_URL.'/'.$path);
	die();
}

function requestMethod() {
	return $_SERVER['REQUEST_METHOD'];
}

function allSet() {
	foreach($_POST as $element) {
		if(!strlen($element)) {
			return  error('Il existe des champs vides !');
		}
	}
	return true;
}

function getController() {	
	if(isset($_GET['url'])) {
		$url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		return $url[0];
	} else {
		return 'home';
	}

}

// Time

function humanDate($date) {
	return utf8_encode(strftime("%d %B, %Y", strtotime($date)));
}

function getYear($date) {
	return strftime("%Y", strtotime($date));
}
