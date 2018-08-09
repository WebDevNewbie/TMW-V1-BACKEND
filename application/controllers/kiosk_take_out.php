<?php defined('BASEPATH') OR exit('No direct script access allowed');
	session_start();
	class Kiosk_take_out extends Admin_Controller {
		public function __construct() {
	      parent::__construct();
			
	      	$this->load->model('_backend/category/category');
	      	$this->load->model('_backend/percent_discount');
	      	$this->load->model('_backend/buy_take_discount');
	      	$this->load->model('_backend/flat_discount');
	      	$this->load->model('_backend/order');
	      	$this->perPage = 8;

	    }

	    public function index()
	    {
	    	if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$member = $this->session->userdata('member');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );

				$session_order = $this->session->userdata('order_items');
				// dump_exit($session_order[3]);
				// unset($session_order[5]);
				$alert = $this->session->flashdata('alerts');
				$order_alert = $this->session->flashdata('order_alert');
				// $counts = $this->session->userdata('count');

				// dump_exit($session_order);
				if($session_order)
				{
					foreach ($session_order as $row) {
						if(count($row) > 1)
						{
							$count = $row['count'];
						}
					}
				}
				else
				{
					$count = 0;
				}
				

	    		// dump_exit($count);
	    		if(@$count > 0)
	    		{
	    			$order_data = $session_order;
	    		}
	    		else
	    		{
	    			$order_data = array();
	    		}

				$category = $this->category->getCategories();

				$this->load->view('layouts/header_user',array(
					'usertype' => 'user'
					));
				$this->load->view('user_take_out/home', array(
					'data'			=> $data,
					'subview'		=> $this->data,
					'category'		=> $category,
					'order_data'	=> $order_data,
					'count'			=> @$count,
					'subtotal'		=> 0,
					'note'			=> @$alert['note'],
					'order_alert'	=> @$order_alert['note']
					));
			}else{
				redirect('home','refresh');
			}
	    }

	    public function select_category($cat_id)
	    {
	    	if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );

				$session_order = $this->session->userdata('order_items');
				// dump_exit($session_order);
				if($session_order)
				{
					foreach ($session_order as $row) {
						if(count($row) > 1)
						{
							$count = $row['count'];
						}
					}
				}
				

	    		// dump_exit($count);
	    		if(@$count > 0)
	    		{
	    			$order_data = $session_order;
	    		}
	    		else
	    		{
	    			$order_data = array();
	    		}

				// $category = $this->category->getCategories(array('limit'=>$this->perPage));

				$item = $this->category->getSubMenu($cat_id);
				$category_name = $this->category->getCategoryName($cat_id);

				$subcat = $this->category->getSubCat($cat_id);
				if(@$subcat[0]->category_id === NULL)
				{
					$sub_id = 0;
				}
				else
				{
					$sub_id = $subcat[0]->category_id;
				}

				if(count($subcat) > 0)
				{
					$this->load->view('layouts/header_user',array(
						'usertype' => 'user'
						));
					$this->load->view('user_take_out/subcat', array(
						'data'			=> $data,
						'subview'		=> $this->data,
						'category'		=> $subcat,
						'cat_id'		=> $subcat[0]->category_id,
						'cat_name'		=> $category_name,
						'order_data'	=> $order_data,
						'count'			=> @$count,
						'subtotal'		=> 0
						));
				}
				elseif (count($item) > 0) 
				{
					
					$this->load->view('layouts/header_user',array(
						'usertype' => 'user'
						));
					$this->load->view('user_take_out/select_item', array(
						'data'			=> $data,
						'subview'		=> $this->data,
						'category'		=> $item,
						'cat_id'		=> $cat_id,
						'cat_name'		=> $category_name,
						'order_data'	=> $order_data,
						'count'			=> @$count,
						'subtotal'		=> 0
						));
				}
				else
				{
					$this->load->view('layouts/header_user',array(
						'usertype' => 'user'
						));
					$this->load->view('user_take_out/select_item', array(
						'data'			=> $data,
						'subview'		=> $this->data,
						'category'		=> $item,
						'cat_id'		=> $cat_id,
						'cat_name'		=> $category_name,
						'order_data'	=> $order_data,
						'count'			=> @$count,
						'subtotal'		=> 0	
						));
				}

				
			}else{
				redirect('home','refresh');
			}
	    }

	    public function select_item($id)
	    {
	    	if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );

				$session_order = $this->session->userdata('order_items');
				if($session_order)
				{
					foreach ($session_order as $row) {
						if(count($row) > 1)
						{
							$count = $row['count'];
						}
					}
				}
				

	    		// dump_exit($count);
	    		if(@$count > 0)
	    		{
	    			$order_data = $session_order;
	    		}
	    		else
	    		{
	    			$order_data = array();
	    		}

				$ids = explode('a',$id);
				$subcat_id = $ids[0];
				$cat_id = $ids[1];

				$sub_cat = $this->category->getSubCatItem($subcat_id);
				$subcategory_name = $this->category->getSubCategoryName($subcat_id);

				// dump_exit($subcategory_name);

				$this->load->view('layouts/header_user',array(
					'usertype' => 'user'
					));
				$this->load->view('user_take_out/select_item', array(
					'data'			=> $data,
					'subview'		=> $this->data,
					'category'		=> $sub_cat,
					'cat_id'		=> $cat_id,
					'subcat_id'		=> $subcat_id,
					'subcat_name'	=> $subcategory_name,
					'order_data'	=> $order_data,
					'count'			=> @$count,
					'subtotal'		=> 0	
					));
				
			}else{
				redirect('home','refresh');
			}
	    }

	    public function order_items()
	    {
	    	$session_order = $this->session->userdata('order_items');
	    	// dump_exit($session_order);

	    	$item_id = $this->input->post('item_id');
	    	$item_price = $this->input->post('item_price');
	    	$item_price1 = $this->input->post('item_price');
	    	$item_qty = $this->input->post('item_qty');
	    	$item_qty1 = $this->input->post('item_qty');
	    	$url = $this->input->post('url');
	    	$val = "";

	    	$flat_discount = $this->flat_discount->getFlatDiscount($item_id);
	    	$counts = "";
	    	if($session_order)
			{
				foreach ($session_order as $row) 
				{
					if(count($row) > 1)
					{
						$count = $row['count'];
						$tmp_count = 0;
						if($row['item_id'] === $item_id)
						{
							$counts += $row['item_qty'];
							$tot_qty = $row['item_qty']+$item_qty;
							$res = $tot_qty - @$flat_discount[0]->limited_to;
							
							if(@$flat_discount[0]->limited_to === '0')
							{
								$item_id;
								$item_price = @$flat_discount[0]->price;
								$item_qty = $row['item_qty'] + $item_qty;
								$taken = true;
								$cnt = $row['count']-1;
		    					unset($session_order[$cnt]);
							} 
							elseif($row['item_qty'] === @$flat_discount[0]->limited_to && @$flat_discount)
							{
								$taken = true;
								$flat_discount[0]->price = $item_price1;
							}
							elseif($res === 0)
							{
								$item_id;
								$item_price = $flat_discount[0]->price;
								$item_qty = $row['item_qty'] + $item_qty;
								$taken = true;
								$cnt = $row['count']-1;
		    					unset($session_order[$cnt]);
							}
							elseif($res > 0)
							{
								$item_id;
								$item_price = $item_price1;
								$item_qty = $row['item_qty'] + $item_qty;
								$taken = true;
								$cnt = $row['count']-1;
		    					unset($session_order[$cnt]);
							}
							elseif($res < 0)
							{
								$item_id;
								$item_price = $item_price1;
								$item_qty = $tot_qty;
								$taken = true;
								$cnt = $row['count']-1;
		    					unset($session_order[$cnt]);
							}
							else
							{
								if($row['item_price'] === '0' || $item_price === '0')
								{
									$item_id;
									$item_price;
									$item_qty;
									$cnt = $row['count']-1;
								}
								else
								{
									$item_id;
									$item_price;
									$item_qty = $row['item_qty'] + $item_qty;
									$cnt = $row['count']-1;
		    						unset($session_order[$cnt]);
								}
							}
						}
						else
						{
				    		unset($session_order['item_id']);
				    		unset($session_order['item_price']);
				    		unset($session_order['item_qty']);
				    		unset($session_order['count']);
				    		$taken = false;
						}
					}
				}
			}
			else
			{
				$count = 0;
			}

			if(@$taken !== true)
			{
				$flat_discount = $this->flat_discount->getFlatDiscount($item_id);
		    	// dump_exit($count);
		    	if(count($flat_discount) > 0)
		    	{
		    		$res = $item_qty - @$flat_discount[0]->limited_to;
		    		if(@$flat_discount[0]->limited_to === '0')
					{
						$item_id;
						$item_price = @$flat_discount[0]->price;
						$item_qty;
					} 
		    		elseif($res > 0)
					{
						$item_id;
						$item_price = @$flat_discount[0]->price;
						$item_qty = @$flat_discount[0]->limited_to;

						$data = $item_id.'-'.$item_qty.'-'.$item_price;
						$addons_discount = $this->add_free_items($data);

						$item_id;
						$item_qty = $res;
						$item_price = $item_price1;
						$count = @$count+1;

					}
		    		elseif($res === 0)
		    		{
		    			$item_id;
						$item_price = @$flat_discount[0]->price;
						$item_qty = @$flat_discount[0]->limited_to;
		    		}
		    		elseif($res < 0)
		    		{
		    			$item_id;
						$item_price = $item_price1;
						$item_qty = $item_qty1;
		    		}
		    	}
			}
			

	    	$sess_array = array(
				         'item_id' 		=> $item_id,
				         'item_price' 	=> $item_price,
				         'item_qty' 	=> $item_qty,
				         'count'		=> @$count+1
				       );
	    	// dump_exit($sess_array);
	    	if(@$addons_discount)
	    	{
	    		$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);
	    		array_push($addons_discount,$sess_array);
	    		$this->session->set_userdata('order_items' , $addons_discount);
	    		if(count($get_buy_take_discount) > 0)
	    		{
    				$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
    				$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
    				
					$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
    				$this->add_free_items($data);
    				
	    		}
	    	}
	    	elseif($session_order)
	    	{
	    		// if(@$cnt !== NULL)
	    		// {
	    			$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);
	    			// dump_exit($get_buy_take_discount);
	    			array_push($session_order,$sess_array);
		    		$this->session->set_userdata('order_items' , $session_order);
		    		if(count($get_buy_take_discount) > 0)
		    		{
	    				$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
	    				$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
	    				
    					$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
	    				$this->add_free_items($data);
	    				
		    		}
	    		// }
	    		// else
	    		// {
	    		// 	$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);
	    		// 	// dump_exit($session_order);
		    	// 	array_push($session_order,$sess_array);
		    	// 	$this->session->set_userdata('order_items' , $session_order);
		    	// 	if(count($get_buy_take_discount) > 0)
		    	// 	{
	    		// 		$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
	    		// 		$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
	    				
    			// 		$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
	    		// 		$this->add_free_items($data);
	    				
		    	// 	}
	    		// }
	    		// dump_exit($session_order);
	    	}
	    	else
	    	{
	    		$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);
	    		$session_order = array(
				         'item_id' 		=> $item_id,
				         'item_price' 	=> $item_price,
				         'item_qty' 	=> $item_qty,
				         'count'		=> @$count+1
				       );
	    		array_push($session_order,$sess_array);
	    		$this->session->set_userdata('order_items' , $session_order);
	    		if(count($get_buy_take_discount) > 0)
	    		{
    				$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
    				$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
    				
					$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
    				$this->add_free_items($data);
    				
	    		}
	    	}

	    	// $this->session->set_userdata('count' , $count);

	    	redirect($url,'refresh');
	    }

	    public function removeItem($count)
	    {
	    	$session_order = $this->session->userdata('order_items');
	    	// dump_exit($session_order);
	    	$get_buy_take_discount = $this->buy_take_discount->getDiscount(@$session_order[$count-1]['item_id']);
	    	// dump_exit($session_order);
	    	if($count === '1')
	    	{

		    	if(@$get_buy_take_discount[0]->item_id === @$session_order[$count-1]['item_id'])
	    		{
	    			unset($session_order[$count]);
		    		$this->session->set_userdata('order_items' , $session_order);
	    		}
	    		unset($session_order[$count-1]);
	    		unset($session_order['item_id']);
	    		unset($session_order['item_price']);
	    		unset($session_order['item_qty']);
	    		unset($session_order['count']);

	    		$this->session->set_userdata('order_items' , $session_order);
	    	}
	    	else
	    	{

		    	if(@$get_buy_take_discount[0]->item_id === @$session_order[$count-1]['item_id'])
	    		{
	    			unset($session_order[$count]);
		    		$this->session->set_userdata('order_items' , $session_order);
	    		}
	    		unset($session_order[$count-1]);
	    		$this->session->set_userdata('order_items' , $session_order);
	    	}
	    	// 
	    	// $this->session->set_userdata('order_items' , $session_order);

	    	redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	    public function order_items1()
	    {
	    	$val = $this->input->post('values');
	    	$data = explode('/',$val);
	    	// dump_exit($val);

	    	for ($i=0; $i < count($data)-1; $i++) { 
	    		$this->add_items($data[$i]);
	    	}

	    	redirect($this->input->post('url1'),'refresh');
	    }

	    public function add_items($data)
	    {
	    	$session_order = $this->session->userdata('order_items');

	    	// dump_exit($session_order);

	    	$values = explode('-', $data);

	    	$id = $values[0];
	    	$qty = $values[1];
	    	$price = $values[2];

	    	$item_id = $id;
	    	$item_price = $price;
	    	$item_price1 = $price;
	    	$item_qty = $qty;
	    	$item_qty1 = $qty;

	    	$flat_discount = $this->flat_discount->getFlatDiscount($item_id);
	    	$counts = "";
	    	if($session_order)
			{
				foreach ($session_order as $row) 
				{
					if(count($row) > 1)
					{
						$count = $row['count'];
						if($row['item_id'] === $item_id)
						{
							$counts += $row['item_qty'];
							$tot_qty = $row['item_qty']+$item_qty;
							$res = $tot_qty - @$flat_discount[0]->limited_to;
							
							if(@$flat_discount[0]->limited_to === '0')
							{
								$item_id;
								$item_price = @$flat_discount[0]->price;
								$item_qty = $row['item_qty'] + $item_qty;
								$taken = true;
								$cnt = $row['count']-1;
		    					unset($session_order[$cnt]);
							} 
							elseif($row['item_qty'] === @$flat_discount[0]->limited_to && @$flat_discount)
							{
								$taken = true;
								$flat_discount[0]->price = $item_price1;
							}
							elseif($res === 0)
							{
								$item_id;
								$item_price = $flat_discount[0]->price;
								$item_qty = $row['item_qty'] + $item_qty;
								$taken = true;
								$cnt = $row['count']-1;
		    					unset($session_order[$cnt]);
							}
							elseif($res > 0)
							{
								$item_id;
								$item_price = $item_price1;
								$item_qty = $row['item_qty'] + $item_qty;
								$taken = true;
								$cnt = $row['count']-1;
		    					unset($session_order[$cnt]);
							}
							elseif($res < 0)
							{
								$item_id;
								$item_price = $item_price1;
								$item_qty = $tot_qty;
								$taken = true;
								$cnt = $row['count']-1;
		    					unset($session_order[$cnt]);
							}
							else
							{
								if($row['item_price'] === '0' || $item_price === '0')
								{
									$item_id;
									$item_price;
									$item_qty;
									$cnt = $row['count']-1;
								}
								else
								{
									$item_id;
									$item_price;
									$item_qty = $row['item_qty'] + $item_qty;
									$cnt = $row['count']-1;
		    						unset($session_order[$cnt]);
								}
							}
						}
						else
						{
				    		unset($session_order['item_id']);
				    		unset($session_order['item_price']);
				    		unset($session_order['item_qty']);
				    		unset($session_order['count']);
				    		$taken = false;
						}
					}
				}
			}
			else
			{
				$count = 0;
			}

			if(@$taken !== true)
			{
				$flat_discount = $this->flat_discount->getFlatDiscount($item_id);
		    	// dump_exit($count);
		    	if(count($flat_discount) > 0)
		    	{
		    		$res = $item_qty - @$flat_discount[0]->limited_to;
		    		if(@$flat_discount[0]->limited_to === '0')
					{
						$item_id;
						$item_price = @$flat_discount[0]->price;
						$item_qty;
					} 
		    		elseif($res > 0)
					{
						$item_id;
						$item_price = @$flat_discount[0]->price;
						$item_qty = @$flat_discount[0]->limited_to;

						$data = $item_id.'-'.$item_qty.'-'.$item_price;
						$addons_discount = $this->add_free_items($data);

						$item_id;
						$item_qty = $res;
						$item_price = $item_price1;
						$count = @$count + 1;

						
					}
		    		elseif($res === 0)
		    		{
		    			$item_id;
						$item_price = @$flat_discount[0]->price;
						$item_qty = @$flat_discount[0]->limited_to;
		    		}
		    		elseif($res < 0)
		    		{
		    			$item_id;
						$item_price = $item_price1;
						$item_qty = $item_qty1;
		    		}
		    	}
			}

    		$sess_array = array(
			         'item_id' 		=> $item_id,
			         'item_price' 	=> $item_price,
			         'item_qty' 	=> $item_qty,
			         'count'		=> @$count+1
			       );
    		$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);

	    	if(@$addons_discount)
	    	{
	    		$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);
	    		array_push($addons_discount,$sess_array);
	    		$this->session->set_userdata('order_items' , $addons_discount);
	    		if(count($get_buy_take_discount) > 0)
	    		{
    				$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
    				$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
    				
					$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
    				$this->add_free_items($data);
    				
	    		}
	    	}
	    	elseif($session_order)
	    	{
	    		if(@$cnt !== NULL)
	    		{
	    			$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);
	    			// dump_exit($get_buy_take_discount);
	    			array_push($session_order,$sess_array);
		    		$this->session->set_userdata('order_items' , $session_order);
		    		if(count($get_buy_take_discount) > 0)
		    		{
	    				$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
	    				$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
	    				
    					$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
	    				$this->add_free_items($data);
	    				
		    		}
	    		}
	    		else
	    		{
	    			$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);
	    			// dump_exit($session_order);
		    		array_push($session_order,$sess_array);
		    		$this->session->set_userdata('order_items' , $session_order);
		    		if(count($get_buy_take_discount) > 0)
		    		{
	    				$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
	    				$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
	    				
    					$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
	    				$this->add_free_items($data);
	    				
		    		}
	    		}
	    	}
	    	else
	    	{
	    		$session_order = array(
				         'item_id' 		=> $item_id,
				         'item_price' 	=> $item_price,
				         'item_qty' 	=> $item_qty,
				         'count'		=> @$count+1
				       );
	    		array_push($session_order,$sess_array);
	    		$this->session->set_userdata('order_items' , $session_order);
	    		if(count($get_buy_take_discount) > 0)
	    		{
    				$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
    				$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
    				
					$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
    				$this->add_free_items($data);
    				
	    		}
	    	}
	    }

	    public function edit_qty()
	    {

	    	$session_order = $this->session->userdata('order_items');
	    	// dump_exit($session_order);

	    	$item_id = $this->input->post('item_ids');
	    	$item_price = $this->input->post('item_prices');
	    	$item_price1 = $this->input->post('item_prices');
	    	$item_qty = $this->input->post('item_qtys');
	    	$url = $this->input->post('urls');
	    	$item_count = $this->input->post('count');

	    	$flat_discount = $this->flat_discount->getFlatDiscount($item_id);

	    	if($session_order)
			{
				foreach ($session_order as $row) {
					if(count($row) > 1)
					{
						$count = $row['count'];
						// dump_exit($row['item_id']);
						if((string)$row['item_id'] === (string)$item_id)
						{
							$tot_qty = $item_qty;
							$res = $tot_qty - @$flat_discount[0]->limited_to;
							// dump_exit($res);
							if(@$flat_discount)
							{
								if(@$flat_discount[0]->limited_to === '0')
								{
									$item_id;
									$item_price = @$flat_discount[0]->price;
									$item_qty;
								} 
								elseif($row['item_qty'] === @$flat_discount[0]->limited_to && @$flat_discount)
								{
									$taken = true;
									$flat_discount[0]->price = $item_price1;
								}
								elseif($res === 0)
								{
									$item_id;
									$item_price = $flat_discount[0]->price;
									$item_qty = $item_qty;
									$cnt = $row['count']-1;
    								unset($session_order[$cnt]);
								}
								elseif($res > 0)
								{
			    					$item_id;
									$item_price = @$flat_discount[0]->price;
									$item_qty = @$flat_discount[0]->limited_to;

									$data = $item_id.'-'.$item_qty.'-'.$item_price;
									$addons_discount = $this->add_free_items($data);

									$cnt = $row['count']-1;
									unset($addons_discount[$cnt]);

									$item_id;
									$item_qty = $res;
									$item_price = $item_price1;
									$count = @$count + 1;
								}
								elseif($res < 0)
								{
									$item_id;
									$item_price = $item_price1;
									$item_qty = $item_qty;
									$cnt = $row['count']-1;
    								unset($session_order[$cnt]);
								}
							}
							else
							{
								if($row['item_price'] !== '0' && $item_price !== '0')
								{
									$item_id;
									$item_price;
									$item_qty;
									$cnt = $row['count']-1;

    								unset($session_order[$cnt]);
								}
							}
						}
						else
						{
				    		$item_id;
							$item_price = $item_price1;
							$item_qty;
							$cnt = $item_count-1;

    						unset($session_order[$cnt]);
						}
					}
				}
			}
			else
			{
				$count = 0;
			}

			$sess_array = array(
			         'item_id' 		=> $item_id,
			         'item_price' 	=> $item_price,
			         'item_qty' 	=> $item_qty,
			         'count'		=> @$count+1
			       );

			// dump_exit($session_order);

			

			$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);

	    	if(@$addons_discount)
	    	{
	    		$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);
	    		array_push($addons_discount,$sess_array);
	    		$this->session->set_userdata('order_items' , $addons_discount);
	    		if(count($get_buy_take_discount) > 0)
	    		{
    				$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
    				$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
    				
					$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
    				$this->add_free_items($data);

    				
	    		}
	    	}
	    	elseif($session_order)
	    	{
    			array_push($session_order,$sess_array);
	    		$this->session->set_userdata('order_items' , $session_order);
	    		if(count($get_buy_take_discount) > 0)
	    		{
    				$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
    				$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
    				
					$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
					// dump_exit($data);
					$this->add_free_items($data);
	    		}
	    	}
	    	else
	    	{

	    		$get_buy_take_discount = $this->buy_take_discount->getDiscount($item_id);
	    		$session_order = array(
				         'item_id' 		=> $item_id,
				         'item_price' 	=> $item_price,
				         'item_qty' 	=> $item_qty,
				         'count'		=> @$count+1
				       );
	    		array_push($session_order,$sess_array);
	    		$this->session->set_userdata('order_items' , $session_order);
	    		if(count($get_buy_take_discount) > 0)
	    		{
    				$cnt_get_per_buy = $item_qty / $get_buy_take_discount[0]->buy_num;
    				$tot_free = floor($cnt_get_per_buy) * $get_buy_take_discount[0]->get_num;
    				
					$data = $get_buy_take_discount[0]->select_item_id.'-'.$tot_free.'-0';
    				$this->add_free_items($data);
    				
	    		}
	    		
	    	}
	    	redirect($url,'refresh');
	    }

	    public function order()
	    {
	    	$session_order = $this->session->userdata('order_items');
    		$member = $this->session->userdata('member');
			
			if($member)
			{
				$order_info_data = array(
						'table_no'			=> '0',
						'member_id'			=> $member['member_id'],
						'total_payment'		=> $this->input->post('total_order'),
						'cash'				=> '0',
						'dine_type'			=> '2',
						'bill_status'		=> '0',
						'cooking_status'	=> 'New Order',
						'status'			=> 'current',
						'order_date'		=> date('Y-m-d H:i:s'),
	    				'timestamp'			=> strtotime(date('Y-m-d H:i:s')),
						);
			}
			else
			{
				$order_info_data = array(
						'table_no'			=> '0',
						'member_id'			=> '0',
						'total_payment'		=> $this->input->post('total_order'),
						'cash'				=> '0',
						'dine_type'			=> '2',
						'bill_status'		=> '0',
						'cooking_status'	=> 'New Order',
						'status'			=> 'current',
						'order_date'		=> date('Y-m-d H:i:s'),
	    				'timestamp'			=> strtotime(date('Y-m-d H:i:s')),
						);
			}
    		
    		$add_order_info = $this->order->addCustomerOrderInfo($order_info_data);
    		foreach ($session_order as $row) 
    		{
				if(count($row) > 1)
				{
					if($row['item_qty'] > 0)
					{
						$data = array(
							'order_id'			=> $add_order_info,
							'item_id'			=> $row['item_id'],
							'item_qty'			=> $row['item_qty'],
							'item_price'		=> $row['item_price'],
							'cooking_status'	=> 'New Order',
							);

						$add_order = $this->order->addCustomerOrders($data);
					}
				}
			}

			if($add_order && $add_order_info)
			{
				$this->session->set_flashdata('order_alert', array('note' => 'Your order(s) are now on process ! Your Receipt number is '.$add_order_info));
				$this->session->unset_userdata('order_items');
				$this->session->unset_userdata('member');
				redirect('kiosk_take_out','refresh');
			}
			else
			{
				$this->session->set_flashdata('order_alert', array('note' => 'Error !'));
				redirect('kiosk_take_out','refresh');
			}
	    	
	    }

	    public function add_free_items($data)
	    {
	    	$session_order = $this->session->userdata('order_items');

	    	$values = explode('-', $data);

	    	$id = $values[0];
	    	$qty = $values[1];
	    	$price = $values[2];

	    	$item_id = $id;
	    	$item_price = $price;
	    	$item_qty = $qty;

	    	if($session_order)
			{
				foreach ($session_order as $row) {
					if(count($row) > 1)
					{
						$count = $row['count'];
						if($row['item_id'] === $item_id && $row['item_price'] === '0')
						{
							$item_id;
							$item_price;
							$item_qty = $item_qty;
							$cnt = $row['count']-1;

							unset($session_order[$cnt]);
						}
					}
				}
			}
			else
			{
				$count = 0;
			}

    		$sess_array = array(
			         'item_id' 		=> $item_id,
			         'item_price' 	=> $item_price,
			         'item_qty' 	=> $item_qty,
			         'count'		=> @$count+1
			       );

	    	if($session_order)
	    	{
	    		// if($item_qty > 0)
	    		// {
	    			array_push($session_order,$sess_array);
	    			$this->session->set_userdata('order_items' , $session_order);
	    		// }
    			
	    	}
	    	else
	    	{
	    		// if($item_qty > 0)
	    		// {
		    		$session_order = array(
					         'item_id' 		=> $item_id,
					         'item_price' 	=> $item_price,
					         'item_qty' 	=> $item_qty,
					         'count'		=> @$count+1
					       );
		    		array_push($session_order,$sess_array);
		    		$this->session->set_userdata('order_items' , $session_order);
		    	// }
	    	}
	    	return $session_order;
	    }
    

		// End Dashboard Class
	}