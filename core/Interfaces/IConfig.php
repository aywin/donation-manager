<?php
/**
 *
 * @package  DonationManager
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

namespace Core\Interfaces;

interface IConfig {
	public static function getInstance();
	public function get($key);
}