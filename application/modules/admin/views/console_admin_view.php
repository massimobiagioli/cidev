<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$this->lang->line('console_amministrazione')?></title>
    <?=$includes?>
    <link rel="stylesheet" href="<?php echo admin_assets_css_console_url(); ?>" />
</head>
<body class="console-body">    
    <header>
        <div align="center">
            <h2 class="console-header ui-widget"><?=$this->lang->line('console_amministrazione')?></h2>
        </div>
    </header>
    <div class="console-wrapper">
        <main class="console-main">
            <div id="console-main-content"></div>
        </main>
        <nav class="console-nav">                        
            <cd-panelmenu id="sidebar" width="300px">
                <cd-panelmenuitem id="apikeys" icon="fa-key" autoexpand="true"><?=$this->lang->line('api_keys')?>
                    <cd-panelmenusubitem id="apikeys-handler" 
                                         icon="fa-bank"
                                         menuClickHandler="<?php echo components_get_handler('admin', 'LoginAdmin', 'on_console_sidebar_click') ?>">
                        <?=$this->lang->line('gestione_api_keys')?>
                    </cd-panelmenusubitem>
                </cd-panelmenuitem>
                <cd-panelmenuitem id="actions" icon="fa-gear" autoexpand="true"><?=$this->lang->line('azioni')?>
                    <cd-panelmenusubitem id="action-exit" 
                                         icon="fa-close"
                                         menuClickHandler="<?php echo components_get_handler('admin', 'LoginAdmin', 'on_console_sidebar_click') ?>">
                        <?=$this->lang->line('esci')?>
                    </cd-panelmenusubitem>
                </cd-panelmenuitem>
            </cd-panelmenu>                        
        </nav>
    </div>
</body>
</html>