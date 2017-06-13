<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

$config = parse_ini_file('../config.ini');

// URL

define('PUBLIC_URL', $config['url']);

// Database

define('DB_HOST', $config['dbhost']);
define('DB_NAME', $config['dbname']);
define('DB_USER', $config['dbuser']);
define('DB_PASSWORD', $config['dbpass']);

// Environment

setlocale(LC_TIME, $config['localtime']);