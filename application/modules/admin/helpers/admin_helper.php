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

if (!function_exists('admin_assets_css_login_url')) {
    /**
     * Restituisce URL file css login amministrazione
     * @return URL file css login amministrazione
     */
    function admin_assets_css_login_url() {
        return assets_base_url() . '/admin/css/login_admin.css';
    }    
}

if (!function_exists('admin_assets_css_console_url')) {
    /**
     * Restituisce URL file css console di amministrazione
     * @return URL file css console di amministrazione
     */
    function admin_assets_css_console_url() {
        return assets_base_url() . '/admin/css/console_admin.css';
    }    
}
