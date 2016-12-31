<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CRUD Base Controller - Superclass
 */
class CRUD_base_controller extends CI_Controller {
    
    private $module_name;
    private $controller_name;
    private $model_alias;
    
    public function __construct() {
        parent::__construct();
        $this->load_cache_driver();
    }
    
    /*
     * Carica driver della cache, in funzione del file di configurazione
     */
    private function load_cache_driver() {
        $this->load->driver('cache', $this->config->item('cidev_cache'));
    }
    
    public function get_controller_name() {
        return $this->controller_name;
    }
    
    public function get_module_name() {
        return $this->module_name;
    }

    public function set_module_name($module_name) {
        $this->module_name = $module_name;
    }
    
    public function set_controller_name($controller_name) {
        $this->controller_name = $controller_name;
    }
    
    public function get_model_alias() {
        return $this->model_alias;
    }

    public function set_model_alias($model_alias) {
        $this->model_alias = $model_alias;
    }
    
    public function get_model($model_alias = NULL) {
        if ($model_alias === NULL) {
            $model_alias = $this->get_model_alias();
        }
        return $this->$model_alias;
    }
    
}

