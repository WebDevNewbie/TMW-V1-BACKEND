<?php defined('BASEPATH') OR exit('No direct script access allowed');
	session_start();
	class Discount extends Admin_Controller {
		public function __construct() {
	      	parent::__construct();
	      	$this->load->model('_backend/category/category');
		 	$this->load->model('_backend/percent_discount');
		 	$this->load->model('_backend/buy_take_discount');
	      	$this->load->model('_backend/flat_discount');
		
	    }

	    public function discount_item($id)
	    {
	    	if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$alert = $this->session->flashdata('alert');
				// dump_exit($alert);

				$ids = explode('x', $id);
				$cat_item_id = $ids[0];
				$item_id = $ids[1];

				$idss = explode('a', $cat_item_id);
				$subcat_id = $idss[0];
				$cat_id = $idss[1];

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );

				$item = $this->category->getItem($item_id);
				$get_percent_discount = $this->percent_discount->getDiscount($item_id);
				$get_buy_take_discount = $this->buy_take_discount->getBuyTakeDiscount($item_id);
				$get_flat_discount = $this->flat_discount->getAllFlatDiscount($item_id);
				$all_item = $this->category->getAllItem();
				$all_category = $this->category->getAllCategory();

				

				$this->load->view('layouts/header');
				$this->load->view('admin/discount', array(
						'data'					=> $data,
						'subview'				=> $this->data,
						'item'					=> $item,
						'note'					=> @$alert['note'],
						'cat_item_id'			=> $cat_item_id,
						'subcat_id'				=> $subcat_id,
						'cat_id'				=> $cat_id,
						'get_percent_discount'	=> @$get_percent_discount,
						'get_buy_take_discount'	=> @$get_buy_take_discount,
						'get_flat_discount'		=> @$get_flat_discount,
						'all_item'				=> $all_item,
						'all_category'			=> $all_category
						));
				$this->load->view('layouts/sidebar_item',array(
						'cat_id'	=> $cat_item_id,
						'uri_segment'	=> 'discount'
						));
			}else{
				redirect('home','refresh');
			}
	    }

	    public function add_percent_discount()
	    {
	    	$get_item = $this->percent_discount->getItem($this->input->post('item_id'));
	    	if(count($get_item) < 1)
	    	{
		    	$data = array(
		    		'item_id' 				=> $this->input->post('item_id'),
		    		'discount_price'		=> $this->input->post('percent_discount'),
		    		'discount_from'			=> $this->input->post('discount_from'),
		    		'discount_to'			=> $this->input->post('discount_to'),
		    		);

		    	$query = $this->db->insert('_percent_discount',$data);
		    	if($query)
		    	{
		    		$this->session->set_flashdata('alert', array('note' => 'Successfully Discounted !'));
		    	}
		    }
	    	else
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Already Discounted !'));
	    	}
	    	redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	    public function update_percent_discount()
	    {
	    	$data = array(
	    		'discount_price'		=> $this->input->post('percent_discount'),
	    		'discount_from'			=> $this->input->post('discount_from'),
	    		'discount_to'			=> $this->input->post('discount_to'),
	    		);
	    	$update_percent_discount = $this->percent_discount->update_percent_discount($data,$this->input->post('id'));
	    	if($update_percent_discount)
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Successfully Updated !'));
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Failed to Update !'));
	    	}

	    	redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	    public function delete_percent_discount()
	    {
	    	$this->db->delete('_percent_discount', array('id' => $this->input->post('id')));  

			$this->session->set_flashdata('alert', array('note' => 'Successfully Deleted !'));

			redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	    public function get_sub_or_item()
	    {
	    	$cat_id = $_GET['cat_id'];

	    	$item = $this->category->getSubMenu($cat_id);

			$subcat = $this->category->getSubCat($cat_id);
			if(count($subcat) > 0)
			{
				echo json_encode(array('type' => 'subcat','data' => $subcat));
			}
			elseif(count($item) > 0)
			{
				echo json_encode(array('type' => 'item','data' => $item));
			}
			else
			{
				echo json_encode(array('type' => '','data' => ''));
			}
	    }

	    public function get_item()
	    {
	    	$id = $_GET['id'];

	    	$item = $this->category->getSubCatItem($id);
	    	echo json_encode($item);
	    }

	    public function get_item_name()
	    {
	    	$id = $_GET['id'];

	    	$item = $this->category->getItemName($id);
	    	foreach ($item as $row) {
	    		echo json_encode($row->item_name);
	    	}
	    }

	    public function add_buy_take_discount()
	    {
	    	$data = array(
	    		'item_id'				=> $this->input->post('bt_item_id'),
	    		'buy_num'				=> $this->input->post('bt_buy_num'),
	    		'get_num'				=> $this->input->post('bt_get_num'),
	    		'select_item_id'		=> $this->input->post('bt_sel_item'),
	    		'discount_from'			=> $this->input->post('discount_from'),
	    		'discount_to'			=> $this->input->post('discount_to'),
	    		);

	    	$query = $this->db->insert('_buy_take_discount',$data);
	    	if($query)
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Successfully Discounted !'));
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Failed to Add !'));
	    	}

	    	redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	    public function edit_buy_take_discount()
	    {
	    	$data = array(
	    		'buy_num'				=> $this->input->post('bt_buy_num_edit'),
	    		'get_num'				=> $this->input->post('bt_get_num_edit'),
	    		'select_item_id'		=> $this->input->post('bt_sel_item_edit'),
	    		'discount_from'			=> $this->input->post('discount_from_edit'),
	    		'discount_to'			=> $this->input->post('discount_to_edit'),
	    		);

	    	$update_buy_take_discount = $this->buy_take_discount->update_buy_take_discount($data,$this->input->post('bt_id_edit'));
	    	if($update_buy_take_discount)
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Successfully Updated !'));
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Failed to Update !'));
	    	}

	    	redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	    public function delete_buy_take_discount()
	    {
	    	
	    	$this->db->delete('_buy_take_discount', array('id' => $this->input->post('bt_id_edit')));  

			$this->session->set_flashdata('alert', array('note' => 'Successfully Deleted !'));


	    	redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	     public function add_flat_discount()
	    {
	    	$data = array(
	    		'item_id'				=> $this->input->post('fd_item_id'),
	    		'price'					=> $this->input->post('fd_price'),
	    		'limited_to'			=> $this->input->post('fd_limited_to'),
	    		'discount_from'			=> $this->input->post('discount_from'),
	    		'discount_to'			=> $this->input->post('discount_to'),
	    		);

	    	$query = $this->db->insert('_flat_discount',$data);
	    	if($query)
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Successfully Discounted !'));
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Failed to Add !'));
	    	}

	    	redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	    public function update_flat_discount()
	    {
	    	$data = array(
	    		'price'					=> $this->input->post('fd_price'),
	    		'limited_to'			=> $this->input->post('fd_limited_to'),
	    		'discount_from'			=> $this->input->post('discount_from'),
	    		'discount_to'			=> $this->input->post('discount_to'),
	    		);
	    	// dump_exit($data);

	    	$update_flat_discount = $this->flat_discount->update_flat_discount($data,$this->input->post('fd_id'));
	    	if($update_flat_discount)
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Successfully Updated !'));
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('alert', array('note' => 'Failed to Update !'));
	    	}

	    	redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	    public function delete_flat_discount()
	    {
	    	
	    	$this->db->delete('_flat_discount', array('id' => $this->input->post('fd_id')));  

			$this->session->set_flashdata('alert', array('note' => 'Successfully Deleted !'));


	    	redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }



		// End Dashboard Class
	}