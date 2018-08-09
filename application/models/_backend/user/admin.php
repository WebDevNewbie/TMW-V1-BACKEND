<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @author
 *
 */

class Admin extends MY_Model {

	protected $tablename = 'admin';
	protected $_table_name = "admin";

	public function getAdminInfo($data){
		$query = $this->db->get_where($this->tablename, $data);
		return $query->result();
	}
	
}