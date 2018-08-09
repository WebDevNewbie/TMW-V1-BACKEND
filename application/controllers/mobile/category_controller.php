<?php

class category_controller extends MY_Controller 
{
	public function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin: *'); 
		header('Access-Control-Allow-Headers: content-type'); 
		$this->load->model("mobile/category_model");
	}

	public function index()
	{
		$today = date("Y-m-d");
		$data = $this->category_model->get();
		$subs = $this->category_model->getSub();
		$menuItems = $this->db->query("SELECT * FROM menu_item")->result();
		$menuItemsPic = $this->db->query("SELECT * FROM menu_item_pic")->result();
		$buyTakeDiscount = $this->db->query("SELECT * FROM _buy_take_discount WHERE discount_from <= '".$today."' AND discount_to >= '".$today."'")->result();
		$flatDiscount = $this->db->query("SELECT * FROM _flat_discount WHERE discount_from <= '".$today."' AND discount_to >= '".$today."'")->result();
		$percentDiscount = $this->db->query("SELECT * FROM _percent_discount WHERE discount_from <= '".$today."' AND discount_to >= '".$today."'")->result();
		// var_dump($buyTakeDiscount);
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"category_info"=>$data , "subs"=>$subs, "menu_items"=>$menuItems, "menu_items_pic"=>$menuItemsPic, "buy_take_discount"=>$buyTakeDiscount, "flat_discount"=>$flatDiscount, "percent_discount"=>$percentDiscount)));
		}
		else
		{
			die(json_encode(array("success"=>false,"category_info"=>null , "subs"=>NULL, "menu_items"=>NULL, "menu_items_pic"=>NULL, "buy_take_discount"=>NULL, "flat_discount"=>NULL, "percent_discount"=>NULL)));
		}
	}
	
	public function getCategItem($id)
	{
		$data = $this->category_model->getCategItem($id);
		
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"item_info"=>$data )));
		}
		else
		{
			die(json_encode(array("success"=>false,"item_info"=>null)));
		}
	}
	
	public function getSubCateg($id)
	{
		$data = $this->category_model->getSubCateg($id);
		
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"item_info"=>$data )));
		}
		else
		{
			die(json_encode(array("success"=>false,"item_info"=>null)));
		}
	}

	public function getSubItem($id)
	{
		$data = $this->category_model->getSubItem($id);
		
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"item_info"=>$data )));
		}
		else
		{
			die(json_encode(array("success"=>false,"item_info"=>null)));
		}
	}

	public function getMenuItem($id)
	{
		$data = $this->category_model->getMenuItem($id);
		
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"item_info"=>$data )));
		}
		else
		{
			die(json_encode(array("success"=>false,"item_info"=>null)));
		}
	}
	public function getSubMenuItem($id)
	{
		$data = $this->category_model->getSubMenuItem($id);
		
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"item_info"=>$data )));
		}
		else
		{
			die(json_encode(array("success"=>false,"item_info"=>null)));
		}
	}
	public function getTableSetting()
	{
		$data = $this->category_model->getTableSetting();
		
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"table_setting"=>$data )));
		}
		else
		{
			die(json_encode(array("success"=>false,"table_setting"=>null)));
		}
	}
	public function categItems()
	{
		$data = $this->category_model->categItems();
		
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"table_setting"=>$data )));
		}
		else
		{
			die(json_encode(array("success"=>false,"table_setting"=>null)));
		}
	}
	public function getFirstItem()
	{
		$data = $this->category_model->getFirstItem();
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"first_item"=>$data )));
		}
		else
		{
			die(json_encode(array("success"=>false,"first_item"=>null)));
		}
	}
	
	public function getItem($id)
	{
		$data = $this->category_model->getItem($id);
		
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"item_det"=>$data )));
		}
		else
		{
			die(json_encode(array("success"=>false,"item_det"=>null)));
		}
	}
	public function getTableOrder($id)
	{
		$data = $this->category_model->getTableOrder($id);
		
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"table_det"=>$data )));
		}
		else
		{
			die(json_encode(array("success"=>false,"table_det"=>null)));
		}
	}
	public function deleteCateg($id)
	{
		$data = $this->category_model->deleteCateg($id);
		
		
		if($data == true)
		{
			die(json_encode(array("success"=>true )));
		}
		else
		{
			die(json_encode(array("success"=>false)));
		}
	}
	public function deleteSubCateg($id)
	{
		$data = $this->category_model->deleteSubCateg($id);
		
		
		if($data == true)
		{
			die(json_encode(array("success"=>true )));
		}
		else
		{
			die(json_encode(array("success"=>false)));
		}
	}
	public function updateCateg($id)
	{
		$data = $this->category_model->updateCateg($id);
		
		
		if($data == true)
		{
			die(json_encode(array("success"=>true )));
		}
		else
		{
			die(json_encode(array("success"=>false)));
		}
	}
	public function updateSubCateg($id)
	{
		$data = $this->category_model->updateSubCateg($id);
		
		
		if($data == true)
		{
			die(json_encode(array("success"=>true )));
		}
		else
		{
			die(json_encode(array("success"=>false)));
		}
	}
	public function addCateg()
	{
		$data = $this->category_model->addCateg();
		
		
		if($data > 0)
		{
			die(json_encode(array("success"=>true, "new_categ"=>$data  )));
		}
		else
		{
			die(json_encode(array("success"=>false, "new_categ"=>NULL)));
		}
	}
	public function addSubCateg()
	{
		$data = $this->category_model->addSubCateg();
		
		
		if($data > 0)
		{
			die(json_encode(array("success"=>true, "new_subcateg"=>$data  )));
		}
		else
		{
			die(json_encode(array("success"=>false, "new_subcateg"=>NULL)));
		}
	}
	public function orderNow()
	{
		// echo "yoh";
		$orderdata = $this->input->post('orders_details');
		$orderdetails = $orderdata['order'];

		// var_dump($orderdata);
		$orderinfo = array(
							'member_id' 		=> "",
							'table_no' 			=> $orderdata['table_no'],
							'total_payment' 	=> $orderdata['total_payment'],
							'cash' 				=> 0,
							'dine_type'			=> $orderdata['dine_type'],
							'bill_status'		=> 0,
							'cooking_status'	=> "New Order",
							'status'			=> "current",
							'order_date'		=>  date("Y-m-d H:i:s"),
							'timestamp'			=>  time()
						); 
		
		$orderinfosaved = $this->db->insert('customer_order_info', $orderinfo);

		$this->db->select(' id ');
		$this->db->from('customer_order_info');
		$this->db->order_by('id','DESC');
		$this->db->limit(1);
		$data['orderinfo'] = $this->db->get()->result();

		$orderid = (int)$data['orderinfo'][0]->id;

		// var_dump($orderid);

		for ($i=0; $i < count($orderdetails); $i++) {
			$orderdata = array(
								'order_id' 			=> $orderid,
								'item_id' 			=> $orderdetails[$i]['id'],
								'item_qty' 			=> $orderdetails[$i]['quantity'],
								'item_price'		=> $orderdetails[$i]['total'],
								'cooking_status'	=> "New Order"
							); 
			
			$orderdatasaved = $this->db->insert('customer_orders', $orderdata);
		}

		die(json_encode("success"));
	}


	public function addMenuItem()
	{
		$menuitem = array(
							'category_id'		=> $_POST['categ_id'],
							'subcat_id'		    => $_POST['categ_sid'],
							'item_name'		    => $_POST['categ_name'],
							'price'				=> $_POST['categ_price'],
							'description'		=> $_POST['categ_desc'],
						); 
		
		$menuitemsaved = $this->db->insert('menu_item', $menuitem);
		if($this->db->affected_rows() > 0)
		$id =  $this->db->insert_id();

		$menupic = array(
							'item_id'			=> $id,
							'path'		    	=> "item_img/",
							'filename'		    => $_POST['categ_name'].".jpg",
						); 
		
		$menupicsaved = $this->db->insert('menu_item_pic', $menupic);

		$result = move_uploaded_file($_FILES["image"]["tmp_name"], 'item_img/'.$_POST['categ_name'].".jpg");
		if($result){
					die(json_encode(array("success"=>true, "id"=>$id)));
				}
				else{
					die( json_encode('error' ) );
				}

		// die(json_encode($_SERVER['DOCUMENT_ROOT'].'/item_img/'.$_POST['categ_name'].".jpg"));
	}

	public function updateMenuItem()
	{
		$menuitem = array(
							'item_name'		    => $_POST['categ_name'],
							'price'				=> $_POST['categ_price'],
							'description'		=> $_POST['categ_desc'],
						); 
		
		$this->db->where('id', $_POST['id']);
		$this->db->update('menu_item', $menuitem); 


		if($_POST['imageChecker'] == true)
		{
			$menupic = array(
								'filename'		    => $_POST['categ_name'].".jpg",
							); 
			
			$this->db->where('item_id', $_POST['id']);
			$this->db->update('menu_item_pic', $menupic);


			$this->db->select('*');
			$this->db->from('menu_item_pic');
			$this->db->where('item_id', $_POST['id']);
			$data['itempic'] = $this->db->get()->result();

			$orderid = $data['itempic'][0]->filename;

			unlink('item_img/'.$orderid);
			$result = move_uploaded_file($_FILES["image"]["tmp_name"], 'item_img/'.$_POST['categ_name'].".jpg");
			if($result){
				die(json_encode(array("success"=>true, "id"=>NULL)));
			}
			else{
				die( json_encode('error' ) );
			}
		}
		else
		{
			die(json_encode(array("success"=>true, "id"=>0)));
		}



		// die(json_encode($_SERVER['DOCUMENT_ROOT'].'/item_img/'.$_POST['categ_name'].".jpg"));
	}

	public function updateMenuItemWithoutPic()
	{
		$menuitem = array(
							'item_name'		    => $this->input->post('categ_name'),
							'price'				=> $this->input->post('categ_price'),
							'description'		=> $this->input->post('categ_desc'),
						); 
		
		$this->db->where('id', $this->input->post('id'));
		$data = $this->db->update('menu_item', $menuitem); 

		if($data == true)
		{
			die(json_encode(array("success"=>true )));
		}
		else
		{
			die(json_encode(array("success"=>false)));
		}

		// die(json_encode($_SERVER['DOCUMENT_ROOT'].'/item_img/'.$_POST['categ_name'].".jpg"));
	}
	
	public function deleteMenuItem()
	{
		$menuitem = array(
							'id'		=> $this->input->post('id'),
						 ); 

		$this->db->delete('menu_item', $menuitem); 


		$this->db->select('*');
		$this->db->from('menu_item_pic');
		$this->db->where('item_id', $this->input->post('id'));
		$data['itempic'] = $this->db->get()->result();

		$orderid = $data['itempic'][0]->filename;

		unlink('item_img/'.$orderid);

		$menupic = array(
							'item_id'	=> $this->input->post('id'),
						); 
		$this->db->delete('menu_item_pic', $menupic); 
		
		if($data == true)
		{
			die(json_encode(array("success"=>true )));
		}
		else
		{
			die(json_encode(array("success"=>false)));
		}

		// die(json_encode($_SERVER['DOCUMENT_ROOT'].'/item_img/'.$_POST['categ_name'].".jpg"));
	}
}

?>