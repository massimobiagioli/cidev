<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CRUD Form Controller - Superclass
 */
class CRUD_form_detail_controller extends CRUD_base_controller {
    
    public function __construct() {
        parent::__construct();
        $this->init_vars();
    }
    
    /**
     * Inizializzazione variabili controller
     */
    private function init_vars() {
        $this->init_custom_vars();
    }
    
    /**
     * Inizializzazione variabili controller specifiche
     * (Da implementare nelle sottoclassi)
     */
    protected function init_custom_vars() {
    }
    
}

