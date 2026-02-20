<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['jwt_secret'] = getenv('JWT_SECRET') ?: 'dev-secret-change-me';
$config['jwt_algo']   = 'HS256';
$config['jwt_ttl']    = 3600; // 1 jam
