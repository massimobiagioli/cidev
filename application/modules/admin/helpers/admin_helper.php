<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('admin_confirm_login_url')) {
    /**
     * Restituisce Form Action Login
     * @return Form Action Login
     */
    function admin_form_action_login() {
        return base_url() . 'admin/LoginAdmin/confirm_login';
    }    
}
