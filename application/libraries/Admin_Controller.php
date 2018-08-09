<?php
  class Admin_Controller extends MY_Controller {
    function __construct() {
      parent::__construct();

      $this->data['admin_title'] = 'POS'; // Backend/Admin Title

      // Controls the Visibility of Menus
      $this->data['navbar_menu']['_top_lef'] = TRUE;
      $this->data['navbar_menu']['_top_rit'] = TRUE;

      // $this->data['navbar_menu']['_bot_lef'] = TRUE;
      // $this->data['navbar_menu']['_bot_rit'] = TRUE;

      $this->data['navbar_menu']['_lef_sid'] = TRUE;
      // $this->data['navbar_menu']['_rit_sid'] = TRUE;
      
      //Add Backend CSS
      $this->data['styles'] = array(
        'bootstrap'       =>  'css/bootstrap.min.css',
        'metisMenu'       =>  'css/plugins/metisMenu/metisMenu.min.css',
        'sb-admin-2'      =>  'css/sb-admin-2.css',
        'jasny-bootstrap' =>  'css/jasny-bootstrap.css',
        'font-awesome'    =>  'font-awesome-4.1.0/css/font-awesome.min.css',
      );

      // Add JavaScript/jQuery in Header      
      $this->data['footer_scripts'] = array(
        'bootstrap'       =>  'js/bootstrap.min.js',
        'metisMenu'       =>  'js/plugins/metisMenu/metisMenu.min.js',
        'sb-admin-2'      =>  'js/sb-admin-2.js',
        'jasny-bootstrap' =>  'js/jasny-bootstrap.js',
        'jquery-form'     =>  'js/jquery.form.js',
        'jquery-validate' =>  'js/jquery.validate.js',
      );

      // Add JavaScript/jQuery in Footer
      $this->data['header_scripts'] = array(
        'jquery'      =>  'js/jquery.js',
      );

      $this->load->helper( array('file', 'form', 'form_addons', 'templar') );
      $this->load->helper( array('debugger',) );

      $this->load->library('form_validation');
      
      // Add default models and load
      $models = array('_backend/user/m_tbl_users',);

      return FALSE; // Uncomment to enabled User Authentication

      foreach ($models as $model)
        $this->load->model($model);
      
      // Login Check
      $exception_uris = array(
        'admin/user/login',
        'admin/user/logout',
      );

      if (in_array(uri_string(), $exception_uris) == FALSE) {
        if ($this->m_tbl_users->loggedin() == FALSE)
          redirect('admin/user/login');
      }

      // End Construct
    }

  }