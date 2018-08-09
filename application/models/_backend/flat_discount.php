<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @author
 *
 */

class Flat_Discount extends MY_Model {

	protected $tablename = '_flat_discount';
	protected $_table_name = "_flat_discount";

	public function getFlatDiscount($id)
	{
		$this->db->select('*');
		$this->db->from('_flat_discount');
		$this->db->where('item_id',$id);
		$result = $this->db->get();

		foreach($result->result() as $row)
		{
			$result1 = $this->db->query('SELECT * FROM _flat_discount WHERE item_id ='.$id. ' AND '.strtotime(date("Y-m-d")).' >= '. strtotime($row->discount_from).' AND '. strtotime(date("Y-m-d")) .' <= '. strtotime($row->discount_to));
			return $result1->result();
		}
	}


	public function getAllFlatDiscount($id)
	{
		$query = $this->db->query('SELECT * FROM _flat_discount WHERE item_id = '.$id);
		return $query->result();
	}

	public function update_flat_discount($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('_flat_discount', $data); 
		return TRUE;
	}

}