<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  if ( !function_exists('_templar') ) {
    /**
     * @function _templar(), accept $array and $element as arrays to load local template(s)
     * 
     * @param array ($array ) accept "key" => "value" pair value
     * @param integer $key to position element in an array, default 0
     * @return specified in "key" => "value"
     * 
     * Usage: _templar($array, array('index_name' => 'path/to/local/static/file'), key); 
     *
     * Example: Load "pinterest-style.css" and positon element by key of 4
     * $styles = _templar($styles, array('pinterest_css'  => 'css/homemaid/frontend/pinterest-style.css'), 4);
    */

    function _templar($array = array(), $element = array(), $key = 0) {
      return array_merge( array_slice($array, 0, $key), $element, array_slice($array, $key) );
    }
  }