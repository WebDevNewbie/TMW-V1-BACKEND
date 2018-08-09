<?php defined('BASEPATH') OR exit('No direct script access allowed');
	session_start();
	class Payment extends Admin_Controller {
		public function __construct() {
	      	parent::__construct();
	      	header('Access-Control-Allow-Origin: *'); 
	      	$this->load->model('_backend/category/category');
		 	$this->load->model('_backend/percent_discount');
		 	$this->load->model('_backend/buy_take_discount');
	      	$this->load->model('_backend/flat_discount');
	      	$this->load->model('_backend/order');
		
	    }

	    public function index()
	    {
	    	if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$table_no = $this->db->query('SELECT * FROM table_settings');
				$alert = $this->session->flashdata('alert');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );

				$this->load->view('layouts/header_payment',array(
						'table_no' => @$table_no->result()
					));
				$this->load->view('admin/payment',array(
						'table_no' => @$table_no->result(),
						'note'		=> @$alert['note'],
					));
				// $this->load->view('layouts/list_new_orders');
			}else{
				redirect('home','refresh');
			}
	    }

	    public function table($table_no)
	    {
	    	if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$table_no = $this->db->query('SELECT * FROM table_settings');
				$order_info = $this->order->getTableOrder($this->uri->segment(3));
				$alert = $this->session->flashdata('alert');
				$all_category = $this->category->getAllCategory();

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );

				$this->load->view('layouts/header_payment',array(
						'table_no' => @$table_no->result()
					));
				$this->load->view('admin/table_order',array(
						'order_info'			=> $order_info,
						'note'					=> @$alert['note'],
						'all_category'			=> $all_category
					));
			}else{
				redirect('home','refresh');
			}
	    }

	    public function pay()
	    {
	    	$data = array(
	    		'cash' 				=> $this->input->post('cash'),
	    		'bill_status'		=> '1',
	    		'timestamp'			=> strtotime(date('Y-m-d H:i:s')),
	    		);

	    	$this->db->where('id', $this->input->post('order_id'));
			$this->db->update('customer_order_info', $data);

			$update_status = $this->order->update_status($this->input->post('order_id'));
			if(count($update_status) > 0)
			{
				$status = array(
	    			'status' 		=> 'done',
	    		);

	    		$this->db->where('id', $this->input->post('order_id'));
				$this->db->update('customer_order_info', $status);
				$this->session->set_flashdata('alert', array('note' => 'This order(s) are PAID.'));

				redirect('payment','refresh');
			}
			else
			{
				$this->session->set_flashdata('alert', array('note' => 'This order(s) are PAID.'));

				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}

			
	    }

	    public function getCookingStatus_admin()
	    {
	    	$table_no = $_GET['table_no'];

	    	$query = $this->db->query('SELECT * FROM customer_order_info WHERE table_no = '.$table_no);

			if(count($query->result()) > 0)
            {
	            foreach($query->result() as $row)
	            {
	                $date=date_create($row->order_date);
	                $query1 = $this->db->query('SELECT cooking_status FROM customer_order_info WHERE table_no ='.$table_no.' AND status = "current" AND '.date_format($date,"Y-m-d").' = '.date('Y-m-d') );
	            	$res = $query1->result();
	            	if($res)
	            	{
	            		$a = 'true';
	            	}
	            	else
	            	{
	            		$a = 'false';
	            	}
	            	
	            }
	        }
        	else
        	{
        		$a = 'false';
        	}
            if($a === 'true')
            {
                $stat = $res[0]->cooking_status;
            }
            else
            {
                $stat = 'Vacant Table';
            }

	    	if($stat === 'New Order')
	    	{
	    		echo '<p style="color:#000;background-color:#098be2; padding:5px;"><strong>Order Status: '.$stat.'</strong><p>';
	    	}
	    	elseif($stat === 'Vacant Table')
	    	{
	    		echo '<p style="color:black;background-color:white; padding:5px;"><strong>Order Status: '.$stat.'</strong><p>';
	    	}
	    	elseif($stat === 'Ready To Serve')
	    	{
	    		echo '<p style="color:#000;background-color:#94e000; padding:5px;"><strong>Order Status: On Serve</strong><p>';
	    	}
	    	elseif($stat === 'In Progress')
	    	{
	    		echo '<p style="color:black;background-color:#FFCC00; padding:5px;"><strong>Order Status: '.$stat.'</strong><p>';
	    	}
	    }

	    public function getCookingStatus_kitchen()
	    {
	    	$id = $_GET['id'];

	    	$query = $this->db->query('SELECT * FROM customer_order_info WHERE id = '.$id);

			if(count($query->result()) > 0)
            {
	            foreach($query->result() as $row)
	            {
	                $date=date_create($row->order_date);
	                $query1 = $this->db->query('SELECT cooking_status FROM customer_order_info WHERE id ='.$id.' AND status = "current" AND '.date_format($date,"Y-m-d").' = '.date('Y-m-d') );
	            	$res = $query1->result();
	            	if($res)
	            	{
	            		$a = 'true';
	            		echo json_encode($res);
	            	}
	            	else
	            	{
	            		$a = 'false';
	            	}
	            	
	            }
	        }
	    }

	    public function getOrders()
	    {
			$query = $this->db->query('SELECT * FROM customer_order_info WHERE status = "current" ');

			if(count($query->result()) > 0)
            {
	            foreach($query->result() as $row)
	            {
	                $date = date_create($row->order_date);
	                $query1 = $this->db->query('SELECT * FROM customer_order_info WHERE id = '.$row->id.' AND status = "current" AND '.strtotime($row->order_date).' >= '.strtotime(date('Y-m-d 00:00:00')) );
	            	$res1 = $query1->result();

	            	if(count($res1) > 0)
	            	{
	            		echo '<tr>';
		            	if($res1[0]->dine_type === '1')
			            {
			            	echo '<td>';
					    	echo '<p style="font-size:20px;font-weight: bold;">Table '.$res1[0]->table_no.'</p>';
					    	echo '</td>';
		            	}
		            	else
		            	{
		            		echo '<td>';
					    	echo '<p style="font-size:20px;font-weight: bold;">Receipt No. '.$res1[0]->id.'</p>';
					    	echo '</td>';
		            	}
		            	if($res1[0]->dine_type === '1')
			            {
			            	echo '<td>';
					    	echo '<p style="font-size:20px;font-weight: bold;">Dine In'.'</p>';
					    	echo '</td>';
		            	}
		            	else
		            	{
		            		echo '<td>';
					    	echo '<p style="font-size:20px;font-weight: bold;">Take Out'.'</p>';
					    	echo '</td>';
		            	}
		            	echo '<td>';
				    	echo '<p style="font-size:20px;font-weight: bold;">'.$res1[0]->cooking_status.'</p>';
				    	echo '</td>';
		            	echo '<td>';
				    	echo '<a href="'.base_url().'payment/table/'.$res1[0]->id.'" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-share-alt"></span> View Orders </a>';
				    	echo '</td>';
				    	echo '</tr>';
				    	$order = 'true';
	            	}
	            	else
	            	{	
				    	$order = 'false';
	            	}
	            	
	            }
	            if($order === 'false')
	            {
	            	echo '<tr>';
            		echo '<td>';
            		echo '<h5>No Order(s).</h5>';
            		echo '</td>';
			    	echo '</tr>';
	            }
	        }
	        else
	        {
	        	echo '<center><h2>No Orders.</h2></center>';
	        }

	    }
		public function change_status_done($id)
		{
			$update_info = array(
					'status'			=> 'Done',
					);
			$this->db->where('id', $id);
			$this->db->update('customer_order_info', $update_info); 
			redirect('payment','refresh');
		}

		public function timeline()
		{

			$query = $this->db->query('SELECT * FROM customer_order_info WHERE cooking_status = "On Serve" '. ' ORDER BY id DESC ');
			$item_name_all = '';

			if(count($query->result()) > 0)
            {
	            foreach($query->result() as $row)
	            {
	                $date = date_create($row->order_date);
	                $query1 = $this->db->query('SELECT * FROM customer_order_info WHERE id = '.$row->id.' AND cooking_status = "On Serve" AND '.strtotime($row->order_date).' >= '.strtotime(date('Y-m-d 00:00:00')) );
	            	$res1 = $query1->result();

	            	if(count($res1) > 0)
	            	{
	            		$query2 = $this->db->query('SELECT * FROM customer_orders WHERE order_id = '.$row->id.' LIMIT 3');
	            		$res2 = $query2->result();
	            	}
	            	

	            	if(count($res1) > 0)
	            	{
	            		if($res1[0]->cooking_status === 'On Serve')
	            		{
	            			$date=date_create($res1[0]->order_date);

							echo '<li>';
							echo '<i class="glyphicon glyphicon-ok" style="color:#fff;background:#5cb85c;"></i>';
							echo '<div class="timeline-item">';
							echo '<span class="time"><i class="glyphicon glyphicon-time"></i> '.date_format($date,"h:i A").'</span>';
							if($res1[0]->dine_type === '1')
							{
								echo '<h6 class="timeline-header" style="font-size:14px;">Table Number '.$res1[0]->table_no.'</h6>';
							}
							else
							{
								echo '<h6 class="timeline-header" style="font-size:14px;">Receipt Number '.$res1[0]->id.'</h6>';
							}

							foreach ($res2 as $key) {
								$item_name = $this->category->getItemName($key->item_id);
								$item_name_all = $item_name[0]->item_name.', '.$item_name_all;
							}

							echo '<div class="timeline-body">';
							echo $item_name_all.' ...';
							echo '</div>';

							echo '<div class="timeline-footer">';
							echo '<h5 class="label label-success" style="font-size:14px;">On Serve</h5>';
							echo '</div>';
							echo '</div>';
							echo '</li>';
							$item_name_all = '';
	            		}
	            	}
	            }
	        }
	        else
	        {
	        	echo '<center><h2>No Orders.</h2></center>';
	        }
		}

		public function discounted_subtotal()
		{
			$discount = $this->input->post('discount');
			$subtotal = $this->input->post('subtotal');

			$percent_to_decimal = $discount / 100;
			$subtot = $subtotal * $percent_to_decimal;
			$discounted_price = $subtotal - $subtot; 
			
			$data = array(
					'total_payment' => $discounted_price
				);
			$this->db->where('id', $this->input->post('order_id'));
			$this->db->update('customer_order_info', $data); 
			$this->session->set_flashdata('alert', array('note' => 'This order(s) are Discounted.'));

			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}

		public function free_item_modal()
		{
			$data = array(
					'order_id' 			=> $this->input->post('order_id'),
					'item_id'			=> $this->input->post('free_choose_item'),
					'item_qty'			=> $this->input->post('quantity'),
					'item_price'		=> '0',
					'cooking_status'	=> 'New Order'
				);

			$this->db->insert('customer_orders', $data);
			if($this->db->affected_rows() > 0)
			{	
				$this->session->set_flashdata('alert', array('note' => 'Free Item Added.'));
			}
			else
			{
				$this->session->set_flashdata('alert', array('note' => 'Free Item not Successfully Added.'));
			}

			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}

		// End Dashboard Class
	}