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

/*
|--------------------------------------------------------------------------
| UUID
| Wrapper libreria: https://github.com/Repox/codeigniter-uuid
| Specifiche UUID : http://en.wikipedia.org/wiki/Universally_unique_identifier
|--------------------------------------------------------------------------
 */
$config['cidev_uuid'] = array(
    'version' => 'v4',
    'name' => '',
    'namespace' => ''
);