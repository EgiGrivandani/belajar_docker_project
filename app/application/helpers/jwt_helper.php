<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function jwt_encode(array $payload)
{
	$CI = &get_instance();
	$CI->config->load('jwt');

	$time = time();

	$payload = array_merge($payload, [
		'iss' => base_url(),
		'iat' => $time,
		'exp' => $time + $CI->config->item('jwt_ttl')
	]);

	return JWT::encode(
		$payload,
		$CI->config->item('jwt_secret'),
		$CI->config->item('jwt_algo')
	);
}

function jwt_decode_token($token)
{
	$CI = &get_instance();
	$CI->config->load('jwt');

	return JWT::decode(
		$token,
		new Key(
			$CI->config->item('jwt_secret'),
			$CI->config->item('jwt_algo')
		)
	);
}

