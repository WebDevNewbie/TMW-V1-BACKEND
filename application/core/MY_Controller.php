<?php
  class MY_Controller extends CI_Controller {
    public $data = array();

    public function __construct() {
      parent::__construct();
      // $this->data['errors'] = array();
      // $this->data['site_name'] = '';
      // $this->data['modal_title'] = 'Modal Title';
      // $this->data['page_header'] = uri_string();

      // $this->data['bodyclass'] = $this->bodyclass();
      // $this->data['segments'] = explode(' ', $this->bodyclass()); // Access URL segments

      // $this->data['user_agent'] = $this->user_agent();

      // $this->load->helper(array('debugger', 'templar'));
    }

    /* Generate CSS classes for body tag element */
    public function bodyclass() {
      $this->uri->uri_string();
      $this->uri->total_segments();
      
      $classes = '';
      $segments = explode('/', $this->uri->uri_string());
      foreach ($segments  as $segment) {
        $classes .= $segment . ' ';
      }  

      return trim(strtolower($classes));
    }

    public function user_agent() {
      if ($this->agent->is_browser()) {
          $agent = $this->agent->browser().' '.$this->agent->version();
      } elseif ($this->agent->is_mobile()) {
          $agent = $this->agent->mobile();
      }
      
      $agent = strtolower($agent . '' . $this->agent->platform());
      return str_replace('unknown', '', $agent); 
    }

    public function page_name($title = '', $align = 1){
      if($align == 2) {
        return $this->data['site_name'] . ' | ' . $title; 
      } elseif ($align == 1) {
        return $title . ' | ' . $this->data['site_name'];
      } else {
        return $this->data['site_name'];
      }
    }

    /**
      * CI2 Ref: http://www.codeigniter.com/user_guide/libraries/file_uploading.html
      */
    public function process_upload( $input_field_name, $config = array(), $dir_root = NULL ) {
      $dir_name = trim_slashes($config['upload_path']);
      if ( is_null($dir_root) ) // Default Upload Directory
        $dir_root = 'public';

      // Create Directory if not exist
      if ( !is_dir($dir_root) ) 
        mkdir('./' . $dir_root, 0777, TRUE);

      if ( !is_dir($dir_root . '/' . $dir_name) )
        mkdir('./' . $dir_root . '/' . $dir_name, 0777, TRUE);

      $config['upload_path'] = './' . $dir_root . '/' .  $dir_name . '/';  
      $this->upload->initialize($config);

      /** 
       * https://github.com/stvnthomas/CodeIgniter-Multi-Upload 
       */
      if ( !$this->upload->do_multi_upload($input_field_name) ) {        
        return array('upload_error' => $this->upload->display_errors('', ''));
      } else {
        $data = count($_FILES[$input_field_name]['name']) > 1 ? $this->upload->get_multi_upload_data() : $this->upload->data(); 
        return array('upload_data' => $data);
      }
    }

    /**
    * @var $config sets configuration options of pagination else return FALSE
    * ref: https://ellislab.com/codeigniter/user-guide/libraries/pagination.html
    */
    public function _pagination_theme($config = array()) {

      $config['num_links'] = 2;

      $config['full_tag_open']  = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>'; 

      $config['first_link'] = 'First';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';

      $config['last_link'] = 'Last';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';

      $config['next_tag_open']    = '<li>';
      $config['next_tag_close']   = '</li>';
      $config['next_link']        = '»';

      $config['prev_tag_open']    = '<li>';
      $config['prev_tag_close']   = '</li>';
      $config['prev_link']        = '«';

      $config['num_tag_open']   = '<li>'; 
      $config['num_tag_close']  = '</li>';
      $config['cur_tag_open']   = '<li class="active"><a href="#">';
      $config['cur_tag_close']  = '</a></li>';

      $this->pagination->initialize($config);

      return $this->pagination->create_links();
    }

    // Check User if it has Admin role
    public function _message($message, $id = NULL) {
      $flag = $this->m_tbl_users_mas->user_role($this->session->userdata('role'), $id);
      if ($flag == FALSE) {
        $this->data['message'] = $message; 
        
        $this->data['subview'][] = 'message';
        $this->load->view('backend/index', $this->data);

        return $flag;
      }  
    }

    /**
    * Main callback Functions
    */
    public function username($input) {
      $this->db->where('usr_name', $input);
      $query = $this->db->get('tbl_users_mas'); // Query this table
      return $query->num_rows();
    }

    public function usermail($input) {
      $this->db->where('con_email', $input);
      $query = $this->db->get('tbl_contact_dtl'); // Query this table
      return $query->num_rows();
    }

  }