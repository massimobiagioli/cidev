<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoginAdmin extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('admin');
    }
    
    public function index() {
        $data['includes'] = $this->load->view('common/common_includes_view', NULL, TRUE);
        $data['csrf'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        ];
        $this->load->view('login_admin_view', $data);
    }
    
    public function confirm_login() {
        $form_data = $this->input->post();
        // TODO: open dashboard
    }
    
}
