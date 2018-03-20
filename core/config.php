<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

$config = parse_ini_file('../.env');

// URL

define('PUBLIC_URL', $config['PUBLIC_URL']);

// Database

define('DB_HOST', $config['DB_HOST']);
define('DB_NAME', $config['DB_NAME']);
define('DB_USER', $config['DB_USER']);
define('DB_PASSWORD', $config['DB_PASSWORD']);

// Environment

setlocale(LC_TIME, $config['LC_TIME']);