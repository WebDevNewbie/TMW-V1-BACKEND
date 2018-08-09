<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @author
 *
 */

class Category extends MY_Model {

	protected $tablename = 'menu_category';
	protected $_table_name = "menu_category";

	public function getCategories($params = array())
	{
		$this->db->select('menu_category.*,menu_category_pic.cat_id,menu_category_pic.path,menu_category_pic.filename');
		$this->db->from('menu_category');
		$this->db->join('menu_category_pic','menu_category.id = menu_category_pic.cat_id', 'left');
		$this->db->order_by('menu_category.category_name','ASC');
		
		  if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
		
		return $this->db->get()->result();
	}

	public function addCategory($data)
	{
		$this->db->insert('menu_category', $data); 
		return  $this->db->insert_id();
	}

	public function addCatImg($data)
	{
		$this->db->insert('menu_category_pic', $data); 
		return  TRUE;
	}
	
	public function updateCategory($data,$cat_id)
	{
		$this->db->where('id', $cat_id);
		$this->db->update('menu_category', $data); 
		return  $this->db->insert_id();
	}

	public function updateCatImg($data,$cat_id)
	{
		$this->db->where('cat_id', $cat_id);
		$this->db->update('menu_category_pic', $data); 
		return TRUE;	
	}

	public function getSubMenu($id)
	{
		$this->db->select('menu_item.*,menu_item_pic.item_id,menu_item_pic.path,menu_item_pic.filename');
		$this->db->from('menu_item');
		$this->db->join('menu_item_pic','menu_item.id = menu_item_pic.item_id', 'left');
		$this->db->where('menu_item.category_id',$id);
		$this->db->order_by('menu_item.item_name','ASC');
		return $this->db->get()->result();
	}
	public function getCategoryName($id)
	{
		$this->db->select('category_name');
		$this->db->from('menu_category');
		$this->db->where('id',$id);
		return $this->db->get()->result();
	}

	public function getSubCategoryName($id)
	{
		$this->db->select('subcat_name');
		$this->db->from('sub_category');
		$this->db->where('id',$id);
		return $this->db->get()->result();
	}

	public function addItem($data)
	{
		$this->db->insert('menu_item', $data); 
		return  $this->db->insert_id();
	}

	public function addItemImg($data)
	{
		$this->db->insert('menu_item_pic', $data); 
		return  TRUE;
	}

	public function updateItem($data,$cat_id)
	{
		$this->db->where('id', $cat_id);
		$this->db->update('menu_item', $data); 
		return  $this->db->insert_id();
	}

	public function updateItemImg($data,$id)
	{
		$this->db->where('item_id', $id);
		$this->db->update('menu_item_pic', $data); 
		return TRUE;	
	}


	public function getSubCat($id)
	{
		$this->db->select('sub_category.*,sub_category_pic.subcat_id,sub_category_pic.path,sub_category_pic.filename');
		$this->db->from('sub_category');
		$this->db->join('sub_category_pic','sub_category.id = sub_category_pic.subcat_id', 'left');
		$this->db->where('sub_category.category_id',$id);
		$this->db->order_by('sub_category.subcat_name','ASC');
		return $this->db->get()->result();
	}

	public function addSubCat($data)
	{
		$this->db->insert('sub_category', $data); 
		return  $this->db->insert_id();
	}

	public function addSubCatImg($data)
	{
		$this->db->insert('sub_category_pic', $data); 
		return  TRUE;
	}

	public function getSubCatItem($id)
	{
		$this->db->select('menu_item.*,menu_item_pic.item_id,menu_item_pic.path,menu_item_pic.filename');
		$this->db->from('menu_item');
		$this->db->join('menu_item_pic','menu_item.id = menu_item_pic.item_id', 'left');
		$this->db->where('menu_item.subcat_id',$id);
		$this->db->order_by('menu_item.item_name','ASC');
		return $this->db->get()->result();
	}

	public function updateSubCatItem($data,$cat_id)
	{
		$this->db->where('id', $cat_id);
		$this->db->update('sub_category', $data); 
		return  $this->db->insert_id();
	}

	public function updateSubCatImg($data,$id)
	{
		$this->db->where('subcat_id', $id);
		$this->db->update('sub_category_pic', $data); 
		return TRUE;	
	}

	public function getItemName($id)
	{
		$this->db->select('item_name');
		$this->db->from('menu_item');
		$this->db->where('id', $id);

		return $this->db->get()->result();

	}

	public function getItem($id)
	{
		$this->db->select('*');
		$this->db->from('menu_item');
		$this->db->where('id', $id);

		return $this->db->get()->result();

	}

	public function getAllItem()
	{
		$this->db->select('*');
		$this->db->from('menu_item');

		return $this->db->get()->result();

	}

	public function getAllCategory()
	{
		$this->db->select('*');
		$this->db->from('menu_category');
		$this->db->order_by('category_name','ASC');

		return $this->db->get()->result();

	}
}