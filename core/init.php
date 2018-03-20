<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

use Core\Dao;
use App\Models;
use App\Services;

require_once __DIR__ . '../config/config.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/Autoloader.php';

Core\Autoloader::register();

Database\MysqlDatabase::connect();
Models\Model::staticInit(Dao\Dao::getInstance());
Services\Session::start();

