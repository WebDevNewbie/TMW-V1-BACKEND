<?php
class discount_model extends MY_Model 
{
	
    function __construct() {
        parent::__construct();
    }
	
	public function mod_add_flat_discount()
	{
		$data = array(
	    		'item_id'				=> $this->input->post('fd_item_id'),
	    		'price'					=> $this->input->post('fd_price'),
	    		'limited_to'			=> $this->input->post('fd_limited_to'),
	    		'discount_from'			=> date("Y-m-d", strtotime($this->input->post('discount_from'))),
	    		'discount_to'			=> date("Y-m-d", strtotime($this->input->post('discount_to')))
	    		);
		$query = $this->db->get_where('_flat_discount', array('item_id' => $this->input->post('fd_item_id')))->num_rows();
		
		if($query == 0){
			$this->db->insert('_flat_discount', $data); 
			return $this->db->insert_id();
		}
		else{
			return 0;
		}
		
	}
	
	public function mod_add_pc_discount()
	{
		$data = array(
	    		'item_id'				=> $this->input->post('pc_item_id'),
	    		'discount_price'		=> $this->input->post('pc_discount'),
	    		'discount_from'			=> $this->input->post('discount_from'),
	    		'discount_to'			=> $this->input->post('discount_to')
	    		);
		$query = $this->db->get_where('_percent_discount', array('item_id' => $this->input->post('pc_item_id')))->num_rows();
		
		if($query == 0){
			$this->db->insert('_percent_discount', $data); 
			return $this->db->insert_id();
		}
		else{
			return 0;
		}
		
	}
	
	public function mod_add_bt_discount()
	{
		$data = array(
	    		'item_id'				=> $this->input->post('bt_item_id'),
	    		'buy_num'				=> $this->input->post('bt_buy'),
	    		'get_num'				=> $this->input->post('bt_get'),
	    		'select_item_id'		=> $this->input->post('bt_select_item'),
	    		'discount_from'			=> date("Y-m-d", strtotime($this->input->post('discount_from'))),
	    		'discount_to'			=> date("Y-m-d", strtotime($this->input->post('discount_to')))
	    		);
		$query = $this->db->get_where('_buy_take_discount', array('item_id' => $this->input->post('bt_item_id')))->num_rows();
		
		if($query == 0){
			$this->db->insert('_buy_take_discount', $data); 
			return $this->db->insert_id();
		}
		else{
			return 0;
		}
		
	}
	public function mod_get_fd_discount($id)
	{
		
		$query = $this->db->get_where('_flat_discount', array('item_id' => $id))->result();
		
		if($query){
			
			return $query;
		}
		else{
			return NULL;
		}
		
	}
	
	public function mod_get_pc_discount($id)
	{
		
		$query = $this->db->get_where('_percent_discount', array('item_id' => $id))->result();
		
		if($query){
			
			return $query;
		}
		else{
			return NULL;
		}
		
	}
	
	public function mod_get_bt_discount($id)
	{
		
		$query = $this->db->get_where('_buy_take_discount', array('item_id' => $id))->result();
		
		if($query){
			
			return $query;
		}
		else{
			return NULL;
		}
		
	}
	
	public function mod_delete_bt_discount($id)
	{
		
		$query = $this->db->delete('_buy_take_discount', array('id' => $id));
		
		if($query){
			
			return true;
		}
		
	}
	public function mod_delete_pc_discount($id)
	{
		
		$query = $this->db->delete('_percent_discount', array('id' => $id));
		
		if($query){
			
			return true;
		}
		
	}
	
	public function mod_delete_fd_discount($id)
	{
		
		$query = $this->db->delete('_flat_discount', array('id' => $id));
		
		if($query){
			
			return true;
		}
		
	}
	public function mod_get_flat_discount($id)
	{
		
		$query = $this->db->get_where('_flat_discount', array('id' => $id))->result();
		
		if($query){
			
			return $query;
		}
		else{
			return NULL;
		}
		
	}
	public function mod_update_fd_discount($id)
	{
		$data = array(
	    		'price'					=> $this->input->post('fd_price'),
	    		'limited_to'			=> $this->input->post('fd_limited_to'),
	    		'discount_from'			=> date("Y-m-d", strtotime($this->input->post('discount_from'))),
	    		'discount_to'			=> date("Y-m-d", strtotime($this->input->post('discount_to')))
	    		);
		$query = $this->db->update('_flat_discount', $data, array('id' => $id));
		
		if($query){
			
			return true;
		}
		
	}
	
	public function mod_update_pc_discount($id)
	{
		$data = array(
	    		'discount_price'		=> $this->input->post('pc_discount'),
	    		'discount_from'			=> date("Y-m-d", strtotime($this->input->post('discount_from'))),
	    		'discount_to'			=> date("Y-m-d", strtotime($this->input->post('discount_to')))
	    		);
		$query = $this->db->update('_percent_discount', $data, array('id' => $id));
		
		if($query){
			
			return true;
		}
		
	}
	
	public function mod_update_bt_discount($id)
	{
		$data = array(
	    		'buy_num'				=> $this->input->post('bt_buy'),
	    		'get_num'				=> $this->input->post('bt_get'),
	    		'select_item_id'		=> $this->input->post('bt_select_item'),
	    		'discount_from'			=> date("Y-m-d", strtotime($this->input->post('discount_from'))),
	    		'discount_to'			=> date("Y-m-d", strtotime($this->input->post('discount_to')))
	    		);
		$query = $this->db->update('_buy_take_discount', $data, array('id' => $id));
		
		if($query){
			
			return true;
		}
		
	}
	
} 


?>