<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gestione comunicazione con il client
 */
class Client_manager {
    
    /*
     * Costanti per operazioni client
     */
    const OPERATION_CHANGE_VIEW = 'change_view';
    const OPERATION_CONSOLE_LOG = 'console_log';
    const OPERATION_CREATE_DIALOG_WITH_CONTENT = 'create_dialog_with_content';
    const OPERATION_SET_DIV_CONTENT = 'set_div_content';
    
    const MSG_SEVERITY_INFO = 'info';
    const MSG_SEVERITY_WARNING = 'warning';
    const MSG_SEVERITY_ERROR = 'error';
    
    /**
     * Riferimento a Codeigniter
     * @var object 
     */
    private $CI;
    
    /**
     * Elenco operazioni client
     * @var array 
     */
    private $client_operations;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->clear_client_operations();
    }
    
    /**
     * Effettua log attraverso la console
     * @param string $sender Elemento originatore
     * @param string $msg Messaggio
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function console_log($sender, $msg, $clear = FALSE, $flush = FALSE) {
        
        // Controlla svuotamento operazioni client
        if ($clear) {
            $this->clear_client_operations();
        }
        
        // Aggiunge operazione client specifica
        $this->add_client_operation(self::OPERATION_CONSOLE_LOG, $sender, [
            'msg' => $msg
        ]);
        
        // Controlla se deve fare la flush immediata
        if ($flush) {
            $this->flush();
        }
    }
    
    /**
     * Cambia view
     * @param string $sender Elemento originatore
     * @param string $view Nuova view
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function change_view($sender, $view, $clear = FALSE, $flush = FALSE) {
        
        // Controlla svuotamento operazioni client
        if ($clear) {
            $this->clear_client_operations();
        }
        
        // Aggiunge operazione client specifica
        $this->add_client_operation(self::OPERATION_CHANGE_VIEW, $sender, [
            'url' => base_url($view)
        ]);
        
        // Controlla se deve fare la flush immediata
        if ($flush) {
            $this->flush();
        }
    }
    
    /**
     * Cambia view
     * @param string $sender Elemento originatore
     * @param string $dialog_info Info dialog:
     *                  - view: Nome view da caricare nella dialog
     *                  - title: Titolo dialog
     *                  (dialog properties)
     *                  - showEffect
     *                  - hideEffect
     *                  - minimizable
     *                  - maximizable
     *                  - responsive
     *                  - minWidth
     *                  - modal
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function load_view_into_dialog($sender, $dialog_info, $clear = FALSE, $flush = FALSE) {
        
        // Controlla svuotamento operazioni client
        if ($clear) {
            $this->clear_client_operations();
        }
        
        // Aggiunge operazione client specifica
        $view_content = $this->CI->load->view($dialog_info['view']['name'], $dialog_info['view']['data'], TRUE);
        $this->add_client_operation(self::OPERATION_CREATE_DIALOG_WITH_CONTENT, $sender, [
            'content' => $view_content,
            'title' => $dialog_info['title']
        ]);
        
        // Controlla se deve fare la flush immediata
        if ($flush) {
            $this->flush();
        }
    }
    
    /**
     * Imposta contenuto di un div
     * @param string $sender Elemento originatore
     * @param string $target ID div
     * @param string $content Contenuto da aggiungere al div
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function set_div_content($sender, $target, $content, $clear = FALSE, $flush = FALSE) {
        
        // Controlla svuotamento operazioni client
        if ($clear) {
            $this->clear_client_operations();
        }
        
        // Aggiunge operazione client specifica
        $this->add_client_operation(self::OPERATION_SET_DIV_CONTENT, $sender, [
            'target' => $target,
            'content' => $content
        ]);
        
        // Controlla se deve fare la flush immediata
        if ($flush) {
            $this->flush();
        }
    }
    
    /**
     * Imposta contenuto di un div
     * @param string $sender Elemento originatore
     * @param string $target ID div
     * @param array $view Informazioni della view:
     *                      - 'name' => nome view
     *                      - 'data' => dati da passare alla view
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function set_div_content_by_view($sender, $target, $view, $clear = FALSE, $flush = FALSE) {
        $view_content = $this->CI->load->view($view['name'], $view['data'], TRUE);
        $this->set_div_content($sender, $target, $view_content, $clear, $flush);
    }
    
    /**
     * Mostra messaggio di info
     * @param string $sender Originatore
     * @param string $title Titolo dialog
     * @param string $message Messaggio
     */
    public function show_info_message($sender, $title, $message) {
        $this->show_message($sender, self::MSG_SEVERITY_INFO, $title, $message);
    }
    
    /**
     * Mostra messaggio di avvertimento
     * @param string $sender Originatore
     * @param string $title Titolo dialog
     * @param string $message Messaggio
     */
    public function show_warning_message($sender, $title, $message) {
        $this->show_message($sender, self::MSG_SEVERITY_WARNING, $title, $message);
    }
    
    /**
     * Mostra messaggio di errore
     * @param string $sender Originatore
     * @param string $title Titolo dialog
     * @param string $message Messaggio
     */
    public function show_error_message($sender, $title, $message) {
        $this->show_message($sender, self::MSG_SEVERITY_ERROR, $title, $message);
    }
    
    /**
     * Mostra domanda
     * @param string $sender Originatore
     * @param string $title Titolo dialog
     * @param string $message Messaggio
     * @param array $buttons Pulsanti
     */
    public function show_question($sender, $title, $message, $buttons) {
        $dialog_info = [
            'view' => [
                'name' => 'common/common_question_view',
                'data' => [
                    'message' => $message,
                    'buttons' => $buttons
                ]
            ],
            'title' => $title,
            'modal' => TRUE
        ];
        $this->load_view_into_dialog($sender, $dialog_info, TRUE, TRUE);
    }    
    
    /**
     * Mostra messaggio
     * @param string $sender Originatore
     * @param string $severity Livello messaggio (info/warning/message)
     * @param string $title Titolo dialog
     * @param string $message Messaggio
     */
    private function show_message($sender, $severity, $title, $message) {
        $dialog_info = [
            'view' => [
                'name' => 'common/common_message_view',
                'data' => [
                    'message' => $message,
                    'severity' => $severity
                ]
            ],
            'title' => $title,
            'modal' => TRUE
        ];
        $this->load_view_into_dialog($sender, $dialog_info, TRUE, TRUE);
    }
    
    /**
     * Invia operazioni al client
     */
    public function flush() {
        $result = json_encode([
            'client_operations' => $this->client_operations
        ]);
        $this->CI->output->set_output($result); 
    }
    
    private function clear_client_operations() {
        $this->client_operations = [];
    }
    
    private function add_client_operation($type, $sender, $params) {
        $this->client_operations[] = [
            'type' => $type,
            'sender' => $sender,
            'params' => $params
        ];
    }
    
    public function get_client_operations() {
        return $this->client_operations;
    }

    public function set_client_operations($client_operations) {
        $this->client_operations = $client_operations;
    }
    
}