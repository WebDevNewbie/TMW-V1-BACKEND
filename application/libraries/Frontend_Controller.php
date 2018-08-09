<?php
  class Frontend_Controller extends MY_Controller {
    function __construct() {
      parent::__construct();

      //Add Backend CSS
      $this->data['styles'] = array();

      // Add JavaScript/jQuery in Header      
      $this->data['header_scripts'] = array();

      // Add JavaScript/jQuery in Footer
      $this->data['footer_scripts'] = array();

      $this->load->helper( array('file', 'form', 'form_addons') );
      $this->load->library('form_validation');
      
      $models = array();

      foreach ($models as $model)
        $this->load->model($model);
    }
  }