<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('HEADER_API_TOKEN', 'X-CI-API-TOKEN');
define('HEADER_API_KEY_ALIAS', 'X-CI-API-KEY-ALIAS');
define('HEADER_API_TS', 'X-CI-API-TS');

/**
 * Base Controller - Superclass
 */
class Base_controller extends CI_Controller {
    
    /**
     * Effettua controllo autenticazione API/csrf token
     * @return boolean TRUE/FALSE
     */
    public function check_auth() {
        
        // Controlla autorizzazione attraverso token csrf
        $csrf_token = $this->input->get($this->security->get_csrf_token_name());
        if ($csrf_token === $this->security->get_csrf_hash()) {
            return TRUE;
        }

        // Se non superato il controllo precedente, effettua il controllo autorizzazione
        // attraverso il token passato nell'header, generato attraverso API-KEY
        if (!array_key_exists(HEADER_API_TOKEN, $this->input->request_headers())) {
            log_message('error', 'Chiave ' . HEADER_API_TOKEN . ' non valorizzata nell\'header');
            return FALSE;
        } 
        $api_key_alias = $this->input->request_headers()[HEADER_API_KEY_ALIAS];
        if (!$api_key_alias) {
            log_message('error', 'Chiave ' . HEADER_API_KEY_ALIAS . ' non valorizzata nell\'header');
            return FALSE;
        }
        $api_ts = $this->input->request_headers()[HEADER_API_TS];
        if (!$api_ts) {
            log_message('error', 'Chiave ' . HEADER_API_TS . ' non valorizzata nell\'header');
            return FALSE;
        }
        $token = $this->input->request_headers()[HEADER_API_TOKEN];
        if (!$token) {
            log_message('error', 'Chiave ' . HEADER_API_TOKEN . ' non valorizzata nell\'header');
            return FALSE;
        }
        
        // Validazione token
        return $this->validate_token($api_key_alias, $token, $api_ts);
    }
    
    private function validate_token($api_key_alias, $token, $api_ts) {
        // Controlla se la richiesta è scaduta
        if (!$this->check_ts($api_ts)) {
            log_message('error', 'Errore validazione token: richiesta scaduta');
            return FALSE;
        }
        
        // Carica informazioni del frontend
        $frontend = $this->load_frontend_info($api_key_alias);
        if (!$frontend) {
            log_message('error', 'Errore validazione token: errore caricamento dati frontend');
            return FALSE;
        }
        
        // Confronta token passato nell'header della richiesta con quello generato dal server
        $generated_token = $this->generate_token($frontend, $api_ts);
        return $generated_token === $token;
    }
    
    private function check_ts($api_ts) {
        $request_time = $_SERVER['REQUEST_TIME'];
        $minutes = round(abs($request_time - $api_ts) / 60,2);
        return ($minutes <= 1);
    }
    
    private function load_frontend_info($api_key_alias) {
        instance_model_by_controller('admin', 'Frontends');
        $query_data = new_query_data();
        $filter = new_query_data_filter('fen_name', '=', $api_key_alias);
        $query_data->filters[] = $filter;
        $result = $this->frontends->query($query_data);
        if ($result) {
            return $result[0];
        } else {
            return FALSE;
        }
    }
    
    private function generate_token($frontend, $ts) {
        return md5($ts . md5($frontend->fen_name . md5($frontend->fen_api_key)));
    }
    
}