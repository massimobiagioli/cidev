<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Istanzia model a partire dal nome della tabella fisica
 * @param string $controller_name Nome controller
 */
if (!function_exists('instance_model_by_controller')) {
    function instance_model_by_controller($controller_name) {
        $model_name = controller_name_to_model_name($controller_name); 
        instance_model_by_info([
           'name' => $model_name,
           'alias' => controller_name_to_model_alias($controller_name) 
        ]);
    }    
}

/**
 * Istanzia model a partire dalle informazioni del model stesso
 * @param array $model_info Informazioni model
 */
if (!function_exists('instance_model_by_info')) {
    function instance_model_by_info($model_info) {
        $CI =& get_instance();
        $CI->load->model($model_info['name'], $model_info['alias']);
    }    
}

/**
 * Restituisce nome tabella fisica da nome controller
 * @param string controller Nome controller
 * @return string nome tabella fisica
 */
if (!function_exists('controller_name_to_table_name')) {
    function controller_name_to_table_name($controller_name) {
        return strtolower($controller_name);
    }
}

/**
 * Restituisce nome model fisica da nome controller
 * @param string controller Nome controller
 * @return string nome model
 */
if (!function_exists('controller_name_to_model_name')) {
    function controller_name_to_model_name($controller_name) {
        return table_name_to_model_name(controller_name_to_table_name($controller_name));
    }
}

/**
 * Restituisce nome alias model
 * @param string $controller_name Nome controller
 * @return string alias model
 */
if (!function_exists('controller_name_to_model_alias')) {
    function controller_name_to_model_alias($controller_name) {
        return strtolower($controller_name);
    }
}

/**
 * Restituisce nome model da nome tabella fisica
 * @param string $table_name Nome tabella fisica
 * @return string nome model
 */
if (!function_exists('table_name_to_model_name')) {
    function table_name_to_model_name($table_name) {
        return strtolower($table_name) . '_model';
    }
}
