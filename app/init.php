<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */
require_once __DIR__ . '/core/config.php';
require_once __DIR__ . '/core/functions.php';

spl_autoload_register(function ($class) {
	$directory = NULL;
	if (file_exists(__DIR__ . "/core/{$class}.php")) $directory = '/core/';
	elseif(file_exists(__DIR__ . "/controllers/{$class}.php")) $directory = '/controllers/';
	elseif(file_exists(__DIR__ . "/models/{$class}.php")) $directory = '/models/';
	elseif(file_exists(__DIR__ . "/core/dao/{$class}.php")) $directory = '/core/dao/';
    
    if($directory) require_once __DIR__ . $directory . $class . '.php';
});

Database::connect();
Model::staticInit(DaoImpl::getInstance());
Session::start();


