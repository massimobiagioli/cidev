<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$this->lang->line('accesso_console_amministrazione')?></title>
    <?=$includes?>
</head>
<body>    
    <cd-panelmenu id="sidebar" width="300px">
        <cd-panelmenuitem id="apikeys" icon="fa-key" expanded="true"><?=$this->lang->line('api_keys')?>
            <cd-panelmenusubitem id="apikeys-handler" href="#" icon="fa-bank"><?=$this->lang->line('gestione_api_keys')?></cd-panelmenusubitem>
        </cd-panelmenuitem>
        <cd-panelmenuitem id="actions" icon="fa-gear" expanded="true"><?=$this->lang->line('azioni')?>
            <cd-panelmenusubitem id="action-exit" href="#" icon="fa-close"><?=$this->lang->line('esci')?></cd-panelmenusubitem>
        </cd-panelmenuitem>
    </cd-panelmenu>
</body>
</html>