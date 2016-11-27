<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginAdmin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('admin');
    }
    
    public function index() {
        $this->show_login();
    }
    
    public function show_console() {
        $form_data = $this->input->post();
        
        // Controlla credenziali amministratore
        $cfg = $this->config->item('cidev_sysadmin');
        if (($form_data['username'] === 'Sysadmin') && ($form_data['password'] === $cfg['sysadmin_password'])) {
            $data['includes'] = $this->load->view('common/common_includes_view', NULL, TRUE);
            $this->load->view('console_admin_view', $data);
        } else {
            $this->show_login(TRUE);
        }
    }
    
    public function on_console_sidebar_click($menuId) {
        if ($menuId === 'action-exit') {
            $this->client_manager->change_view($menuId, 'admin/LoginAdmin', TRUE, TRUE);
        } else {
            $view = [
                'name' => 'console_apikeys_admin_view',
                'data' => [
                    'filters' => $this->init_apikeys_querydata_filters()
                ]
            ];
            $this->client_manager->set_div_content_by_view($menuId, 'console-main-content', $view, TRUE, TRUE);
        }
    }
    
    private function init_apikeys_querydata_filters() {
        $query_data = new stdClass();
        $query_data->filters = [];
        $query_data->sort = [];
        $query_data->limit = query_limit_model('frontends');
        $query_data->offset = 0;
        return urlencode(base64_encode(json_encode($query_data)));
    }
    
    private function show_login($from_confirm = FALSE) {
        $data['includes'] = $this->load->view('common/common_includes_view', NULL, TRUE);
        $data['csrf'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        ];
        $data['show_error'] = $from_confirm;
        if ($from_confirm) {
            $data['error_title'] = $this->lang->line('errore');
            $data['error_message'] = $this->lang->line('credenziali_errate');
        }
        $this->load->view('login_admin_view', $data);
    }
    
}
