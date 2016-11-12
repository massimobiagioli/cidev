<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('admin_form_action_login')) {
    /**
     * Restituisce URL console di amministrazione
     * @return URL console di amministrazione
     */
    function admin_form_action_login() {
        return base_url() . 'admin/LoginAdmin/show_console';
    }    
}
