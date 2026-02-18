<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$redis = new Redis();
		$redis->connect('redis', 6379, 1.5);

		$loop = 1000;
		$start = microtime(true);

		for ($i = 0; $i < $loop; $i++) {
			$redis->set('k'.$i, 'v'.$i);
			$redis->get('k'.$i);
		}

		$end = microtime(true);

		$totalMs = ($end - $start) * 1000;
		$avgMs = $totalMs / ($loop * 2);

		echo "Total: " . number_format($totalMs, 2) . " ms\n";
		echo "Avg per op: " . number_format($avgMs, 4) . " ms";


	}
}
