<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('assets_base_url')) {
    /**
     * Restituisce URL base Assets
     * @return string URL base Assets
     */
    function assets_base_url() {
        return base_url() . 'assets';
    }    
}

if (!function_exists('assets_js_url')) {
    /**
     * Restituisce URL base Javascript
     * @return string URL base Javascript
     */
    function assets_js_url() {
        return assets_base_url() . '/js';
    }    
}

if (!function_exists('assets_css_url')) {
    /**
     * Restituisce URL base CSS
     * @return string URL base CSS
     */
    function assets_css_url() {
        return assets_base_url() . '/css';
    }    
}

if (!function_exists('assets_img_url')) {
    /**
     * Restituisce URL base Immagini
     * @return string URL base Immagini
     */
    function assets_img_url() {
        return assets_base_url() . '/img';
    }    
}

if (!function_exists('assets_jquery_url')) {
    /**
     * Restituisce URL base JQuery
     * @return string URL base JQuery
     */
    function assets_jquery_url() {
        return assets_base_url() . '/bower_components/jquery/dist/jquery.min.js';
    }    
}

if (!function_exists('assets_jqueryui_url')) {
    /**
     * Restituisce URL base JQueryUI
     * @return string URL base JQueryUI
     */
    function assets_jqueryui_url() {
        return assets_base_url() . '/bower_components/jqueryui/jquery-ui.min.js';
    }    
}

if (!function_exists('assets_xtagcore_url')) {
    /**
     * Restituisce URL base X-Tag-Core
     * @return string URL base X-Tag-Core
     */
    function assets_xtagcore_url() {
        return assets_base_url() . '/bower_components/x-tag-core/dist/x-tag-core.js';
    }    
}

if (!function_exists('assets_primeui_url')) {
    /**
     * Restituisce URL base PrimeUI
     * @return string URL base PrimeUI
     */
    function assets_primeui_url() {
        return assets_base_url() . '/bower_components/primeui/primeui-all.min.js';
    }    
}

if (!function_exists('assets_primeui_css_url')) {
    /**
     * Restituisce URL base PrimeUI css
     * @return string URL base PrimeUI css
     */
    function assets_primeui_css_url() {
        return assets_base_url() . '/bower_components/primeui/primeui-all.min.css';
    }    
}

if (!function_exists('assets_font_awesome_css_url')) {
    /**
     * Restituisce URL base font-awesome css
     * @return string URL base font-awesome css
     */
    function assets_font_awesome_css_url() {
        return assets_base_url() . '/bower_components/fontawesome/css/font-awesome.min.css';
    }    
}

if (!function_exists('assets_primeelements_url')) {
    /**
     * Restituisce URL base PrimeElements
     * @return string URL base PrimeElements
     */
    function assets_primeelements_url() {
        return assets_base_url() . '/bower_components/primeui/primeelements.min.js';
    }    
}

if (!function_exists('assets_primeui_theme_css_url')) {
    /**
     * Restituisce URL base PrimeUI Theme css
     * @return string URL base PrimeUI Theme css
     */
    function assets_primeui_theme_css_url() {
        return assets_base_url() . '/bower_components/primeui/themes/cupertino/theme.css';
    }    
}

if (!function_exists('assets_default_css_url')) {
    /**
     * Restituisce URL base css default
     * @return string URL base css default
     */
    function assets_default_css_url() {
        return assets_base_url() . '/common/css/default.css';
    }    
}

if (!function_exists('assets_cidev_client_js_url')) {
    /**
     * Restituisce URL js cidev
     * @return string URL js cidev
     */
    function assets_cidev_client_js_url() {
        return assets_base_url() . '/js/cidev.min.js';
    }    
}
