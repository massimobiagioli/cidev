<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CRUD Form Controller - Superclass
 */
class CRUD_form_management_controller extends CRUD_base_controller {
    
    private $module_name;
    private $controller_name;
    private $model_alias;
    
    public function __construct() {
        parent::__construct();
        $this->init_vars();
    }
    
    /**
     * Inizializzazione variabili controller
     */
    private function init_vars() {
        $this->set_module_name($this->router->module);
        $clazz = $this->router->fetch_class();
        $this->set_controller_name($clazz);
        $this->set_model_alias(controller_name_to_model_alias(str_replace('_management_form', '', $clazz)));
        $this->init_custom_vars();
    }
    
    /**
     * Inizializzazione variabili controller specifiche
     * (Da implementare nelle sottoclassi)
     */
    protected function init_custom_vars() {
    }
    
    /**
     * Pagina iniziale form
     */
    public function index() {
        $data['includes'] = $this->load->view('common/common_includes_view', NULL, TRUE);
        $this->load_custom_data($data);
        $this->load->view($this->get_model_alias() . '_management_view', $data);
    }
    
    public function on_toolbar_click($toolbar_id, $info) {
        $this->client_manager->console_log($toolbar_id, $toolbar_id, TRUE, TRUE);
    }
    
    /**
     * Carica dati aggiuntivi da passare alla view
     * @param array $data Dati da passare alla view
     */
    protected function load_custom_data(&$data) {
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

