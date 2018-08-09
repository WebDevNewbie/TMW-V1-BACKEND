<?php 

	
	class administrator extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('Ajax_pagination');
			$this->load->model('_backend/user/m_tbl_users');
			$this->perPage = 9;
		}
		
	
		public function index() {
		
		$data = array();
        
        //total rows count
        $totalRec = count($this->m_tbl_users->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'divlist'; //parent div tag id
        $config['base_url']    = base_url().'administrator/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['category'] = $this->m_tbl_users->getRows(array('limit'=>$this->perPage));
        
        //load the view
		$this->load->view('admin/add_category', $data);
					
		}
		public function ajaxPaginationData()
		{
			$page = $this->input->post('page');
			if(!$page){
				$offset = 0;
			}else{
				$offset = $page;
			}
			
			//total rows count
			$totalRec = count($this->m_tbl_users->getRows());
			
			//pagination configuration
			$config['first_link']  = 'First';
			$config['div']         = 'divlist'; //parent div tag id
			$config['base_url']    = base_url().'administrator/ajaxPaginationData';
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $this->perPage;
			
			$this->ajax_pagination->initialize($config);
			
			//get the posts data
			$data['result'] = $this->m_tbl_users->getRows(array('start'=>$offset,'limit'=>$this->perPage));
			
			//load the view
			$this->load->view('admin/ajax-pagination-data', $data, false);
		}
		public function registerCategory() {
						
			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|xss_clean|callback_username_exists');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE) {
				echo json_encode(validation_errors());
			} else {
				
				$data = array (
					
					'category_name' => $this->input->post('category_name'),
					'description' => $this->input->post('description')
				);

				if($this->m_tbl_users->mod_addCategory($data)) {
					echo json_encode('Adding Category successful!');
				} else {
					echo json_encode('Error Adding Category details');
				}
			}
		}
		
		public function viewCategory(){
			
			$data = array();
        
        //total rows count
        $totalRec = count($this->m_tbl_users->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'divlist'; //parent div tag id
        $config['base_url']    = base_url().'administrator/ajaxPaginationDataCateg';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $result = $this->m_tbl_users->getRows(array('limit'=>$this->perPage));
        echo json_encode($result);
			
		}
		
		public function ajaxPaginationDataCateg()
		{
			$page = $this->input->post('page');
			if(!$page){
				$offset = 0;
			}else{
				$offset = $page;
			}
			
			//total rows count
			$totalRec = count($this->m_tbl_users->getRows());
			
			//pagination configuration
			$config['first_link']  = 'First';
			$config['div']         = 'divlist'; //parent div tag id
			$config['base_url']    = base_url().'administrator/ajaxPaginationDataCateg';
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $this->perPage;
			
			$this->ajax_pagination->initialize($config);
			
			 $result = $this->m_tbl_users->getRows(array('start'=>$offset,'limit'=>$this->perPage));
				echo json_encode($result);
		}
		
		public function deleteNowCategory($id)
		{
			$data = $this->m_tbl_users->mod_deleteNowCategory($id);
			echo json_encode($data);
		}
		
		public function viewDish($id)
		{
			$data = $this->m_tbl_users->mod_viewDish($id);
			echo json_encode($data);
		}
	
				
	
	}

?>