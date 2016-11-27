<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Modules DB Connection
|
| Popolamento array:
|  key: nome modulo
|  value: nome connessione
| (Se non presente la chiave del modulo nell'array, si assume come nome
|  del database il nome del modulo stesso)
|--------------------------------------------------------------------------
 */
$config['modules_db_connections'] = array();

/*
|--------------------------------------------------------------------------
| Associazione controller a nome tabella fisica
|
| Popolamento array:
|  key: nome controller
|  value: array:
|           table_name: nome tabella fisica
|           model_alias: nome alias model  
| (Se non presente la chiave del controller nell'array, si va di CoC)
|--------------------------------------------------------------------------
 */
/*$config['controllers_assoc'] = array(
    'Soggetto' => array(
        'table_name' => 'soggetto',
        'model_alias' => 'soggetto'
    )
);*/

$config['controllers_assoc'] = array();

/*
|--------------------------------------------------------------------------
| Parametri paginazione query
|
| Se il model non è presente nella mappa, assume il valore di default  
|--------------------------------------------------------------------------
 */
$config['default_query_limit'] = 10;
$config['models_query_limit'] = array();