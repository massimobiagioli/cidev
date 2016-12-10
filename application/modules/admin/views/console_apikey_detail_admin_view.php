<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div>
    <form method="POST" action="<?=components_get_handler('admin', 'LoginAdmin', 'on_confirm_detail')?>">
            
        <div class="ui-grid ui-grid-responsive">
            
            <!-- Nome -->
            <div class="ui-grid-row" style="margin-bottom: 5px;">
                <div class="ui-grid-col-2" style="text-align: right; margin-right: 5px;">
                    <label for="fen_name"><?=$this->lang->line('nome')?></label>
                </div>
                <div class="ui-grid-col-10">
                    <input type="text" is="p-inputtext" name="fen_name" size="55" value="" required autofocus/>
                </div>
            </div>
            
            <!-- API-key -->
            <div class="ui-grid-row" style="margin-bottom: 5px;">
                <div class="ui-grid-col-2" style="text-align: right; margin-right: 5px;">
                    <label for="fen_api_key"><?=$this->lang->line('api_key')?></label>
                </div>
                <div class="ui-grid-col-10">
                    <input type="text" is="p-inputtext" name="fen_api_key" size="55" value="" required/>
                </div>
            </div>
            
            <!-- Disabilitato -->
            <div class="ui-grid-row" style="margin-bottom: 5px;">
                <div class="ui-grid-col-2" style="text-align: right; margin-right: 5px;">
                    <label for="fen_disabled"><?=$this->lang->line('disabilitato')?></label>
                </div>
                <div class="ui-grid-col-10">
                    <input type="checkbox" is="p-checkbox" name="fen_disabled" value=""/>
                </div>
            </div>
        </div>  
        
        <hr>

        <!-- Pulsanti -->
        <div style="text-align: center">
            <button is="p-button" type="submit" id="btn_confirm"><?=$this->lang->line('conferma')?></button>
            <button is="p-button" id="btn_cancel"><?=$this->lang->line('annulla')?></button> 
        </div>

    </form>
</div>