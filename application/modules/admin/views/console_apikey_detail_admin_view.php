<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div>
    <cd-form-wrapper operation="<?=$operation?>">
        
        <div class="ui-grid ui-grid-responsive">
            
            <!-- Id -->
            <input type="hidden" id="fen_id" name="fen_id"
                   value="<?=($info ? $info->fen_id : 0)?>"/>
            
            <!-- Nome -->
            <div class="ui-grid-row" style="margin-bottom: 5px;">
                <div class="ui-grid-col-2" style="text-align: right; margin-right: 5px;">
                    <label for="fen_name"><?=$this->lang->line('nome')?></label>
                </div>
                <div class="ui-grid-col-10">
                    <input type="text" is="p-inputtext" id="fen_name" name="fen_name" size="55" 
                           value="<?=($info ? $info->fen_name : '')?>" required autofocus/>
                </div>
            </div>
            
            <!-- API-key -->
            <div class="ui-grid-row" style="margin-bottom: 5px;">
                <div class="ui-grid-col-2" style="text-align: right; margin-right: 5px;">
                    <label for="fen_api_key"><?=$this->lang->line('api_key')?></label>
                </div>
                <div class="ui-grid-col-10">
                    <input type="text" is="p-inputtext" id="fen_api_key" name="fen_api_key" size="55" 
                           value="<?=($info ? $info->fen_api_key : '')?>" required/>
                </div>
            </div>
            
            <!-- Disabilitato -->
            <div class="ui-grid-row" style="margin-bottom: 5px;">
                <div class="ui-grid-col-2" style="text-align: right; margin-right: 5px;">
                    <label for="fen_disabled"><?=$this->lang->line('disabilitato')?></label>
                </div>
                <div class="ui-grid-col-10">
                    <input type="checkbox" is="p-checkbox" id="fen_disabled" name="fen_disabled" 
                           value="<?=($info ? $info->fen_disabled : '')?>"
                           <?php if ($info && $info->fen_disabled): ?>checked<?php endif;?>/>
                </div>
            </div>
        </div>  
        
        <hr>
        
        <!-- Pulsanti -->
        <div id="button_container" style="text-align: center">
            
            <!-- Conferma -->
            <button 
                is="p-button" 
                id="btn_confirm"
                data-clickhandler="<?=components_get_handler('admin', 'LoginAdmin', 'on_apikeys_confirm_detail')?>"><?=$this->lang->line('conferma')?></button>
            
            <!-- Annulla -->
            <button 
                is="p-button" 
                id="btn_cancel"
                data-clickhandler="<?=components_get_handler('admin', 'LoginAdmin', 'on_apikeys_confirm_detail')?>"><?=$this->lang->line('annulla')?></button> 
        </div>
        
    </cd-form-wrapper>
</div>