<?php defined('BASEPATH') OR exit('No direct script access allowed');
	session_start();
	class Dashboard extends Admin_Controller {
		public function __construct() {
	      parent::__construct();
	      $this->load->model('_backend/category/category');
		 
		
	    }
    
		public function index() {
		
			 
			if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$alert = $this->session->flashdata('alert');

				$table_no = $this->db->query('SELECT * FROM table_settings');
				// dump_exit($table_no->result());

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );
				//dump_exit($get_users);

				$category = $this->category->getCategories();
				// dump_exit($category);

				$this->load->view('layouts/header',array(
					'table_no'	=> @$table_no->result(),
					));
				$this->load->view('admin/main', array(
					'data'		=> $data,
					'subview'	=> $this->data,
					'category'	=> $category,
					'note'		=> @$alert['note'],
					));

				$this->load->view('layouts/sidebar');
			}else{
				redirect('home','refresh');
			}
		}
		


		public function add_category()
		{
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');

			$cat_name = $this->input->post('category_name');
			$cat_desc = $this->input->post('description');


			$cat_data = array(
					'category_name' => ucwords(trim($cat_name)),
					'description'	=> trim($cat_desc)
				);

			$add_cat_id = $this->category->addCategory($cat_data);
			if($add_cat_id)
			{
				$this->session->set_flashdata('alert', array('note' => 'Successfully Added !'));
			}


			$config['upload_path'] = 'category_img/';
			$config['allowed_types'] = 'gif|jpg|png';

	        //load the upload library
	        $this->load->library('upload', $config);

	        $this->upload->initialize($config);

	        $this->upload->set_allowed_types('*');

	        $data['upload_data'] = '';


			if(!$this->upload->do_upload('userfile'))
			{
				redirect('dashboard','refresh');
			}
			else
			{
				$data1 = $this->upload->data();
				$filename = explode('/',$data1['full_path']);
				// dump_exit($filename[count($filename)-1]);
				$cat_img_data = array(
						'cat_id' 	=> $add_cat_id,
						'path'		=> 'category_img/',
						'filename'	=>  @$filename[count($filename)-1]
					);
				$add_cat_img = $this->category->addCatImg($cat_img_data);

				redirect('dashboard','refresh');
			}
		}

		public function edit_category()
		{
			
			if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$alert = $this->session->flashdata('alert');
				$table_no = $this->db->query('SELECT * FROM table_settings');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );
				//dump_exit($get_users);

				$category = $this->category->getCategories();
				// dump_exit($category);

				$this->load->view('layouts/header',array(
					'table_no'	=> @$table_no->result(),
					));
				$this->load->view('admin/edit_category', array(
					'data'		=> $data,
					'subview'	=> $this->data,
					'category'	=> $category,
					'note'		=> @$alert['note']
					));

				$this->load->view('layouts/sidebar');
			}else{
				redirect('home','refresh');
			}
		}
		
		public function update_category()
		{
			$this->load->helper('form');

			$cat_id = $this->input->post('cat_id');
			$cat_name = $this->input->post('category_name');
			$cat_desc = $this->input->post('description');

			$this->form_validation->set_rules('cat_id', 'Category Id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('alert', array('note' => 'Failed to Update !'));
				redirect('dashboard/edit_category','refresh');
			}
			else
			{
				$cat_data = array(
					'category_name' => ucwords(trim($cat_name)),
					'description'	=> trim($cat_desc)
				);

				$add_cat_id = $this->category->updateCategory($cat_data,$cat_id);

				$this->session->set_flashdata('alert', array('note' => 'Successfully Updated !'));


				$config['upload_path'] = 'category_img/';
				$config['allowed_types'] = 'gif|jpg|png';

		        //load the upload library
		        $this->load->library('upload', $config);

		        $this->upload->initialize($config);

		        $this->upload->set_allowed_types('*');

		        $data['upload_data'] = '';


				if(!$this->upload->do_upload('userfile'))
				{
					redirect('dashboard/edit_category','refresh');			
				}
				else
				{
					if($this->input->post('filename') === '' || $this->input->post('filename') === NULL)
					{
						$data1 = $this->upload->data();
						$filename = explode('/',$data1['full_path']);
						// dump_exit($filename[count($filename)-1]);
						$cat_img_data = array(
								'cat_id' 	=> $cat_id,
								'path'		=> 'category_img/',
								'filename'	=>  $filename[count($filename)-1]
							);
						$add_cat_img = $this->category->addCatImg($cat_img_data);
					}
					else
					{
						$data1 = $this->upload->data();
						unlink('category_img/'.$this->input->post('filename'));
						$filename = explode('/',$data1['full_path']);
						// dump_exit($filename[count($filename)-1]);
						$cat_img_data = array(
								'filename'	=>  $filename[count($filename)-1]
							);
						$add_cat_img = $this->category->updateCatImg($cat_img_data,$cat_id);
					}
					
					redirect('dashboard/edit_category','refresh');
				}
			}
			

		}

		public function delete_category()
		{
			
			if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$alert = $this->session->flashdata('alert');
				$table_no = $this->db->query('SELECT * FROM table_settings');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );
				//dump_exit($get_users);

				$category = $this->category->getCategories();
				// dump_exit($category);

				$this->load->view('layouts/header',array(
					'table_no'	=> @$table_no->result(),
					));
				$this->load->view('admin/delete_category', array(
					'data'		=> $data,
					'subview'	=> $this->data,
					'category'	=> $category,
					'note'		=> @$alert['note']
					));

				$this->load->view('layouts/sidebar');
			}else{
				redirect('home','refresh');
			}
		}
		
		public function drop_category($id)
		{
			if($this->input->post('filename') !== '')
			{
				unlink('category_img/'.$this->input->post('filename'));
				$this->db->delete('menu_category_pic', array('cat_id' => $id));
			}
			$this->db->delete('menu_category', array('id' => $id));  

			$this->session->set_flashdata('alert', array('note' => 'Successfully Deleted !'));

			redirect('dashboard/delete_category','refresh');
		}

		public function category($id)
		{
			if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$alert = $this->session->flashdata('alert');
				$table_no = $this->db->query('SELECT * FROM table_settings');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );
				//dump_exit($get_users);

				$item = $this->category->getSubMenu($id);
				$category_name = $this->category->getCategoryName($id);

				$subcat = $this->category->getSubCat($id);
				// dump_exit($item);
				if(@$subcat[0]->category_id === NULL)
				{
					$sub_id = 0;
				}
				else
				{
					$sub_id = $subcat[0]->category_id;
				}
				// dump_exit($subcat[0]->category_id);
				if(count($subcat) > 0)
				{
					$this->load->view('layouts/header',array(
						'table_no'	=> @$table_no->result(),
						));
					$this->load->view('admin/subcat', array(
						'data'		=> $data,
						'subview'	=> $this->data,
						'category'	=> $subcat,
						'cat_id'	=> $subcat[0]->category_id,
						'note'		=> @$alert['note']
						));

					$this->load->view('layouts/sidebar_item',array(
						'cat_id'	=> $id,
						'uri_segment'	=> $this->uri->segment(2)
						));
				}
				elseif(count($subcat) === 0 && count($item) === 0)
				{
					$this->load->view('layouts/header',array(
						'table_no'	=> @$table_no->result(),
						));
					$this->load->view('admin/item', array(
						'data'		=> $data,
						'subview'	=> $this->data,
						'category'	=> $item,
						'cat_name'	=> $category_name[0]->category_name,
						'subcat_id'	=> $sub_id,
						'cat_id'	=> $id,
						'note'		=> @$alert['note']
						));

					$this->load->view('layouts/sidebar_item',array(
						'cat_id'	=> $id,
						'uri_segment'	=> 'none'
						));
				}
				elseif(count($item) > 0)
				{
					$this->load->view('layouts/header',array(
						'table_no'	=> @$table_no->result(),
						));
					$this->load->view('admin/item', array(
						'data'		=> $data,
						'subview'	=> $this->data,
						'category'	=> $item,
						'cat_name'	=> $category_name[0]->category_name,
						'subcat_id'	=> $sub_id,
						'cat_id'	=> $id,
						'note'		=> @$alert['note']
						));

					$this->load->view('layouts/sidebar_item',array(
						'cat_id'	=> $id,
						'uri_segment'	=> 'item'
						));
				}
				else
				{
					$this->load->view('layouts/header',array(
						'table_no'	=> @$table_no->result(),
						));
					$this->load->view('admin/item', array(
						'data'		=> $data,
						'subview'	=> $this->data,
						'category'	=> $item,
						'cat_name'	=> $category_name[0]->category_name,
						'subcat_id'	=> $sub_id,
						'cat_id'	=> $id,
						'note'		=> @$alert['note']
						));

					$this->load->view('layouts/sidebar_item',array(
						'cat_id'	=> $id,
						'uri_segment'	=> $this->uri->segment(2)
						));
				}

				// dump_exit($category_name[0]->category_name);

				
			}else{
				redirect('home','refresh');
			}
		}

		public function add_item()
		{
			$this->load->helper('form');

			$cat_id = $this->input->post('cat_id');
			$subcat_id = $this->input->post('subcat_id');
			$item_name = $this->input->post('item_name');
			$item_desc = $this->input->post('description');
			$price = $this->input->post('price');

			$item_data = array(
					'category_id' 		=> $cat_id,
					'subcat_id'			=> @$subcat_id,
					'item_name'			=> ucwords(trim($item_name)),
					'price'				=> $price,
					'description'		=> trim($item_desc)
				);

			$item_cat_id = $this->category->addItem($item_data);

			$this->session->set_flashdata('alert', array('note' => 'Successfully Added !'));

			$config['upload_path'] = 'item_img/';
			$config['allowed_types'] = 'gif|jpg|png';

	        //load the upload library
	        $this->load->library('upload', $config);

	        $this->upload->initialize($config);

	        $this->upload->set_allowed_types('*');

	        $data['upload_data'] = '';


			if(!$this->upload->do_upload('userfile'))
			{
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			else
			{
				$data1 = $this->upload->data();
				$filename = explode('/',$data1['full_path']);
				// dump_exit($filename[count($filename)-1]);
				$item_img_data = array(
						'item_id' 	=> $item_cat_id,
						'path'		=> 'item_img/',
						'filename'	=>  @$filename[count($filename)-1]
					);
				$add_cat_img = $this->category->addItemImg($item_img_data);

				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}

			

		}

		public function edit_item($id)
		{
			if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$alert = $this->session->flashdata('alert');
				$table_no = $this->db->query('SELECT * FROM table_settings');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );
				//dump_exit($get_users);

				$ids = explode('a',$id);
				$subcat_id = @$ids[0];
				$cat_id = @$ids[1];
				// dump_exit($ids);

				$sub_cat = $this->category->getSubCatItem($subcat_id);

				$category = $this->category->getSubMenu($cat_id);
				

				if(@$subcat[0]->category_id === NULL)
				{
					$sub_id = 0;
				}
				else
				{
					$sub_id = $subcat[0]->category_id;
				}

				$this->load->view('layouts/header',array(
					'table_no'	=> @$table_no->result(),
					));
				if($subcat_id)
				{
					$this->load->view('admin/edit_item', array(
					'data'		=> $data,
					'subview'	=> $this->data,
					'category'	=> $sub_cat,
					'subcat_id'	=> $subcat_id,
					'cat_id'	=> $cat_id,
					'note'		=> @$alert['note']
					));
				}
				else
				{
					$this->load->view('admin/edit_item', array(
					'data'		=> $data,
					'subview'	=> $this->data,
					'category'	=> $category,
					'subcat_id'	=> $subcat_id,
					'cat_id'	=> $cat_id,
					'note'		=> @$alert['note']
					));
				}
				

				$this->load->view('layouts/sidebar_item',array(
					'cat_id'	=> $id,
					'uri_segment'	=> 'edit_item'
					));
			}else{
				redirect('home','refresh');
			}
		}

		public function update_item($id)
		{
			$this->load->helper('form');

			$cat_name = $this->input->post('item_name');
			$cat_desc = $this->input->post('description');
			$price = $this->input->post('price');

			$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('alert', array('note' => 'Failed to Update !'));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			else
			{
				$item_data = array(
					'item_name' 	=> ucwords(trim($cat_name)),
					'description'	=> trim($cat_desc),
					'price'			=> $price
				);

				$add_cat_id = $this->category->updateitem($item_data,$id);

				$this->session->set_flashdata('alert', array('note' => 'Successfully Updated !'));


				$config['upload_path'] = 'item_img/';
				$config['allowed_types'] = 'gif|jpg|png';

		        //load the upload library
		        $this->load->library('upload', $config);

		        $this->upload->initialize($config);

		        $this->upload->set_allowed_types('*');

		        $data['upload_data'] = '';


				if(!$this->upload->do_upload('userfile'))
				{
					// echo 'failed';
					redirect($_SERVER['HTTP_REFERER'],'refresh');			
				}
				else
				{
					if($this->input->post('filename') === '' || $this->input->post('filename') === NULL)
					{
						$data1 = $this->upload->data();
						$filename = explode('/',$data1['full_path']);
						// dump_exit($filename[count($filename)-1]);
						$item_img_data = array(
								'item_id' 	=> $id,
								'path'		=> 'item_img/',
								'filename'	=>  $filename[count($filename)-1]
							);
						$add_item_img = $this->category->addItemImg($item_img_data);
					}
					else
					{
						$data1 = $this->upload->data();
						unlink('item_img/'.$this->input->post('filename'));
						$filename = explode('/',$data1['full_path']);
						// dump_exit($filename[count($filename)-1]);
						$item_img_data = array(
								'filename'	=>  $filename[count($filename)-1]
							);
						$add_item_img = $this->category->updateItemImg($item_img_data,$id);
					}
					

					redirect($_SERVER['HTTP_REFERER'],'refresh');
				}
			}

		}

		public function delete_item($id)
		{
			if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$alert = $this->session->flashdata('alert');
				$table_no = $this->db->query('SELECT * FROM table_settings');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );
				//dump_exit($get_users);

				$ids = explode('a',$id);
				$subcat_id = @$ids[0];
				$cat_id = @$ids[1];
				// dump_exit($ids);

				$sub_cat = $this->category->getSubCatItem($subcat_id);

				$category = $this->category->getSubMenu($cat_id);
				// dump_exit($category);

				if(@$subcat[0]->category_id === NULL)
				{
					$sub_id = 0;
				}
				else
				{
					$sub_id = $subcat[0]->category_id;
				}

				$this->load->view('layouts/header',array(
					'table_no'	=> @$table_no->result(),
					));
				$this->load->view('admin/delete_item', array(
					'data'		=> $data,
					'subview'	=> $this->data,
					'category'	=> $category,
					'subcat_id'	=> $subcat_id,
					'cat_id'	=> $cat_id,
					'note'		=> @$alert['note']
					));

				$this->load->view('layouts/sidebar_item',array(
					'cat_id'	=> $id,
					'uri_segment'	=> 'delete_item'
					));
			}else{
				redirect('home','refresh');
			}
		}

		public function drop_item($id)
		{
			// dump_exit(file_exists('item_img/'.$this->input->post('filename')));
			if($this->input->post('filename') !== '')
			{
				unlink('item_img/'.$this->input->post('filename'));
				$this->db->delete('menu_item_pic', array('item_id' => $id)); 
			}
			$this->db->delete('menu_item', array('id' => $id)); 

			$this->session->set_flashdata('alert', array('note' => 'Successfully Deleted !'));

			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}


		public function add_subcat($id)
		{
			$this->load->helper('form');

			$subcat_name = $this->input->post('subcat_name');
			$subcat_desc = $this->input->post('description');
			$price = $this->input->post('price');

			$subcat_data = array(
					'category_id' 				=> $id,
					'subcat_name'				=> ucwords(trim($subcat_name)),
					'subcat_description'		=> trim($subcat_desc)
				);

			$subcat_cat_id = $this->category->addSubCat($subcat_data);

			$this->session->set_flashdata('alert', array('note' => 'Successfully Added !'));

			$config['upload_path'] = 'subcat_img/';
			$config['allowed_types'] = 'gif|jpg|png';

	        //load the upload library
	        $this->load->library('upload', $config);

	        $this->upload->initialize($config);

	        $this->upload->set_allowed_types('*');

	        $data['upload_data'] = '';


			if(!$this->upload->do_upload('userfile'))
			{
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			else
			{
				$data1 = $this->upload->data();
				$filename = explode('/',$data1['full_path']);
				// dump_exit($filename[count($filename)-1]);
				$subcat_img_data = array(
						'subcat_id' 	=> $subcat_cat_id,
						'path'		=> 'subcat_img/',
						'filename'	=>  @$filename[count($filename)-1]
					);
				$add_cat_img = $this->category->addSubCatImg($subcat_img_data);

				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}

		}

		public function sub_category($id)
		{
			if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$alert = $this->session->flashdata('alert');
				$table_no = $this->db->query('SELECT * FROM table_settings');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );
				//dump_exit($get_users);
				$ids = explode('a',$id);
				$subcat_id = $ids[0];
				$cat_id = $ids[1];
				// dump_exit($ids);

				$sub_cat = $this->category->getSubCatItem($subcat_id);
				// dump_exit($sub_cat);

					$this->load->view('layouts/header',array(
						'table_no'	=> @$table_no->result(),
						));
					$this->load->view('admin/item', array(
						'data'		=> $data,
						'subview'	=> $this->data,
						'category'	=> $sub_cat,
						'cat_id'	=> $cat_id,
						'subcat_id'	=> $subcat_id,
						'note'		=> @$alert['note']
						));

					$this->load->view('layouts/sidebar_item',array(
						'cat_id'		=> $cat_id,
						'uri_segment'	=> $this->uri->segment(2)
						));

				// dump_exit($category_name[0]->category_name);

				
			}else{
				redirect('home','refresh');
			}
		}

		public function edit_subcategory($id)
		{
			if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$alert = $this->session->flashdata('alert');
				$table_no = $this->db->query('SELECT * FROM table_settings');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );
				//dump_exit($get_users);

				$item = $this->category->getSubMenu($id);
				$category_name = $this->category->getCategoryName($id);

				$subcat = $this->category->getSubCat($id);
				// dump_exit($subcat);
				if(@$subcat[0]->category_id === NULL)
				{
					$sub_id = 0;
				}
				else
				{
					$sub_id = $subcat[0]->category_id;
				}

				$this->load->view('layouts/header',array(
					'table_no'	=> @$table_no->result(),
					));
				$this->load->view('admin/edit_subcat', array(
					'data'		=> $data,
					'subview'	=> $this->data,
					'category'	=> $subcat,
					'subcat_id'	=> $sub_id,
					'cat_id'	=> $id,
					'note'		=> @$alert['note']
					));

				$this->load->view('layouts/sidebar_item',array(
					'cat_id'	=> $id,
					'uri_segment'	=> 'category'
					));
			}else{
				redirect('home','refresh');
			}
		}

		public function update_subcategory($id)
		{
			$this->load->helper('form');

			$subcat_name = $this->input->post('subcat_name');
			$subcat_desc = $this->input->post('description');
			$price = $this->input->post('price');

			$this->form_validation->set_rules('subcat_name', 'Sub-Category Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('alert', array('note' => 'Failed to Update !'));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			else
			{
				$subcat_data = array(
					'subcat_name' 			=> ucwords(trim($subcat_name)),
					'subcat_description'	=> trim($subcat_desc),
				);

				$add_subcat_id = $this->category->updateSubCatItem($subcat_data,$id);

				$this->session->set_flashdata('alert', array('note' => 'Successfully Updated !'));

				$config['upload_path'] = 'subcat_img/';
				$config['allowed_types'] = 'gif|jpg|png';

		        //load the upload library
		        $this->load->library('upload', $config);

		        $this->upload->initialize($config);

		        $this->upload->set_allowed_types('*');

		        $data['upload_data'] = '';


				if(!$this->upload->do_upload('userfile'))
				{
					// echo 'failed';
					redirect($_SERVER['HTTP_REFERER'],'refresh');			
				}
				else
				{
					if($this->input->post('filename') === '' || $this->input->post('filename') === NULL)
					{
						$data1 = $this->upload->data();
						$filename = explode('/',$data1['full_path']);
						// dump_exit($filename[count($filename)-1]);
						$subcat_img_data = array(
								'subcat_id' 	=> $id,
								'path'		=> 'subcat_img/',
								'filename'	=>  $filename[count($filename)-1]
							);
						$add_item_img = $this->category->addSubCatImg($subcat_img_data);
					}
					else
					{
						$data1 = $this->upload->data();
						unlink('subcat_img/'.$this->input->post('filename'));
						$filename = explode('/',$data1['full_path']);
						// dump_exit($filename[count($filename)-1]);
						$subcat_img_data = array(
								'filename'	=>  $filename[count($filename)-1]
							);
						$add_item_img = $this->category->updateSubCatImg($subcat_img_data,$id);
					}
					

					redirect($_SERVER['HTTP_REFERER'],'refresh');
				}
			}
			

		}

		public function delete_subcategory($id)
		{
			if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$alert = $this->session->flashdata('alert');
				$table_no = $this->db->query('SELECT * FROM table_settings');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );
				//dump_exit($get_users);

				$item = $this->category->getSubMenu($id);
				$category_name = $this->category->getCategoryName($id);

				$subcat = $this->category->getSubCat($id);
				// dump_exit($subcat);
				if(@$subcat[0]->category_id === NULL)
				{
					$sub_id = 0;
				}
				else
				{
					$sub_id = $subcat[0]->category_id;
				}

				$this->load->view('layouts/header',array(
					'table_no'	=> @$table_no->result(),
					));
				$this->load->view('admin/delete_subcat', array(
					'data'		=> $data,
					'subview'	=> $this->data,
					'category'	=> $subcat,
					'subcat_id'	=> $sub_id,
					'cat_id'	=> $id,
					'note'		=> @$alert['note']
					));

				$this->load->view('layouts/sidebar_item',array(
					'cat_id'	=> $id,
					'uri_segment'	=> 'category'
					));
			}else{
				redirect('home','refresh');
			}
		}

		public function drop_subcat($id)
		{
			// dump_exit(file_exists('item_img/'.$this->input->post('filename')));
			if($this->input->post('filename') !== '')
			{
				unlink('subcat_img/'.$this->input->post('filename'));
				$this->db->delete('sub_category_pic', array('subcat_id' => $id)); 
			}
			$this->db->delete('sub_category', array('id' => $id)); 

			$this->session->set_flashdata('alert', array('note' => 'Successfully Deleted !'));

			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}

		public function add_table_ctrl()
		{
			$data = array(
					'table_no' => $this->input->post('table_no'),
				);
			$this->db->insert('table_settings', $data); 

			$this->session->set_flashdata('alert', array('note' => 'Successfully Added !'));

			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}

		public function update_table_ctrl()
		{
			$data = array(
					'table_no' => $this->input->post('table_no'),
				);
			$this->db->where('id', $this->input->post('table_id'));
			$this->db->update('table_settings', $data);  

			$this->session->set_flashdata('alert', array('note' => 'Successfully Updated !'));

			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}


		// End Dashboard Class
	}