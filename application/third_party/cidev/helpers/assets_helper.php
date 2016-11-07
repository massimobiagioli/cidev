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

if (!function_exists('assets_xtagcore_url')) {
    /**
     * Restituisce URL base X-Tag-Core
     * @return string URL base X-Tag-Core
     */
    function assets_xtagcore_url() {
        return assets_base_url() . '/bower_components/x-tag-core/dist/x-tag-core.js';
    }    
}
