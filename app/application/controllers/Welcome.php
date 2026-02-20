<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index(){
		echo 'Welcome to Welcome page';
	}

	public function redis()
	{
		$start = microtime(true);
		$redis = new Redis();
		$redis->connect('redis', 6379, 1.5);
		echo $redis->ping('Hello World! <br>');
		$end = microtime(true);
		$totalMs = ($end - $start) * 1000;
		echo "Total: " . number_format($totalMs, 2) . " ms\n";
	}

	public function jwt(){
		$token = jwt_encode([
			'uid' => 1,
			'email' => "testjwt@gmail.com"
		]);
		echo $token;
	}

	public function info(){
		echo phpinfo();
	}

}
