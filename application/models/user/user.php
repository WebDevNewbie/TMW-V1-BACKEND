<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @author
 *
 */

class User extends MY_Model {

	protected $tablename = 'users';
	protected $_table_name = "users";

	public function getUserInfo($data){
		$query = $this->db->get_where($this->tablename, $data);
		return $query->result();
	}
	public function getMemberID(){
		
		$this->db->select("id");
		$this->db->from("members");
		$this->db->order_by("id", "desc"); 
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}
	public function saveMember($data){
		
		$query = $this->db->insert('members', $data); 
		
		if($query){
			return true;
		}
	}
}