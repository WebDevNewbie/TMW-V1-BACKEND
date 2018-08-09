<?php
  class M_tbl_users extends MY_Model {
    protected $_table_name = 'tbl_users';
    protected $_order_by = 'datetime_created';
    protected $_timestamps = TRUE;
    
    public $user_login = array(
      'usr_name' => array(
        'field' => 'usr_alias', 
        'label' => 'User Name', 
        'rules' => 'trim|required|xss_clean|callback__users'), 
      'usr_password' => array(
        'field' => 'usr_password', 
        'label' => 'Password', 
        'rules' => 'trim|required'), 
    );
    
    public $user_admin = array(
      'usr_alias' => array(
        'field' => 'usr_alias', 
        'label' => 'User Name', 
        'rules' => 'trim|xss_clean|min_length[3]|max_length[30]'),
      'usr_name' => array(
        'field' => 'usr_name', 
        'label' => 'Full Name', 
        'rules' => 'trim|required|xss_clean|min_length[3]|max_length[30]'),
      'usr_password' => array(
        'field' => 'usr_password', 
        'label' => 'Password', 
        'rules' => 'trim|matches[usr_password_conf]|max_length[15]'), 
      'usr_password_conf' => array(
        'field' => 'usr_password_conf', 
        'label' => 'Confirm Password', 
        'rules' => 'trim|matches[usr_password]'),        
    );

    // 'con_number' => array(
    //   'field' => 'con_number', 
    //   'label' => 'Contact Number', 
    //   'rules' => 'trim|required|xss_clean|max_length[15]'),
    // 'con_email' => array(
    //   'field' => 'con_email', 
    //   'label' => 'Email Address', 
    //   'rules' => 'trim|xss_clean|min_length[3]|max_length[30]callback__email'),  

    function __construct() {
      parent::__construct();
    }

    /**
     * Accept session variable to check user Role ("admin/manager")
     * and Validate user ID.
     *  
     * @param string $role from session variables  
     * @param integer $id user ID
     * @return boolean
    */
    public function user_role($role, $id) {
      if ($role != 1) { // 1 = Admin
        if ( $this->session->userdata('id') != $id ) // Compare User session ID with database User's ID
          return FALSE;     
      } 
      return TRUE;
    }

    public function login() {
      $user = $this->get_by(array(
        'usr_alias'    => $this->input->post('usr_alias'), 
        'usr_password' => $this->hash($this->input->post('usr_password'))
      ), TRUE);

      if (count($user)) {
        $data = array(
          'user_name'  => $user->usr_alias,    
          'full_name'  => $user->usr_name,    
          'id'         => $user->id,   
          'role'       => $user->usr_role,
          'loggedin'   => TRUE,    
        );

        $this->session->set_userdata($data);
      }
    }

    public function logout() {
      $this->session->sess_destroy();
    }

    public function loggedin() {
      return (bool) $this->session->userdata('loggedin'); 
    }
    
    public function get_user() {
      $user = new stdClass();
      
      $user->usr_alias      = '';
      $user->usr_name       = '';
      $user->usr_password   = '';
      $user->usr_role       = '';

      return $user;
    }

    public function hash($string) {
      return hash('sha512', $string . config_item('encryption_key'));
    }
  }