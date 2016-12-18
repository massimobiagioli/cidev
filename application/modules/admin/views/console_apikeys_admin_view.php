<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div>
    <!-- Toolbar -->
    <div id="toolbar">
        <cd-toolbar id="main-toolbar"
                    linkedgrid="grid"
                    buttonclickhandler="<?=components_get_handler('admin', 'LoginAdmin', 'on_apikeys_toolbar_click')?>">
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
    <div id="datatable">
        <cd-datatable-wrapper>
            <p-datatable id="grid" datasource="<?=base_url('admin/Frontends/query/' . $filters)?>" 
                         paginator rows="10" 
                         selectionmode="single" 
                         caption="<?=$this->lang->line('gestione_api_keys')?>"
                         emptyMessage="<?=$this->lang->line('nessun_elemento_trovato')?>">
                <p-column field="fen_id" headertext="<?=$this->lang->line('caption_ID')?>" sortable filter></p-column>
                <p-column field="fen_name" headertext="<?=$this->lang->line('caption_nome')?>" sortable filter></p-column>
                <p-column field="fen_api_key" headertext="<?=$this->lang->line('caption_api_key')?>" sortable filter></p-column>
                <p-column field="fen_disabled" headertext="<?=$this->lang->line('caption_disabilitato')?>" sortable filter></p-column>
            </p-datatable>
        </cd-datatable-wrapper>
    </div>
</div>