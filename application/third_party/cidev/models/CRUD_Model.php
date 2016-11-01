<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CRUD Model - Superclass
 */
class CRUD_Model extends CI_Model {
    
    private $table_name; 
    private $table_fields = [];
    private $pks = [];
    
    public function __construct() {
        parent::__construct();
        $this->init_vars();
    }
    
    /**
     * Inizializzazione variabili model
     */
    private function init_vars() {
        $this->init_custom_vars();
    }
    
    /**
     * Inizializzazione variabili specifiche
     * Implementare nelle sottoclassi
     */
    protected function init_custom_vars() {        
    }
    
    public function pre_load($id) {
    }
    
    public function post_load($id, &$result) {
    }
    
    /**
     * Caricamento record per chiave
     * @param int $id ID tabella
     * @return mixed Record identificato dalla chiave se trovato, altrimenti false
     */
    public function load($id) {
        try {       
            $this->pre_load($id);
            
            $query = $this->db->get_where($this->table_name, array($this->pks[0] => $id));                
            $result = $this->transform_result_row($query->row());
            
            $this->post_load($id, $result);
            
            return $result;
        } catch (Exception $ex) {            
            log_message('error', $ex->getMessage());
            return false;
        }
    }    
    
    public function pre_query($query_data) {
    }
    
    public function post_query($query_data, &$result) {
    }
    
    /**
     * Caricamento dati in funzione dei criteri di ricerca/ordinamento in ingresso
     * @param object $query_data Oggetto QueryData
     * @return mixed Dati che soddisfano i criteri di ricerca, altrimenti false
     */
    public function query($query_data) {
        try {        
            $this->pre_query($query_data);
            
            $this->db->select('*')
                      ->from($this->table_name)
                      ->where($this->get_query_filters($query_data->filters));
            
            foreach ($query_data->sort as $sort) {
                $this->db->order_by($sort->field, $sort->type);
            }
            
            $this->db->limit($query_data->limit)
                      ->offset($query_data->offset);   
            
            $query = $this->db->get();  
            
            $result= $this->transform_result_list($query->result());
            
            $this->post_query($query_data, $result);
            
            return $result;
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return false;
        }
    }            
    
    /**
     * Conteggio record in funzione dei criteri di ricerca/ordinamento in ingresso
     * @param object $query_data Oggetto QueryData
     * @return mixed Numero record in caso di esito positivo, altrimenti false
     */
    public function count_query($query_data) {
        try {            
            $this->db->select("count({$this->pks[0]}) as RC")
                      ->from($this->table_name)
                      ->where($this->get_query_filters($query_data->filters));
                                    
            $query = $this->db->get();  
            
            return $query->row();
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return false;
        }
    }            
    
    public function pre_insert($data) {
    }
    
    public function post_insert($data, &$result) {
    }
    
    /**
     * Inserimento di un record sul database
     * @param object $data Dati da inserire
     * @return mixed Record inserito se esito positivo, altrimenti false
     */
    public function insert($data) {
        try {
            $this->db->trans_start();
            
            $this->pre_insert($data);
            
            $this->db->insert($this->table_name, $data);
            $id = $this->db->insert_id();
            $result = $this->transform_result_row($this->load($id));
            
            $this->post_insert($data, $result);
            
            $this->db->trans_complete();
            
            return $result;
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return false;
        }
    }
    
    public function pre_update($id, $data) {
    }
    
    public function post_update($id, $data, &$result) {
    }
    
    /**
     * Aggiornamento di un record sul database
     * @param object $id ID del record da aggiornare
     * @param object $data Dati da aggiornare
     * @return mixed Record aggiornato se esito positivo, altrimenti false
     */
    public function update($id, $data) {
        try {
            $this->db->trans_start();
            
            $this->pre_update($id, $data);
            
            $this->db->where($this->pks[0], $id);
            $this->db->update($this->table_name, $data);                                    
            $result = $this->transform_result_row($this->load($id));  
            
            $this->post_update($id, $data, $result);
            
            $this->db->trans_complete();
            
            return $result;
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return false;
        }
    }
    
    public function pre_delete($id) {
    }
    
    public function post_delete($id, &$result) {
    }
    
    /**
     * Cancellazione di un record sul database
     * @param object $id ID del record da cancellare
     * @return mixed Record eliminato se esito positivo, altrimenti false
     */
    public function delete($id) {
        try {
            $this->db->trans_start();
            
            $this->pre_delete($id);
            
            $row = $this->load($id);
            $this->db->delete($this->table_name, array($this->pks[0] => $id)); 
            $result = $this->transform_result_row($row);
            
            $this->post_delete($id, $result);
            
            $this->db->trans_complete();
            
            return $result;
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return false;
        }
    }
    
    private function get_query_filters($input_filters) {
        $query_filters = array();
        
        foreach ($input_filters as $input_filter) {
            $k = $input_filter->name . ($input_filter->operator ? (' ' . $input_filter->operator) : '');
            $query_filters[$k] = $input_filter->value;
        }
        
        return $query_filters;
    }
    
    /**
     * Trasforma record risultato
     * @param array $row Record da trasformare     
     * @return array Record trasformato
     */
    protected function transform_result_row($row) {
        return $row;
    }
    
    /**
     * Trasforma lista risultati
     * @param array $results Risultati da trasformare
     * @return array Risultati dopo la trasformazione
     */    
    private function transform_result_list($results) {
        return array_map(array($this, 'transform_result_row'), $results);
    }
    
    public function get_table_name() {
        return $this->table_name;
    }

    public function set_table_name($table_name) {
        $this->table_name = $table_name;
        $this->populate_table_info();
    }
    
    private function populate_table_info() {
        $this->table_fields = $this->db->field_data($this->get_table_name());
        
        // Populate PKs
        $this->pks = [];
        foreach ($this->table_fields as $field) {
            if ($field->primary_key == 1) {
                $this->pks[] = $field->name;
            }
        }
    }
    
    public function get_pks() {
        return $this->pks;
    }
    
}

