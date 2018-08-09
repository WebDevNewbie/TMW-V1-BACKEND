<?php
class category_model extends MY_Model 
{
	
	protected $_table_name = 'menu_category';
	protected $_order_by = 'category_name';
    protected $_timestamps = TRUE;

    

    function __construct() {
        parent::__construct();
    }
	
	public function getSub(){
		
		$query = $this->db->get("sub_category");
		
		return $query->result();
	}
	
	public function categItems(){
		
		$this->db->select('*, menu_item_pic.id as pic_item_id ');
		$this->db->from('menu_item_pic');
		$this->db->join('menu_item', 'menu_item.id = menu_item_pic.item_id');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getTableSetting(){
		
		$query = $this->db->get("table_settings");
		
		return $query->result();
	}
	
	public function getSubCateg($id){
		
		$query = $this->db->get_where("sub_category", array('category_id' => $id));
		
		return $query->result();
	}
	
	public function getSubItem($id){
		
		$query = $this->db->get_where("menu_item", array('subcat_id' => $id));
		
		return $query->result();
	}

	public function getMenuItem($id){
		
		$query = $this->db->get_where("menu_item", array('category_id' => $id));
		
		return $query->result();
	}
	public function getSubMenuItem($id){
		
		$query = $this->db->get_where("menu_item", array('subcat_id' => $id));
		
		return $query->result();
	}
	public function getCategItem($id){
		
		$query = $this->db->get_where("menu_item", array('category_id' => $id));
		
		return $query->result();
	}
	
	public function getFirstItem(){
		
		$categ = $this->db->get("menu_category");
		$id = $categ->first_row()->id;
		
		$query['menu_item'] = $this->db->get_where("menu_item", array('category_id' => $id))->result();
		$query['menu_name'] = $this->db->get_where("menu_category", array('id' => $id))->result();
		$query['table_settings'] = $this->db->get("table_settings")->result();
		
		return $query;
	}
	
	public function getItem($id){
		
		$query = $this->db->get_where("menu_item", array('id' => $id));
		return $query->result();
	}
	public function getTableOrder($id){
		$data = array();
		$tableQuery = $this->db->get_where("customer_order_info", array('table_no' => $id));
		$tablerow = $tableQuery->row_array(); 
		$orderQuery = $this->db->get_where("customer_orders", array('order_id' => $tablerow['id']));
		foreach ($orderQuery->result() as $orderRow)
		   {
				$itemQuery = $this->db->get_where("menu_item", array('id' => $orderRow->item_id));
				$itemrow = $itemQuery->row_array(); 
				$dataArray = array(
					'item_name' => $itemrow['item_name'],
					'item_qty' => $orderRow->item_qty
				);
				array_push($data,$dataArray);
		   }
		  return $data;
	}
	public function deleteCateg($id){
		
		$this->db->where('id', $id);
		$data = $this->db->delete('menu_category');
		if($data){
			return true;
		}
	}

	public function deleteSubCateg($id){
		
		$this->db->where('id', $id);
		$data = $this->db->delete('sub_category');
		if($data){
			return true;
		}
	}
	
	public function updateCateg($id){
		
		$name = $this->input->post("categ_name",TRUE);
		$_login_secret    = (string)$this->input->post("loginSecret",TRUE);
		$_system_secret = '0ff9346b4edc8dc033bff30762bc3c15d465d3f';
        
		if($_login_secret === $_system_secret)
        {
			$this->db->update('menu_category', array('category_name' => $name ), array('id' => $id));
			return true;
			
        }
	}

	public function updateSubCateg($id){
		
		$name = $this->input->post("subcateg_name",TRUE);
		$_login_secret    = (string)$this->input->post("loginSecret",TRUE);
		$_system_secret = '0ff9346b4edc8dc033bff30762bc3c15d465d3f';
        
		if($_login_secret === $_system_secret)
        {
			$this->db->update('sub_category', array('subcat_name' => $name ), array('id' => $id));
			return true;
			
        }
	}
	
	public function addCateg()
	{
		$name      = $this->input->post("categ_name",TRUE);
		$desc = $this->input->post("categ_desc",TRUE);
		$_login_secret    = (string)$this->input->post("loginSecret",TRUE);

		$_system_secret = '0ff9346b4edc8dc033bff30762bc3c15d465d3f';

		$data = array(
							'category_name'		 => $name,
							'description'		 => $desc
							);

        if($_login_secret === $_system_secret)
        {
			$this->db->insert('menu_category', $data);
			if($this->db->affected_rows() > 0)
				return $this->db->insert_id(); 			
        }
	}

	public function addSubCateg()
	{
		$cat_id 	= $this->input->post("categ_id",TRUE);
		$name      = $this->input->post("categ_name",TRUE);
		$desc = $this->input->post("categ_desc",TRUE);
		$_login_secret    = (string)$this->input->post("loginSecret",TRUE);

		$_system_secret = '0ff9346b4edc8dc033bff30762bc3c15d465d3f';

		$data = array(
							'category_id'		 => $cat_id,
							'subcat_name'		 => $name,
							'subcat_description'		 => $desc
							);

        if($_login_secret === $_system_secret)
        {
			$this->db->insert('sub_category', $data); 
			if($this->db->affected_rows() > 0)
				return $this->db->insert_id(); 
			
        }
	}

} #end of Class


?>