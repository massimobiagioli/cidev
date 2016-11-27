<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('HEADER_API_TOKEN', 'X-CI-API-TOKEN');

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
            return FALSE;
        } 
        $token = $this->input->request_headers()[HEADER_API_TOKEN];
        if (!$token) {
            return FALSE;
        }
        
        //TODO: completare
        if ($token !== 'DUMMY_TOKEN') {
            return FALSE;
        }
        
        return TRUE;
    }
    
}