<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Nome CRUD Model generico
 */
define("CRUD_MODEL_GENERIC", "CRUD_Model");

if (!function_exists('instance_model_by_controller')) {
    /**
     * Istanzia model a partire dal nome della tabella fisica
     * @param string $controller_name Nome controller
     */
    function instance_model_by_controller($controller_name) {
        $model_name = controller_name_to_model_name($controller_name); 
        instance_model_by_info([
           'name' => $model_name,
           'alias' => controller_name_to_model_alias($controller_name),
           'table_name' => controller_name_to_table_name($controller_name) 
        ]);
    }    
}

if (!function_exists('instance_model_by_info')) {
    /**
     * Istanzia model a partire dal nome della tabella fisica
     * @param array $model_info Informazioni model
     */
    function instance_model_by_info($model_info) {
        $CI =& get_instance();
        
        // Se il model specifico non esiste, istanzia quello generico
        if (model_exists($model_info['name'])) {
            $model_name = $model_info['name'];
        } else {
            $model_name = CRUD_MODEL_GENERIC;
        }
        $model_alias = $model_info['alias'];
        $CI->load->model($model_name, $model_alias);
        $CI->$model_alias->set_table_name($model_info['table_name']);
    }    
}

if (!function_exists('model_exists')) {
    /**
     * Controlla se il model esiste
     * @param string $model_name Nome model
     * @return boolean TRUE/FALSE
     */
    function model_exists($model_name) {
        $CI =& get_instance();      
        $load_arr = (array) $CI->load;
        
        foreach ($load_arr as $key => $value) {
            if (substr(trim($key), 2, 50) == "_ci_model_paths") {
                foreach ($value as $path) {
                    if (file_exists($path . 'models/' . model_name_to_model_filename($model_name))) {
                        return TRUE;
                    }
                }
            }
        }
      
        return FALSE;
    }
}

if (!function_exists('model_name_to_model_filename')) {
    /**
     * Restituisce nome file model da nome model
     * @param string $model_name Nome model
     * @return string nome file model
     */
    function model_name_to_model_filename($model_name) {
        return ucfirst($model_name) . '.php';
    }
}

if (!function_exists('controller_name_to_table_name')) {
    /**
     * Restituisce nome tabella fisica da nome controller
     * @param string controller Nome controller
     * @return string nome tabella fisica
     */
    function controller_name_to_table_name($controller_name) {
        return strtolower($controller_name);
    }
}

if (!function_exists('controller_name_to_model_name')) {
    /**
     * Restituisce nome model fisica da nome controller
     * @param string controller Nome controller
     * @return string nome model
     */
    function controller_name_to_model_name($controller_name) {
        return table_name_to_model_name(controller_name_to_table_name($controller_name));
    }
}

if (!function_exists('controller_name_to_model_alias')) {
    /**
     * Restituisce nome alias model
     * @param string $controller_name Nome controller
     * @return string alias model
     */
    function controller_name_to_model_alias($controller_name) {
        return strtolower($controller_name);
    }
}

if (!function_exists('table_name_to_model_name')) {
    /**
     * Restituisce nome model da nome tabella fisica
     * @param string $table_name Nome tabella fisica
     * @return string nome model
     */
    function table_name_to_model_name($table_name) {
        return strtolower($table_name) . '_model';
    }
}
