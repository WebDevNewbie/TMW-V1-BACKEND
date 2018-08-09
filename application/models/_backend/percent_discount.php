<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @author
 *
 */

class Percent_Discount extends MY_Model {

	protected $tablename = '_percent_discount';
	protected $_table_name = "_percent_discount";

	public function getItemDiscount($id)
	{
		// $this->db->select('*');
		// $this->db->from('_percent_discount');
		// $this->db->where('item_id',$id);
		// $this->db->where('discount_from >=', date('Y-m-d'));

		$query = $this->db->query('SELECT * FROM _percent_discount WHERE item_id = '.$id);
		// return $query->result();

		foreach ($query->result() as $row) {
			$query1 = $this->db->query('SELECT * FROM _percent_discount WHERE item_id = '.$id.' AND '.strtotime(date("Y-m-d")).' >= '. strtotime($row->discount_from) .' AND '. strtotime(date("Y-m-d")) .' <= '. strtotime($row->discount_to) );
			// $query1 = $this->db->query('SELECT * FROM _percent_discount WHERE item_id = '.$id.' AND '.date("Y-m-d").'BETWEEN '.$row->discount_from .' AND '. $row->discount_to );
			return $query1->result();
		}
	}
	public function getDiscount($id)
	{
		$query = $this->db->query('SELECT * FROM _percent_discount WHERE item_id = '.$id);
		return $query->result();
	}

	public function update_percent_discount($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('_percent_discount', $data); 
		return TRUE;
	}

	public function getItem($id)
	{
		$this->db->select('*');
		$this->db->from('_percent_discount');
		$this->db->where('item_id',$id);

		return $this->db->get()->result();
	}

}