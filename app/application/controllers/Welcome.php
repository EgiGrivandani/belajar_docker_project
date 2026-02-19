<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$start = microtime(true);
		$redis = new Redis();
		$redis->connect('redis', 6379, 1.5);
		echo $redis->ping('Hello World! <br>');
		$end = microtime(true);
		$totalMs = ($end - $start) * 1000;
		echo "Total: " . number_format($totalMs, 2) . " ms\n";
	}

	public function info(){
		echo phpinfo();
	}

	public function fpm_jebol()
	{
		sleep(5); // tahan 1 worker selama 20 detik
		echo "done";
	}

}
