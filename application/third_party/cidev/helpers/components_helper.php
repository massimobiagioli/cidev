<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('components_get_handler')) {
    /**
     * Restituisce url da utilizzare come handler per eventi componenti
     * @return string url da utilizzare come handler per eventi componenti
     */
    function components_get_handler($module, $controller, $action) {
        return base_url() . "$module/$controller/$action";
    }    
}

