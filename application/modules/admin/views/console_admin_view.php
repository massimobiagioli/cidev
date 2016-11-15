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
            <div id="sidebar" style="width:300px">
                <div>
                    <div><a id="menu-api-keys" data-icon="fa-key"><?=$this->lang->line('api_keys')?></a></div>
                    <div>
                        <ul>
                            <li><a data-icon="fa-bank"><?=$this->lang->line('gestione_api_keys')?></a></li>                            
                        </ul>
                    </div>                    
                </div>
                <div>
                    <div><a id="menu-action" data-icon="fa-gear"><?=$this->lang->line('azioni')?></a></div>
                    <div>
                        <ul>
                            <li><a data-icon="fa-close"><?=$this->lang->line('esci')?></a></li>                            
                        </ul>
                    </div>        
                </div>
            </div>                        
        </nav>
    </div>
    
    <script>
        $('#sidebar').puipanelmenu();
        $('#menu-api-keys').trigger('click');
        $('#menu-action').trigger('click');
    </script>
    
</body>
</html>