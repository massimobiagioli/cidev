<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soggetto extends CRUD_Controller {
    
    public function crud() {
        
        echo $this->get_model()->get_table_name() . '::' . $this->get_model()->get_pk();
        
    }

}
