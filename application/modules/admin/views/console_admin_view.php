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
            <p-tieredmenu>
                <p-submenu value="<?=$this->lang->line('api_keys')?>" icon="fa-key">
                    <p-menuitem value="<?=$this->lang->line('gestione_api_keys')?>" icon="fa-bank"></p-menuitem>
                </p-submenu>
                <p-menuitem value="<?=$this->lang->line('esci')?>" icon="fa-close"></p-menuitem>
            </p-tieredmenu>
        </nav>
    </div>
</body>
</html>