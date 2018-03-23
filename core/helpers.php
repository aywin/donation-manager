<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

// Env File

function env($key, $default = null) {
	return Core\Config::getInstance()->get($key) ?? $default;
}

// Classes

function class_basename($object) {
	$str = get_class($object);
	$str = explode('\\', $str);
	return end($str);
}

// URLs

function asset($path) {
	return env('PUBLIC_URL').'/'.$path;
}

function url($path) {
	return env('PUBLIC_URL').'/'.$path;
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
	header("Location: ".env('PUBLIC_URL').'/'.$path);
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
