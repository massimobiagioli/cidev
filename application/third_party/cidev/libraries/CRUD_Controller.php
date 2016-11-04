<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CRUD Controller - Superclass
 */
class CRUD_Controller extends CI_Controller {
    
    private $controller_name;
    private $model_alias;
    
    public function __construct() {
        parent::__construct();
        $this->init_vars();
        $this->load_cache_driver();
        $this->authenticate_cors();
        $this->load_models();
    }
    
    /**
     * Inizializzazione variabili controller
     */
    private function init_vars() {
        $this->set_controller_name($this->router->fetch_class());
        $this->set_model_alias(controller_name_to_model_alias($this->get_controller_name()));
        $this->init_custom_vars();
    }
    
    /**
     * Inizializzazione variabili controller specifiche
     * (Da implementare nelle sottoclassi)
     */
    protected function init_custom_vars() {
    }
    
    /**
     * Caricamento model per interfacciamento con i dati
     */
    private function load_models() {
        // Model principale
        instance_model_by_controller($this->get_controller_name());
        
        // Custom models
        $this->load_custom_models();
    }
    
    /**
     * Caricamento model specifici
     * (Da implementare nelle sottoclassi)
     */
    protected function load_custom_models() {
    }
    
    /*
     * Carica driver della cache, in funzione del file di configurazione
     */
    private function load_cache_driver() {
        $this->load->driver('cache', $this->config->item('cidev_cache'));
    }
    
    /*
     * Impostazioni CORS, in funzione del file di configurazione
     */
    private function authenticate_cors() {
        $cors_config = $this->config->item('cidev_cors');
        
        foreach ($cors_config['headers'] as $header) {
            header($header);
        }
        
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
    }
    
    public function load($id) {
        echo $id;
    }
    
    public function get_controller_name() {
        return $this->controller_name;
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

