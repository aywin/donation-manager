<?php
/**
 * Projet, Base de données
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace Core;

use Core\Interfaces\IConfig;

class Config implements IConfig {

	private static $instance;
	private $settings;

	private function __construct() {
		$file = require __DIR__ . '/../config/config.php';
		$file = $file['env'];
		$this->settings = $this->praseSettings($file);
		// var_dump($this->settings);
		// die();
	}

	public static function getInstance() {
		return static::$instance ?? new Config();
	}

	public function get($key) {
		return $this->settings[$key] ?? null;
	}

	private function praseSettings($file) {
		$content = file_get_contents($file);
		$lines = explode("\n", $content);
		$lines = array_filter($lines, function($val) {
			return strpos($val, "=") !== false;
		});

		$settings = [];

		foreach ($lines as $line) {
			$row = explode("=",$line);
			$row[0] = trim($row[0]);
			$settings[$row[0]] = trim($row[1]);;
		}

		return $settings;
	}

}
