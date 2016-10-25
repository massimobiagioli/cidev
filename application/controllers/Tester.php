<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tester extends CI_Controller {
    
    public function crud() {
        
        instance_model('Soggetto');
        
        echo $this->soggetto->get_table_name() . '::' . $this->soggetto->get_pk();
        
    }

}
