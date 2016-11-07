<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soggetto extends CRUD_controller {
    
    public function test_uuid() {
        echo generate_uuid();
    }
    
    public function test_apikey() {
        $data = [
            'api_key' => 'xyz'
        ];
        $this->load->view('test_apikey', $data);
    }
    
}
