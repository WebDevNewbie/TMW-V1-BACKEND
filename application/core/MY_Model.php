
<?php
class MY_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	protected $_timestamps = FALSE;
	
	public $rules = array();
	
	function __construct() {
		parent::__construct();
	}
	
	public function array_from_post($fields){
		$data = array();
		foreach ($fields as $field) {
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}

	public function _table_query($_table_name, $limit = NULL, $start = 0) {
		if (isset($limit))
		  $this->db->limit($limit, $start);
	}

	public function get($id = NULL, $single = FALSE) {
		
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
		}
		return $this->db->get($this->_table_name)->$method();
	}
	
	/*
	 * @get_by(): Query data by slug or as array on $where variable. 
	 * ex: array('id' => $id) will return single ID
	*/  
	public function get_by($where, $single = FALSE){
		$this->db->where($where);
		return $this->get(NULL, $single);
	}

	public function save_into($data, $id=NULL) {
		// Ref: https://github.com/bcit-ci/CodeIgniter/commit/04c50f50ad1f522f9521197f9ee7059da52168e0
		$data['id'] = $id;
		$this->db->replace($this->_table_name, $data);
	}
	
	public function save($data, $id = NULL){
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$id || $data['datetime_created'] = $now;
			$data['datetime_modified'] = $now;
		}
		
		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		
		return $id;
	}

	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		
		if (!$id) {
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}
	 public function general_paginator($data){									
    	#pagination								
    	$this->load->library("pagination");								
									
    	#get data								
		$table            = @$data["table"]==null ? false : @$data["table"];							
		$select           = @$data["select"]==null ? "*" : @$data["select"];							
		$start            = @$data["start"]==null ? 0 : @$data["start"];							
		$per_page         = @$data["per_page"]==null ? 5 : @$data["per_page"];							
		$filter           = @$data["filter"]==null ? false : @$data["filter"];							
		$or_filter        = @$data["or_filter"]==null ? false : @$data["or_filter"];							
		$like_filter      = @$data["like_filter"]==null ? false : @$data["like_filter"];							
		$total            = 0;							
		$join             = @$data["join"]==null ? false : @$data["join"];							
		$order            = @$data["order"]==null ? false : @$data["order"];							
		$group            = @$data["group"]==null ? false : @$data["group"];							
		$base_url         = @$data['base_url']==null ? base_url() : @$data["base_url"];							
		$wherein          = @$data['wherein']==null ? false : @$data['wherein'];							
		$custom           = @$data['custom_query']==null ? false : @$data['custom_query'];							
		$anchor_injection = @$data['anchor_injection'] ==null ? false : @$data['anchor_injection'];							
									
      	#pass get to a variable								
      	$get = $this->input->get();								
									
      	$base_url .= "?";								
									
      	if($get){								
      		unset($get["per_page"]);							
      		$base_url .= http_build_query($get, '', "&");							
      	}								
									
      	#check if table is set								
       	if($table){								
       		/*							
       		* initialization phase 							
       		*/							
									
       		#check if filter is not false ----------------------------------------------							
       		if($filter){							
       			#check if filter is an array						
       			if(is_array($filter) && count($filter)!=0){						
       				$this->db->where($filter); #apply filter 					
       			}						
       		}							
									
       		#or fitler  ----------------------------------------------							
       		if($or_filter){							
       			#check if or_filter is an array						
       			if(is_array($or_filter) && count($or_filter)!=0){						
       				$this->db->or_where($or_filter); ///apply or filter					
       			}						
       		}							
									
       		#check if pagination joining is not false ----------------------------------------------							
       		if($join){							
       			#check if the join variable is an array						
       			if(is_array($join) && count($join)!=0){						
       				#loop through the array					
       				foreach ($join as $joining_fields) {					
       					#commence joining				
       					$this->db->join($joining_fields["table"], $joining_fields["condition"],"LEFT");				
       				}					
       			}						
       		}							
									
       		#like filter ----------------------------------------------							
       		if($like_filter){							
                $this->db->like($like_filter);									
       		}							
                  									
       		#order query ----------------------------------------------							
       		#check if the order array is present							
       		if($order){							
       			$this->db->order_by($order["column_name"],$order["order"]);						
       		}else{							
                if(@$_GET['order_by']!==null):									
                      $order_by = $_GET['order_by'];									
                      $order_style = $this->data['order_style'];									
                      $this->db->order_by($order_by,$order_style);									
                endif; 									
            }									
                  									
       		#group query ----------------------------------------------							
       		#check if the group array is present 							
       		if($group){							
       			$this->db->group_by($group);						
       		}							
									
          	#check if wherein exsits								
          	if($wherein):								
                if(is_array($wherein)):									
                      if(count($wherein)):									
                            $this->db->where_in($wherein['column_name'],$wherein['column_value']);									
                      endif;									
                endif;									
          	endif;								
									
          	#check if a filter query exists								
          	if($custom):								
                $arr[$custom]=null;									
                $this->db->where($arr);									
          	endif;								
									
       		#select ----------------------------------------------							
       		$this->db->select($select);							
									
       		#get contents  ----------------------------------------------							
       		$counter_content = $this->db->get($table)->result_array();							
									
       		#total number of rows ----------------------------------------------							
       		$total = count($counter_content);							
									
       		/*							
       		* end of initialization phase							
       		*/							
									
       		/*							
       		* pagination phase 							
       		*/							
			$config['base_url']          = $base_url;						
			$config['total_rows']        = $total;						
			$config['per_page']          = $per_page; 						
			$config["num_links"]         = 5;						
			$config['page_query_string'] = TRUE;						
			$config['full_tag_open']     = "<ul class='pagination'>";						
			$config['full_tag_close']    ="</ul>";						
			$config['num_tag_open']      = "<li>";						
			$config['num_tag_close']     = "</li>";						
			$config['cur_tag_open']      = "<li class='disabled'><li class='active'><a href='javascript:void(0);'>";						
			$config['cur_tag_close']     = "<span class='sr-only'></span></a></li>";						
			$config['next_tag_open']     = "<li >";						
			$config['next_tagl_close']   = "</li>";						
			$config['prev_tag_open']     = "<li >";						
			$config['prev_tagl_close']   = "</li>";						
			$config['first_tag_open']    = "<li >";						
			$config['first_tagl_close']  = "</li>";						
			$config['last_tag_open']     = "<li  class='btn-primary'>";						
			$config['last_tagl_close']   = "</li>";						
			$config['prev_link']         = '<i class="fa fa-angle-left"></i>';						
			$config['next_link']         = '<i class="fa fa-angle-right"></i>';						
									
			$this->pagination->initialize($config); 						
			$page_links =  $this->pagination->create_links();						
			/*						
			* end of pagination phase 						
			*/						
									
			/*						
			* start of display phase 						
			*/						
									
       		#check if filter is not false ----------------------------------------------							
       		if($filter){							
       			#check if filter is an array 						
       			if(is_array($filter) && count($filter)!=0){						
       				$this->db->where($filter); #apply filter 					
       			}						
       		}							
									
       		#or fitler ----------------------------------------------							
       		if($or_filter){							
       			#check if or_filter is an array						
       			if(is_array($or_filter) && count($or_filter)!=0){						
       				$this->db->or_where($or_filter); ///apply or filter					
       			}						
       		}							
									
       		#check if pagination joining is not false ----------------------------------------------							
       		if($join){							
									
       			#check if the join variable is an array						
       			if(is_array($join) && count($join)!=0){						
       				#loop through the array					
       				foreach ($join as $joining_fields) {					
       					#commence joining				
       					$this->db->join($joining_fields["table"], $joining_fields["condition"],"LEFT");				
       				}					
       			}						
									
       		}							
									
       		#order query ----------------------------------------------							
       		#check if the order array is present							
       		if($order){							
       			$this->db->order_by($order["column_name"],$order["order"]);						
       		}else{							
                if(@$_GET['order_by']!==null):									
                      $order_by = $_GET['order_by'];									
                      $order_style = $this->data['order_style'];									
                      $this->db->order_by($order_by,$order_style);									
                endif;									
	        }								
									
       		#group query ----------------------------------------------							
       		#check if the group array is present 							
       		if($group){							
       			$this->db->group_by($group);						
       		}							
									
                #check if wherein exsits									
                if($wherein):									
                        if(is_array($wherein)):									
                              if(count($wherein)):									
                                    $this->db->where_in($wherein['column_name'],$wherein['column_value']);									
                              endif;									
                        endif;									
                endif;									
									
       		#like filter ----------------------------------------------							
       		if($like_filter){							
       			$this->db->like($like_filter);						
       		}							
	          								
	          #check if a filter query exists								
	        if($custom):								
	            $arr[$custom]=null;								
	            $this->db->where($arr);								
	        endif;								
									
       		#select ----------------------------------------------							
       		$this->db->select($select);							
									
       		$content = $this->db->get($table, $per_page, $start)->result();							
       		      							
       		#return array ----------------------------------------------							
       		return array(							
						error      =>false, 			
						msg        =>$content, 			
						per_page   =>$per_page,			
						start      => $start,			
						total_rows =>$total, 			
						page_links =>$page_links			
       				);					
       		/*							
       		* end of display phase 							
       		*/							
       									
       	}else{								
       		return array("error"=>true, "msg"=>"table_not_defined");							
       	}								
    }									
}