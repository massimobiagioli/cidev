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
    const OPERATION_CLOSE_DIALOG = 'close_dialog';
    const OPERATION_RELOAD_DATATABLE = 'reload_datatable';
    const OPERATION_SET_DIV_CONTENT = 'set_div_content';
    
    /*
     * Costanti per livello di messaggio
     */
    const MSG_SEVERITY_INFO = 'info';
    const MSG_SEVERITY_WARNING = 'warning';
    const MSG_SEVERITY_ERROR = 'error';
    
    /*
     * Costanti per valori di default
     */
    const DEFAULT_DIALOG_MIN_WIDTH = 150;
    const DEFAULT_DIALOG_WIDTH = 300;
    
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
            'title' => $dialog_info['title'],
            'showEffect' => (array_key_exists('showEffect', $dialog_info) ? $dialog_info['showEffect'] : ''),
            'hideEffect' => (array_key_exists('hideEffect', $dialog_info) ? $dialog_info['hideEffect'] : ''),
            'minimizable' => (array_key_exists('minimizable', $dialog_info) ? $dialog_info['minimizable'] : TRUE),
            'maximizable' => (array_key_exists('maximizable', $dialog_info) ? $dialog_info['maximizable'] : TRUE),
            'responsive' => (array_key_exists('responsive', $dialog_info) ? $dialog_info['responsive'] : TRUE),
            'width' => (array_key_exists('width', $dialog_info) ? $dialog_info['width'] : self::DEFAULT_DIALOG_WIDTH),
            'minWidth' => (array_key_exists('minWidth', $dialog_info) ? $dialog_info['minWidth'] : self::DEFAULT_DIALOG_MIN_WIDTH),
            'modal' => (array_key_exists('modal', $dialog_info) ? $dialog_info['modal'] : TRUE)
        ]);
        
        // Controlla se deve fare la flush immediata
        if ($flush) {
            $this->flush();
        }
    }
    
    /**
     * Chiude dialog
     * @param string $dialog_name Nome dialog
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function close_dialog($dialog_name, $clear = FALSE, $flush = FALSE) {
        
        // Controlla svuotamento operazioni client
        if ($clear) {
            $this->clear_client_operations();
        }
        
        // Aggiunge operazione client specifica
        $this->add_client_operation(self::OPERATION_CLOSE_DIALOG, $dialog_name);
        
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
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function show_info_message($sender, $title, $message, $clear = FALSE, $flush = FALSE) {
        $this->show_message($sender, self::MSG_SEVERITY_INFO, $title, $message, $clear, $flush);
    }
    
    /**
     * Mostra messaggio di avvertimento
     * @param string $sender Originatore
     * @param string $title Titolo dialog
     * @param string $message Messaggio
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function show_warning_message($sender, $title, $message, $clear = FALSE, $flush = FALSE) {
        $this->show_message($sender, self::MSG_SEVERITY_WARNING, $title, $message, $clear, $flush);
    }
    
    /**
     * Mostra messaggio di errore
     * @param string $sender Originatore
     * @param string $title Titolo dialog
     * @param string $message Messaggio
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function show_error_message($sender, $title, $message, $clear = FALSE, $flush = FALSE) {
        $this->show_message($sender, self::MSG_SEVERITY_ERROR, $title, $message, $clear, $flush);
    }
    
    /**
     * Mostra domanda
     * @param string $sender Originatore
     * @param string $title Titolo dialog
     * @param string $message Messaggio
     * @param array $buttons Pulsanti
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function show_question($sender, $title, $message, $buttons, $clear = FALSE, $flush = FALSE) {
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
        $this->load_view_into_dialog($sender, $dialog_info, $clear, $flush);
    }    
    
    /**
     * Mostra messaggio
     * @param string $sender Originatore
     * @param string $severity Livello messaggio (info/warning/message)
     * @param string $title Titolo dialog
     * @param string $message Messaggio
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    private function show_message($sender, $severity, $title, $message, $clear = FALSE, $flush = FALSE) {
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
        $this->load_view_into_dialog($sender, $dialog_info, $clear, $flush);
    }
    
    /**
     * Ricarica Datatable
     * @param string $sender Originatore
     * @param string $datatable_id Id datatable
     * @param boolean $clear TRUE svuota operazioni client, FALSE aggiunge operazione alla lista esistente
     * @param boolean $flush TRUE effettua la flush immediata, FALSE non effettua la flush
     */
    public function reload_datatable($sender, $datatable_id, $clear = FALSE, $flush = FALSE) {
        
        // Controlla svuotamento operazioni client
        if ($clear) {
            $this->clear_client_operations();
        }
        
        // Aggiunge operazione client specifica
        $this->add_client_operation(self::OPERATION_RELOAD_DATATABLE, $sender, [
            'target' => $datatable_id
        ]);
        
        // Controlla se deve fare la flush immediata
        if ($flush) {
            $this->flush();
        }
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
    
    private function add_client_operation($type, $sender, $params = []) {
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