<?php
  class M_tbl_users extends MY_Model {
    protected $_table_name = 'users';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    
    public $rules = array (

			'username' => array (
						'field' => 'username', 
						'label' => 'Username', 
						'rules' => 'trim|required|xss_clean'
						),
			'password' => array (
						'field' => 'password', 
						'label' => 'Password' , 
						'rules' => 'trim|required'
						),
		);
    
  
    function __construct() {
      parent::__construct();
    }

   
    public function login() {
			
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		   
		   $this -> db -> select('id, username, password, usertype');
		   $this -> db -> from('users');
		   $this -> db -> where('username', $username);
		   $this -> db -> where('password', MD5($password));
		   $this -> db -> limit(1);
		 
		   $query = $this -> db -> get();
		   
		   if($query)
		   {
				foreach ($query->result_array() as $row)
				{
					$data = array (   
					  'username'  => $row['username'],    
					  'id'         => $row['id'],   
					  'usertype'       => $row['usertype'],
					  'loggedin'   => TRUE,    
					);
					
					if($data['usertype'] == '1')
					{
						$this->session->set_userdata('1', $data);
					}
					else if($data['usertype'] == '2')
					{
						$this->session->set_userdata('2', $data);
					}
					else if($data['usertype'] == '3')
					{
						$this->session->set_userdata('3', $data);
					}
					
					else if($data['usertype'] == '4')
					{
						$this->session->set_userdata('4', $data);
					}
					
					return true;
				}
		   }
		   else
		   {
			 return false;
		   }
    }
	
	public function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('menu_category');
        $this->db->order_by('category_name');
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        
        return $query->result();
    }
	public function mod_addCategory ($data) {
			$this->db->insert("menu_category", $data);
			return $this->db->affected_rows() > 0;
		}
	public function mod_deleteNowCategory ($id) {
			$query = $this->db->delete('menu_category',array('id'=>$id));
			 return $query->result();
		}
		
	public function mod_viewCategory () {
			$query = $this->db->get("menu_category");
			return $query->result();
		}	
	public function mod_viewDish ($id) {
			$this -> db -> select('id, category_id, dish_name, price, description');
		   $this -> db -> from('menu_dish');
		   $this -> db -> where('category_id', $id);
		   $query = $this -> db -> get();
			return $query->result();
		}
    public function logout() {
      $this->session->sess_destroy();
    }

    public function loggedin() {
      return (bool) $this->session->userdata('loggedin'); 
    }
    
    public function hash($string) {
      return hash('sha512', $string . config_item('encryption_key'));
    }
  }