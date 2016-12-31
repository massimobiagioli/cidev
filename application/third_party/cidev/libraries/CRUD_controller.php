<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CRUD Controller - Superclass
 */
class CRUD_controller extends Base_auth_controller {
    
    public function __construct() {
        parent::__construct();
        $this->init_vars();
        $this->authenticate_cors();
        $this->load_models();
    }
    
    /**
     * Inizializzazione variabili controller
     */
    private function init_vars() {
        $this->set_module_name($this->router->module);
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
        instance_model_by_controller($this->get_module_name(), $this->get_controller_name());
        
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
    
    protected function pre_load($id) {
    }
    
    protected function post_load($id, &$row) {
    }
    
    /**
     * Caricamento elemento per chiave
     * @param int $id Chiave elemento a caricare
     */
    public function load($id) {
        // Controllo autorizzazioni
        if (!$this->check_auth()) {
            $this->handle_unhautorized();
            die();
        }
        
        $this->pre_load($id);
        
        // Effettua caricamento elemento da model
        $row = $this->get_model()->load($id);
        if (!$row) {
            $this->handle_internal_error('Errore chiamata a metodo load - model: ' . $this->get_module_name() . '::' . $this->get_model_alias() . ' - chiave: ' . $id);
            die();
        }
        
        $this->post_load($id, $row);
        
        $this->handle_json_response($row);
    } 
    
    /**
     * Conta elementi in funzione dei filtri specificati
     * @param array $filters Filtri
     */
    public function count_query($filters) {
        // Controllo autorizzazioni
        if (!$this->check_auth()) {
            $this->handle_unhautorized();
            die();
        }
        
        // Parsing dei parametri in ingresso
        $query_data = $this->parse_query_filters($filters);
        if ($query_data == null) {
            $this->handle_internal_error('Errore parsing query_data - metodo count_query - model: ' . $this->get_module_name() . '::' . $this->get_model_alias());
            die();
        }
        
        // Effettua conteggio elementi da model
        $result = $this->get_model()->count_query($query_data);
        if ($result === FALSE) {
            $this->handle_internal_error('Errore chiamata a metodo count_query - model: ' . $this->get_module_name() . '::' . $this->get_model_alias());
            die();
        }
        
        $this->handle_json_response($result);
    }
    
    protected function pre_query(&$query_data) {
    }
    
    protected function post_query($query_data, &$result) {
    }
    
    /**
     * carica elementi in funzione dei filtri specificati
     * @param array $filters Filtri
     */
    public function query($filters) {
        // Controllo autorizzazioni
        if (!$this->check_auth()) {
            $this->handle_unhautorized();
            die();
        }
        
        // Popola QueryData dai filtri
        $query_data = $this->parse_query_filters($filters);
        if ($query_data == null) {
            $this->handle_internal_error('Errore parsing query_data - metodo query - model: ' . $this->get_module_name() . '::' . $this->get_model_alias());
            die();
        }            
        
        $this->pre_query($query_data);
        
        // Effettua caricamento elementi da model
        $result = $this->get_model()->query($query_data);
        if ($result === FALSE) {
            $this->handle_internal_error('Errore chiamata a metodo query - model: ' . $this->get_module_name() . '::' . $this->get_model_alias());
            die();
        }
        
        $this->post_query($query_data, $result);
        
        $this->handle_json_response($result);
    }
    
    protected function pre_insert(&$to_insert) {
    }
    
    protected function post_insert(&$inserted) {
    }
    
    /**
     * Inserimento di un nuovo elemento
     */
    public function insert() {
        // Controllo autorizzazioni
        if (!$this->check_auth()) {
            $this->handle_unhautorized();
            die();
        }
        
        // Lettura dati da inserire
        $to_insert = $this->parse_input_data();
        if (!$to_insert) {
            $this->handle_internal_error('Errore parsing input data - metodo insert - model: ' . $this->get_module_name() . '::' . $this->get_model_alias());
            die();
        }
        
        $this->pre_insert($to_insert);
        
        // Effettua inserimento di un nuovo elemento da model
        $inserted = $this->get_model()->insert($to_insert);
        if ($inserted === FALSE) {
            $this->handle_internal_error('Errore chiamata a metodo insert - model: ' . $this->get_module_name() . '::' . $this->get_model_alias() . ' - dati: ' . json_encode($to_insert));
            die();
        }
        
        $this->post_insert($inserted);
        
        $this->handle_json_response($inserted);
    }
    
    protected function pre_update($id, &$to_update) {
    }
    
    protected function post_update(&$updated) {
    }
    
    /**
     * Aggiornamento elemento
     * @param int $id Chiave elemento da aggiornare
     */
    public function update($id) {
        // Controllo autorizzazioni
        if (!$this->check_auth()) {
            $this->handle_unhautorized();
            die();
        }
        
        // Lettura dati da inserire
        $to_update = $this->parse_input_data();
        if (!$to_update) {
            $this->handle_internal_error('Errore parsing input data - metodo update - model: ' . $this->get_module_name() . '::' . $this->get_model_alias());
            die();
        }
        
        $this->pre_update($id, $to_update);
        
        // Effettua aggiornamento elemento da model
        $updated = $this->get_model()->update($id, $to_update);
        if ($updated === FALSE) {
            $this->handle_internal_error('Errore chiamata a metodo update - model: ' . $this->get_module_name() . '::' . $this->get_model_alias() . ' - dati: ' . json_encode($to_insert));
            die();
        }
        
        $this->post_update($updated);
        
        $this->handle_json_response($updated);        
    }
    
    protected function pre_delete($id) {
    }
    
    protected function post_delete($id, &$deleted) {
    }
    
    /**
     * Cancellazione elemento
     * @param int $id Chiave elemento da cancellare
     */
    public function delete($id) {
        // Controllo autorizzazioni
        if (!$this->check_auth()) {
            $this->handle_unhautorized();
            die();
        }
        
        $this->pre_delete($id);
        
        // Effettua cancellazione elemento da model
        $deleted = $this->get_model()->delete($id);
        if ($deleted === FALSE) {
            $this->handle_internal_error('Errore chiamata a metodo delete - model: ' . $this->get_module_name() . '::' . $this->get_model_alias() . ' - chiave: ' . $id);
            die();
        }
        
        $this->post_delete($id, $deleted);
        
        $this->handle_json_response($deleted);        
    }
    
    private function parse_query_filters($filters) {
        return json_decode(base64_decode(urldecode($filters)));
    }
    
    private function parse_input_data() {
        return json_decode(file_get_contents("php://input"));
    }
    
    private function handle_json_response($data) {
        $this->output->set_content_type('application/json')
                     ->set_status_header('200')
                     ->set_output(json_encode($data));
    }
    
    private function handle_unhautorized() {
        $this->output->set_status_header('401');
    }
    
    private function handle_internal_error($error_msg = NULL) {
        if ($error_msg) {
            log_message('error', $error_msg);
        }
        $this->output->set_status_header('500');
    }
    
}

