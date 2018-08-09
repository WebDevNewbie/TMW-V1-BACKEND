<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @author
 *
 */

class Buy_Take_Discount extends MY_Model {

	protected $tablename = '_buy_take_discount';
	protected $_table_name = "_buy_take_discount";

	public function getDiscount($id)
	{
		$this->db->select('_buy_take_discount.*');
		$this->db->from('_buy_take_discount');
		$this->db->where('_buy_take_discount.item_id',$id);
		$result = $this->db->get();

		foreach ($result->result() as $row) 
		{
			// $this->db->select('menu_item.item_name, menu_item.price , _buy_take_discount.*');
			// $this->db->from('_buy_take_discount');
			// $this->db->join('menu_item', '_buy_take_discount.item_id = menu_item.id','LEFT');
			// $this->db->where('_buy_take_discount.item_id',$id);
			// $this->db->where(strtotime(date("Y-m-d")).'>=',strtotime($row->discount_from));
			// $this->db->where(strtotime(date("Y-m-d")).'<=',strtotime($row->discount_to));
			// $result1 = $this->db->get();

			$result1 = $this->db->query('SELECT menu_item.item_name, menu_item.price , _buy_take_discount.* FROM _buy_take_discount INNER JOIN menu_item ON _buy_take_discount.item_id = menu_item.id WHERE _buy_take_discount.item_id = '.$id. ' AND '.strtotime(date("Y-m-d")).' >= '. strtotime($row->discount_from).' AND '. strtotime(date("Y-m-d")) .' <= '. strtotime($row->discount_to) );

			return $result1->result();
		}
	}


	public function getBuyTakeDiscount($id)
	{
		$query = $this->db->query('SELECT * FROM _buy_take_discount WHERE item_id = '.$id);
		return $query->result();
	}



    public function getCat($sel_item_id)
    {
    	$this->db->select('*');
    	$this->db->from('menu_item');
    	$this->db->where('id',$sel_item_id);
    	return $this->db->get()->result();
    }

    public function update_buy_take_discount($data,$id)
    {
    	$this->db->where('id', $id);
		$this->db->update('_buy_take_discount', $data); 
		return TRUE;
    }

}