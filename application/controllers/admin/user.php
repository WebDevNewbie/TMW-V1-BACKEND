<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class User extends Admin_Controller {
		public function __construct(){
	    parent::__construct();
		$this->load->model('_backend/user/m_tbl_users');
	  }
	      
		public function index() {
			$this->load->view('index');
		}

		public function login() {
		  
		  

		  $rules = $this->m_tbl_users->rules;
		  $this->form_validation->set_rules($rules);
		  
		  if ($this->form_validation->run() == FALSE) {
			
			$this->form_validation->set_message('Error','Invalid Username or Password');
			
		  }
		  else{
			  
			if ($this->m_tbl_users->login() == TRUE) 
			{
		      redirect('admin/user/log');
		    } 
			else {
				
				$this->session->set_flashdata('Error', 'Username or Password Combination Invalid');
		    }
		  }

			$this->load->view('index', $this->data);
		}
		
		public function log()
		{
		   if($this->session->userdata('1'))
		   {
				redirect('administrator/index','refresh');
		   }
		  // else if($this->session->userdata('2'))
		   //{
			//	redirect('payment_center/transactions_paymentcenter','refresh');				
		  // }
		  // else if($this->session->userdata('3'))
		  // {
			//	redirect('household/view_household_pt','refresh');				
		  // }
		   else
		   {
			 redirect('admin/user/login');
		   }
		}
		
    public function logout() {
	    $this->m_tbl_users->logout();
	    redirect('admin/user/login');
	  }
    
		// End User Class
	}