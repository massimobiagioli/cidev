<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Cache
|--------------------------------------------------------------------------
 */
$config['cidev_cache'] = array('adapter' => 'apc', 'backup' => 'file');

/*
|--------------------------------------------------------------------------
| CORS
|--------------------------------------------------------------------------
 */
$config['cidev_cors'] = array(
    'headers' => array(
        'Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding',
        'Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'
    )
);
