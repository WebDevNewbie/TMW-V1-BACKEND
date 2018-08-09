<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller {
		public function __construct(){
	    parent::__construct();
	    $this->load->model('_backend/user/admin');
	    $this->load->model('user/user');
	  }
	      
		public function index() {
			$this->load->view('index');
		}

		public function login(){

			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$this->form_validation->set_rules('username', "Username", "trim|required");
	        $this->form_validation->set_rules('password', "Password", "trim|required");

	        if ($this->form_validation->run() == FALSE)
	      	{
	           //validation fails
	      		$this->session->set_flashdata('error_message',validation_errors());
				redirect(''); 
	      	}
	      	else{
	      		$checkAdmin = $this->admin->getAdminInfo(array('username'=>$username,'password'=>$password));
	      		$checkUser1 = $this->user->getUserInfo(array('username'=>$username,'password'=>$password,'usertype'=>'1'));
	      		$checkUser2 = $this->user->getUserInfo(array('username'=>$username,'password'=>$password,'usertype'=>'2'));
	      		$checkKitchen = $this->user->getUserInfo(array('username'=>$username,'password'=>$password,'usertype'=>'3'));
	      		if(count($checkAdmin)>0){
	      			//$this->session->set_userdata('id',$checkUser[0]->user_id);
	      			foreach($checkAdmin as $row)
	     			{
		      			$sess_array = array(
				         'admin_id' 	=> $row->admin_id,
				         'username' 	=> $row->username,
				         'password' 	=> $row->password,
				       );
				       $this->session->set_userdata('logged_in', $sess_array);
				   }
	      			redirect('dashboard');
	      		}
	      		elseif(count($checkUser1)>0)
	      		{
	      			//$this->session->set_userdata('id',$checkUser[0]->user_id);
	      			foreach($checkUser1 as $row)
	     			{
		      			$sess_array = array(
				         'admin_id' 	=> $row->id,
				         'username' 	=> $row->username,
				         'password' 	=> $row->password,
				       );
				       $this->session->set_userdata('logged_in', $sess_array);
				   }
	      			redirect('kiosk_take_out');
		      		
		      	}
		      	elseif(count($checkUser2)>0)
	      		{
	      			//$this->session->set_userdata('id',$checkUser[0]->user_id);
	      			foreach($checkUser2 as $row)
	     			{
		      			$sess_array = array(
				         'admin_id' 	=> $row->id,
				         'username' 	=> $row->username,
				         'password' 	=> $row->password,
				       );
				       $this->session->set_userdata('logged_in', $sess_array);
				   }
	      			redirect('kiosk_dine_in');
		      		
		      	}
		      	elseif(count($checkKitchen)>0)
	      		{
	      			//$this->session->set_userdata('id',$checkUser[0]->user_id);
	      			foreach($checkKitchen as $row)
	     			{
		      			$sess_array = array(
				         'admin_id' 	=> $row->id,
				         'username' 	=> $row->username,
				         'password' 	=> $row->password,
				       );
				       $this->session->set_userdata('logged_in', $sess_array);
				   }
	      			redirect('kitchen');
		      		
		      	}
		      	else
	      		{
	      			$this->session->set_flashdata('error_message',validation_errors());
					redirect(''); 
	      		}

	      	}

		}
		public function addAccount()
		{
			
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$repassword = md5($this->input->post('repassword'));
			$usertype = $this->input->post('usertype');
			$this->form_validation->set_rules('username', "Username", "trim|required");
	        $this->form_validation->set_rules('password', "Password", "trim|required");
	        $this->form_validation->set_rules('repassword', "ReTypePassword", "trim|required");
	        $this->form_validation->set_rules('usertype', "Usertype", "trim|required");
		
			if ($this->form_validation->run() == FALSE)
	      	{
	           //validation fails
	      		$this->session->set_flashdata('alert', array('note' => 'Invalid Username or Password !'));
				redirect('dashboard');
			}
			else{
				if($password == $repassword){
					$data = array(
						'username' => $username,
						'password' => $password
					);
					if($usertype == 0){
						$checkAdmin = $this->admin->getAdminInfo(array('username'=>$username));
						if(count($checkAdmin)>0){
							$this->session->set_flashdata('alert', array('note' => 'Username already exist !'));
							redirect('dashboard');
						}
						else{
							$admin_data = array(
								'username' => $username,
								'password' => $password
							);
							$this->admin->save($admin_data);
							$this->session->set_flashdata('alert', array('note' => 'Register Successfully !'));
							redirect('dashboard');
						}
					}
					else{
						$checkUser = $this->user->getUserInfo(array('username'=>$username)); 
						if(count($checkUser)>0){
							$this->session->set_flashdata('alert', array('note' => 'Username already exist !'));
							redirect('dashboard');
						}
						else{
							$user_data = array(
								'username' => $username,
								'password' => $password,
								'usertype' => $usertype
							);
							$this->user->save($user_data);
							$this->session->set_flashdata('alert', array('note' => 'Register Successfully !'));
							redirect('dashboard');
						}
					}
				}
				else{
					
					$this->session->set_flashdata('alert', array('note' => 'Password does not match !'));
					redirect('dashboard');
				}
			}
			
		}
		public function addMember(){
			
			$fname = $this->input->post('fname');
			$mname = $this->input->post('mname');
			$lname = $this->input->post('lname');
			$bday = $this->input->post('bday');
			$mnumber = $this->input->post('mnumber');
			
			$this->form_validation->set_rules('fname', "FirstName", "trim|required");
	        $this->form_validation->set_rules('mname', "MiddleName", "trim|required");
	        $this->form_validation->set_rules('lname', "LastName", "trim|required");
	        $this->form_validation->set_rules('bday', "Birthday", "trim|required");
	        $this->form_validation->set_rules('mnumber', "MobileNumber", "trim|required");
			$year = date('y');
			$month = date('m');
			$id= $this->user->getMemberID();
			$plusID= $id[0]->id + 1;
			$member_id = $year.$month.$plusID;
			$data = array(
				'fname' => trim($fname),
				'mname' => trim($mname),
				'lname' => trim($lname),
				'bday' => $bday,
				'mnumber' => $mnumber,
				'member_id' => $member_id
			
			);
			if ($this->form_validation->run() == FALSE)
	      	{
	           //validation fails
	      		$this->session->set_flashdata('error','Fill up all requirements.');
				redirect('kiosk_take_out');
			}
			else{
					$this->user->saveMember($data);
					$this->session->set_userdata('member', $data);
					$this->session->set_flashdata('alerts', array('note' => 'Successfully Registered !'));
					redirect('kiosk_take_out');
				
			}
			
		}
		// End Template Class
	}