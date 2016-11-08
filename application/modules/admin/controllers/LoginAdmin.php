<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoginAdmin extends CI_Controller{
    
    public function index() {
        $data['includes'] = $this->load->view('common/common_includes_view', NULL, TRUE);
        $this->load->view('login_admin_view', $data);
    }
    
}
