<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generate_uuid')) {
    /**
     * Genera nuovo uuid
     * @return string nuovo uuid
     */
    function generate_uuid() {
        $CI =& get_instance();
        $uuid_options = $CI->config->item('cidev_uuid');
        switch ($uuid_options['version']) {
            case 'v3':
                return $CI->uuid->v3($uuid_options['name'], $uuid_options['namespace']);
            case 'v5':
                return $CI->uuid->v5($uuid_options['name'], $uuid_options['namespace']);
            case 'v4':
            default:
                return $CI->uuid->v4();
        }
    }    
}