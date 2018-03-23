<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

use Core\Autoloader;
use Core\Database\Database;
use App\Services\Session;


require_once __DIR__ . '/Autoloader.php';
Autoloader::register();
require_once __DIR__ . '/helpers.php';

setlocale(LC_TIME, env('LC_TIME'));


Database::connect();
Session::start();
