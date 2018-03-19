<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

use App\Core;
use App\Dao;
use App\Models;
use App\Services;

require_once __DIR__ . '/core/config.php';
require_once __DIR__ . '/core/functions.php';
require_once __DIR__ . '/core/Autoloader.php';

Core\Autoloader::register();

/*
spl_autoload_register(function ($class) {
	$directory = NULL;
	if (file_exists(__DIR__ . "/core/{$class}.php")) $directory = '/core/';
	elseif(file_exists(__DIR__ . "/controllers/{$class}.php")) $directory = '/controllers/';
	elseif(file_exists(__DIR__ . "/models/{$class}.php")) $directory = '/models/';
	elseif(file_exists(__DIR__ . "/core/dao/{$class}.php")) $directory = '/core/dao/';
    
    if($directory) require_once __DIR__ . $directory . $class . '.php';
});

*/

Dao\Database::connect();
Models\Model::staticInit(Dao\DaoImpl::getInstance());
Services\Session::start();

