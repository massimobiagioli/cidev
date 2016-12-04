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

if (!function_exists('component_decode_info')) {
    /**
     * Decodifica informazioni passate dal componente
     * @param string info Informazioni passate dal componente in base64
     * @return string informazioni decodificate
     */
    function component_decode_info($info) {
        return json_decode(base64_decode(urldecode($info)));
    }    
}
