<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('_titlecase')) {
    function _titlecase($string) {
        return ucwords(strtolower($string));        
    }
}