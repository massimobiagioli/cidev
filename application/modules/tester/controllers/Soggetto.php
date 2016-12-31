<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soggetto extends CRUD_controller {
    
    public function test_uuid() {
        echo generate_uuid();
    }
    
    public function test_apikey() {
        $data = [
            'api_key' => '00f3ee6d-0f19-4cea-ba8b-07fff7298f0b'
        ];
        $this->load->view('test_apikey', $data);
    }
    
}
