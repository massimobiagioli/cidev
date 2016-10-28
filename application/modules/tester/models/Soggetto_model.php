<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soggetto_model extends CRUD_Model {
    
    protected function init_vars() {
        $this->set_table_name('soggetto');
        $this->set_pk('sog_id');
    }
    
}
