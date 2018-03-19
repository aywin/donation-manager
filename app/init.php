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

Dao\Database::connect();
Models\Model::staticInit(Dao\DaoImpl::getInstance());
Services\Session::start();

