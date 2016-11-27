<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div>
    <!-- Toolbar -->
    <div id="toolbar">
        
    </div>
    
    <!-- Datatable -->
    <div id="datatable">
        <cd-datatable-wrapper>
            <p-datatable datasource="<?=base_url('admin/Frontends/query/' . $filters)?>" 
                         paginator rows="10" 
                         selectionmode="single" 
                         caption="<?=$this->lang->line('gestione_api_keys')?>">
                <p-column field="fen_id" headertext="<?=$this->lang->line('caption_ID')?>" sortable filter></p-column>
                <p-column field="fen_name" headertext="<?=$this->lang->line('caption_nome')?>" sortable filter></p-column>
                <p-column field="fen_api_key" headertext="<?=$this->lang->line('caption_api_key')?>" sortable filter></p-column>
                <p-column field="fen_disabled" headertext="<?=$this->lang->line('caption_disabilitato')?>" sortable filter></p-column>
            </p-datatable>
        </cd-datatable-wrapper>
    </div>
</div>