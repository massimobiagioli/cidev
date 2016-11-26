<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('HEADER_API_TOKEN', 'X-CI-API-TOKEN');

/**
 * Base Controller - Superclass
 */
class Base_controller extends CI_Controller {
    
    /**
     * Effettua controllo autenticazione API
     * @return boolean TRUE/FALSE
     */
    public function check_auth() {
        // Legge token dall'header
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
    
    /**
     * Effettua controllo autenticazione con token csrf
     * @return boolean TRUE/FALSE
     */
    public function check_auth_csrf_token() {
        $csrf_token = $this->input->get($this->security->get_csrf_token_name());
        return $csrf_token === $this->security->get_csrf_hash();
    }
    
}