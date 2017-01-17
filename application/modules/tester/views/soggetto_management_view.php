<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DEMO - SOGGETTI</title>
    <?=$includes?>
</head>
<body>
    <!-- Toolbar -->
    <div id="toolbar">
        <cd-toolbar id="main-toolbar"
                    linkedgrid="grid"
                    buttonclickhandler="<?=components_get_handler('tester', 'Soggetto_management_form', 'on_toolbar_click')?>">
            <cd-toolbaritem id="toolbar-add" icon="fa-plus">
                <?=$this->lang->line('toolbar_aggiungi')?>
            </cd-toolbaritem>
            <cd-toolbaritem id="toolbar-edit" icon="fa-pencil">
                <?=$this->lang->line('toolbar_modifica')?>
            </cd-toolbaritem>
            <cd-toolbaritem id="toolbar-delete" icon="fa-trash">
                <?=$this->lang->line('toolbar_elimina')?>
            </cd-toolbaritem>
        </cd-toolbar>
    </div>
    
    <!-- Datatable -->
    <cd-datatable-wrapper 
        datasource="<?=base_url('tester/Soggetto/query/')?>"
        querylimit="5">
        
        <cd-datatable id="grid"  
                     paginator 
                     lazy
                     totalrecords="6"
                     selectionmode="single" 
                     caption="Soggetti"
                     emptymessage="<?=$this->lang->line('nessun_elemento_trovato')?>">
            <p-column field="sog_id" headertext="<?=$this->lang->line('caption_ID')?>" sortable filter></p-column>
            <p-column field="sog_nominativo" headertext="Nominativo" sortable filter></p-column>
            <p-column field="sog_indirizzo" headertext="Indirizzo" sortable filter></p-column>
        </cd-datatable>
    </cd-datatable-wrapper>
</body>
</html>