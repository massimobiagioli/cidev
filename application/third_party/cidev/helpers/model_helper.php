<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Istanzia model a partire dal nome della tabella fisica
 * @param string $table_name Nome tabella fisica
 */
function instance_model($table_name) {
    //TODO Fallback su model specifico
    $CI =& get_instance();
    $CI->load->model(table_name_to_model_name($table_name), strtolower($table_name));
}

/**
 * Restituisce nome model da nome tabella fisica
 * @param string $table_name Nome tabella fisica
 * @return string nome model
 */
function table_name_to_model_name($table_name) {
    return strtolower($table_name) . '_model';
}