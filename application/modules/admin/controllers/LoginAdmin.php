<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Console di Amministrazione
 */
class LoginAdmin extends CI_Controller {
    
    const OPERATION_INSERT = 'insert';
    const OPERATION_UPDATE = 'update';
    
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
    
    public function on_console_sidebar_click($menu_id) {
        if ($menu_id === 'action-exit') {
            $this->client_manager->change_view($menu_id, 'admin/LoginAdmin', TRUE, TRUE);
        } else {
            $view = [
                'name' => 'console_apikeys_admin_view',
                'data' => [
                    'filters' => $this->init_apikeys_querydata_filters()
                ]
            ];
            $this->client_manager->set_div_content_by_view($menu_id, 'console-main-content', $view, TRUE, TRUE);
        }
    }
    
    public function on_apikeys_toolbar_click($toolbar_id, $info) {
               
        // Decodifica info passate dal componente
        $decoded_info = component_decode_info($info);
        
        // Se operazione dipende dalla riga, e nessuna riga selezionata, mostra messaggio di errore
        if ($toolbar_id !== 'toolbar-add' && (!$decoded_info->selectedRows)) {
            $this->client_manager->show_error_message($toolbar_id, 
                    $this->lang->line('errore'), 
                    $this->lang->line('nessuna_riga_selezionata'),
                    TRUE, 
                    TRUE);
            return;
        }
                
        switch ($toolbar_id) {
            case 'toolbar-add':
                $title_lang_key = 'aggiungi';
                $operation = self::OPERATION_INSERT;
                $row = new stdClass();
                $row->fen_api_key = generate_uuid();
                break;
            case 'toolbar-edit':
                $title_lang_key = 'modifica';
                $operation = self::OPERATION_UPDATE;
                $row = count($decoded_info->selectedRows) > 0 ? $decoded_info->selectedRows[0] : null;
                break;
            case 'toolbar-delete':
                $this->client_manager->show_question($toolbar_id, 
                    $this->lang->line('conferma_cancellazione'), 
                    sprintf($this->lang->line('cancellare_elemento'), 
                    $decoded_info->selectedRows[0]->fen_id . ' - ' . $decoded_info->selectedRows[0]->fen_name),
                    [
                        [
                            'id' => 'btn_yes',
                            'text' => $this->lang->line('si'),
                            'clickhandler' => components_get_handler('admin', 'LoginAdmin', 'on_apikeys_question_delete'),
                            'info' => $decoded_info->selectedRows[0]->fen_id
                        ],
                        [
                            'id' => 'btn_no',
                            'text' => $this->lang->line('no'),
                            'clickhandler' => components_get_handler('admin', 'LoginAdmin', 'on_apikeys_question_delete')
                        ]
                    ],
                    TRUE,
                    TRUE);
                return;
        }
        
        $dialog_info = [
            'view' => [
                'name' => 'console_apikey_detail_admin_view',
                'data' => [
                    'operation' => $operation,
                    'info' => $row
                ]
            ],
            'title' => $this->lang->line($title_lang_key) . ' ' . $this->lang->line('api_key'),
            'modal' => TRUE,
            'width' => 600
        ];
            
        $this->client_manager->load_view_into_dialog($toolbar_id, $dialog_info, TRUE, TRUE);
    }
    
    public function on_apikeys_question_delete($button_id, $id) {
        
        // Chiude dialog
        $this->client_manager->close_dialog('toolbar-delete');

        if ($button_id === 'btn_yes') {
            
            // Cancella dati utilizzando il model
            if ($this->get_model_frontends()->delete($id)) {
                $this->client_manager->show_info_message($button_id, $this->lang->line('info'), $this->lang->line('operazione_effettuata_con_successo'));                
            } else {
                $this->client_manager->show_error_message($button_id, $this->lang->line('errore'), $this->lang->line('errore_cancellazione_elemento'));
            }
            
            // Ricarica datatable
            $this->client_manager->reload_datatable($button_id, 'grid');
        }
        
        $this->client_manager->flush();
    }
    
    public function on_apikeys_confirm_detail($operation, $button_id, $info) {
        
        // Decodifica info passate dal componente
        $decoded_info = component_decode_info($info);
        
        // Controlla tipo operazione
        switch ($operation) {
            case self::OPERATION_INSERT:
                $dialogName = 'toolbar-add';
                if ($button_id === 'btn_confirm') {
                    $method = 'insert';
                    $method_params = [$decoded_info];
                }
                break;
            case self::OPERATION_UPDATE:
                $dialogName = 'toolbar-edit';
                if ($button_id === 'btn_confirm') {
                    $method = 'update';
                    $method_params = [$decoded_info->fen_id, $decoded_info];
                }
                break;
        }
                
        // Effettua salvataggio dei dati 
        if ($button_id === 'btn_confirm') {
            
            // Cancella dati utilizzando il model
            if (call_user_func_array([$this->get_model_frontends(), $method], $method_params)) {
                $this->client_manager->show_info_message($button_id, $this->lang->line('info'), $this->lang->line('operazione_effettuata_con_successo'));                
            } else {
                $this->client_manager->show_error_message($button_id, $this->lang->line('errore'), $this->lang->line('errore_cancellazione_elemento'));
            }
            
            // Ricarica datatable
            $this->client_manager->reload_datatable($button_id, 'grid');
        }
                        
        // Chiude dialog
        $this->client_manager->close_dialog($dialogName, FALSE, TRUE);
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
    
    private function get_model_frontends() {
        $controller_name = 'Frontends';
        $model_alias = controller_name_to_model_alias($controller_name);
        instance_model_by_controller('admin', $controller_name);
        return $this->$model_alias;
    }
    
}
