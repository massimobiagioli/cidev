<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gestione comunicazione con il client
 */
class Client_manager {
    
    const OPERATION_SET_DIV_CONTENT = 'set_div_content';
    
    /**
     * Elenco operazioni client
     * @var array 
     */
    private $client_operations;
    
    public function __construct() {
        $this->clear_client_operations();
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
     * Invia operazioni al client
     */
    public function flush() {
        echo json_encode([
            'client_operations' => $this->client_operations
        ]);
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