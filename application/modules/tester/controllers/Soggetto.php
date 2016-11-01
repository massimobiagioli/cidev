<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soggetto extends CRUD_Controller {
    
    public function test() {
        echo "Table Name: {$this->get_model()->get_table_name()}";
        echo "<br />";
        var_dump($this->get_model()->get_pks());
    }

}
