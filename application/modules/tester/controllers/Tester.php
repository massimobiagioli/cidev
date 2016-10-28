<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/cidev/libraries/CRUD_Controller.php';

class Tester extends CRUD_Controller {
    
    public function crud() {
        
        instance_model('Soggetto');
        
        echo $this->soggetto->get_table_name() . '::' . $this->soggetto->get_pk();
        
    }

}
