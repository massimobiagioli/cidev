<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoginAdmin extends CI_Controller{
    
    public function index() {
        $this->load->view('login_admin_view');
    }
    
}
