<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Nome CRUD Model generico
 */
define("CRUD_MODEL_GENERIC", "CRUD_model");

if (!function_exists('instance_model_by_controller')) {
    /**
     * Istanzia model a partire dal nome della tabella fisica
     * @param string $module_name Nome modulo
     * @param string $controller_name Nome controller
     */
    function instance_model_by_controller($module_name, $controller_name) {
        $model_name = controller_name_to_model_name($controller_name); 
        instance_model_by_info([
           'module_name' => $module_name,
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
        
        // Imposta nome modulo sul model
        $CI->$model_alias->set_module_name($model_info['module_name']);
        
        // Carica database in funzione del modulo
        $db = $CI->load->database(module_name_to_db_name($model_info['module_name']), TRUE);
        $CI->$model_alias->set_module_db($db);
        
        // Imposta nome tabella fisica
        $CI->$model_alias->set_table_name($model_info['table_name']);
    }    
}

if (!function_exists('module_name_to_db_name')) {
    /**
     * Restituisce nome database da nome modulo
     * @param string $module_name Nome modulo
     * @return string nome database
     */
    function module_name_to_db_name($module_name) {
        $CI =& get_instance();
        $db_connections = $CI->config->item('modules_db_connections');
        if (array_key_exists($module_name, $db_connections)) {
            return $db_connections[$module_name];
        }
        return $module_name;
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
        $CI =& get_instance();
        $assoc = $CI->config->item('controllers_assoc');
        if (array_key_exists($controller_name, $assoc)) {
            return $assoc[$controller_name]['table_name'];
        }
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
        return controller_name_to_model_alias($controller_name) . '_model';
    }
}

if (!function_exists('controller_name_to_model_alias')) {
    /**
     * Restituisce nome alias model
     * @param string $controller_name Nome controller
     * @return string alias model
     */
    function controller_name_to_model_alias($controller_name) {
        $CI =& get_instance();
        $assoc = $CI->config->item('controllers_assoc');
        if (array_key_exists($controller_name, $assoc)) {
            return $assoc[$controller_name]['model_alias'];
        }
        return strtolower($controller_name);
    }
}
