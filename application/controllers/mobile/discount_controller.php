<?php

class discount_controller extends MY_Controller 
{
	public function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin: *'); 
		header('Access-Control-Allow-Headers: content-type'); 
		$this->load->model("mobile/discount_model");
		$this->load->model("mobile/category_model");
	}

	public function index()
	{
		
	}
	public function add_flat_discount()
	    {
	    	$data = $this->discount_model->mod_add_flat_discount();
	    	if($data > 0)
			{
				die(json_encode(array("success"=>true, "fd_data"=>$data  )));
			}
			else
			{
				die(json_encode(array("success"=>false, "fd_data"=>NULL)));
			}

	    }
	
	public function add_pc_discount()
	    {
	    	$data = $this->discount_model->mod_add_pc_discount();
	    	if($data > 0)
			{
				die(json_encode(array("success"=>true, "pc_data"=>$data  )));
			}
			else
			{
				die(json_encode(array("success"=>false, "pc_data"=>NULL)));
			}

	    }
	public function add_bt_discount()
	    {
	    	$data = $this->discount_model->mod_add_bt_discount();
	    	if($data > 0)
			{
				die(json_encode(array("success"=>true, "bt_data"=>$data  )));
			}
			else
			{
				die(json_encode(array("success"=>false, "bt_data"=>NULL)));
			}

	    }
	public function get_discount($id)
	    {
	    	$data1 = $this->discount_model->mod_get_fd_discount($id);
	    	$data2 = $this->discount_model->mod_get_pc_discount($id);
	    	$data3 = $this->discount_model->mod_get_bt_discount($id);
	    	if($data1 > 0 || $data2 > 0 || $data3 > 0)
			{
				die(json_encode(array("success"=>true, "fd_data"=>$data1, "pc_data"=>$data2, "bt_data"=>$data3    )));
			}
			else
			{
				die(json_encode(array("success"=>false, "fd_data"=>NULL, "pc_data"=>NULL, "bt_data"=>NULL )));
			}

	    }
	public function delete_fd_discount($id)
	    {
	    	$data = $this->discount_model->mod_delete_fd_discount($id);
	    	if($data == true)
			{
				die(json_encode(array("success"=>true )));
			}
			else
			{
				die(json_encode(array("success"=>false)));
			}

	    }
	public function delete_pc_discount($id)
	    {
	    	$data = $this->discount_model->mod_delete_pc_discount($id);
	    	if($data == true)
			{
				die(json_encode(array("success"=>true )));
			}
			else
			{
				die(json_encode(array("success"=>false)));
			}

	    }
	public function delete_bt_discount($id)
	    {
	    	$data = $this->discount_model->mod_delete_bt_discount($id);
	    	if($data == true)
			{
				die(json_encode(array("success"=>true )));
			}
			else
			{
				die(json_encode(array("success"=>false)));
			}

	    }
	public function getSubCateg($id, $ids)
	{
		$data = $this->category_model->getSubCateg($id);
		$data1 = $this->category_model->getSubItem($ids);
		
		
		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"item_info"=>$data, "subitem_info"=>$data1 )));
		}
		else
		{
			die(json_encode(array("success"=>false,"item_info"=>null, "subitem_info"=>null)));
		}
	}
	public function get_flat_discount($id)
	    {
	    	$data = $this->discount_model->mod_get_flat_discount($id);
	    	if(count($data) > 0 )
			{
				die(json_encode(array("success"=>true, "fd_data"=>$data  )));
			}
			else
			{
				die(json_encode(array("success"=>false, "fd_data"=>NULL )));
			}

	    }
	public function update_flat_discount($id)
	    {
	    	$data = $this->discount_model->mod_update_fd_discount($id);
	    	if($data == true)
			{
				die(json_encode(array("success"=>true )));
			}
			else
			{
				die(json_encode(array("success"=>false)));
			}

	    }
	public function update_pc_discount($id)
	    {
	    	$data = $this->discount_model->mod_update_pc_discount($id);
	    	if($data == true)
			{
				die(json_encode(array("success"=>true )));
			}
			else
			{
				die(json_encode(array("success"=>false)));
			}

	    }
	public function update_bt_discount($id)
	    {
	    	$data = $this->discount_model->mod_update_bt_discount($id);
	    	if($data == true)
			{
				die(json_encode(array("success"=>true )));
			}
			else
			{
				die(json_encode(array("success"=>false)));
			}

	    }
		
}

?>