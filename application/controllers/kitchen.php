<?php defined('BASEPATH') OR exit('No direct script access allowed');
	session_start();
	class Kitchen extends Admin_Controller {
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

				$this->load->view('layouts/header_kitchen',array(
						'table_no' => @$table_no->result(),
						'usertype' => 'kitchen'
					));
				$this->load->view('kitchen/home',array(
						'table_no' => @$table_no->result(),
						'note'		=> @$alert['note'],
					));
			}else{
				redirect('home','refresh');
			}
	    }

	    public function getOrders()
	    {
	    	$query = $this->db->query('SELECT * FROM customer_order_info WHERE status = "current" AND cooking_status != "On Serve" '. ' ORDER BY timestamp ASC');
	    	$count = 0;
	    	$order = 'false';

			if(count($query->result()) > 0)
            {
	            foreach($query->result() as $row)
	            {
	                $date = date_create($row->order_date);
	                $query1 = $this->db->query('SELECT * FROM customer_order_info WHERE id = '.$row->id.' AND dine_type = 1 AND status = "current" AND '.strtotime($row->order_date).' >= '.strtotime(date('Y-m-d 00:00:00'))  );
	            	$dine_in = $query1->result();

	            	$query2 = $this->db->query('SELECT * FROM customer_order_info WHERE id = '.$row->id.' AND dine_type = 2 AND bill_status = 1 AND status = "current" AND '.strtotime($row->order_date).' >= '.strtotime(date('Y-m-d 00:00:00')) );
	            	$take_away = $query2->result();

	            	if(count($dine_in) > 0)
	            	{
		            	echo '<li>';
						echo '<div class="panel panel-default">';
						echo '<div class="panel-heading text-left">';

						if($dine_in[0]->dine_type === '1')
			            {
							echo '<p>Table Number : '.$dine_in[0]->table_no.'</p>';
							echo '<p>Dine Type : Dine In</p>';
						}
						else
						{
							echo '<p>Receipt No. : '.$dine_in[0]->id.'</p>';
							echo '<p>Dine Type : Take Away</p>';
						}
						echo '</div>';
						echo '<div class="panel-body" style="height:300px;overflow-y: scroll;">';

						$order_info = $this->order->getTableOrder($dine_in[0]->id);
						foreach($order_info as $dine)
						{	
							if($dine->item_qty > 0)
							{
								echo '<div class="row">';
								echo '<div class="col-md-6">';
								$item_name = $this->category->getItemName($dine->item_id);
								echo '<p style="text-overflow: ellipsis; overflow: hidden; white-space: none;">'.$dine->item_qty.' x '.$item_name[0]->item_name.'</p>';
								echo '</div>';
								if($dine->cooking_status === 'New Order')
								{
									echo '<div class="col-md-3">';		
									echo '<form action="'.base_url().'kitchen/change_status_progress/'.$dine->order_id.'a'.$dine->item_id.'" method="post" role="form-group">';
									echo '<button type="submit" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-time"></span></button>';
									echo '</form>';
									echo '</div>';
									echo '<div class="col-md-3">';	
									echo '<form action="'.base_url().'kitchen/change_status_ready/'.$dine->order_id.'a'.$dine->item_id.'" method="post" role="form-group">';
									echo '<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span></button>';
									echo '</form>';
									echo '</div>';
								}
								elseif($dine->cooking_status === 'In Progress')
								{
									echo '<div class="col-md-3">';		
									echo '<form action="'.base_url().'kitchen/change_status_progress/'.$dine->order_id.'a'.$dine->item_id.'" method="post" role="form-group">';
									echo '<button type="submit" class="btn btn-warning btn-block" disabled="true"><span class="glyphicon glyphicon-time"></span></button>';
									echo '</form>';
									echo '</div>';
									echo '<div class="col-md-3">';	
									echo '<form action="'.base_url().'kitchen/change_status_ready/'.$dine->order_id.'a'.$dine->item_id.'" method="post" role="form-group">';
									echo '<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span></button>';
									echo '</form>';
									echo '</div>';
								}
								else
								{
									echo 'Ready to serve.';
									echo '<br>';
								}		
								echo '</div>';
							}
						}
						echo '</div>';
						echo '</div>';
						echo '</li>';

	    				$order = 'true';
					}
					elseif(count($take_away) > 0)
	            	{
		            	echo '<li>';
						echo '<div class="panel panel-default">';
						echo '<div class="panel-heading text-left">';

						if($take_away[0]->dine_type === '1')
			            {
							echo '<p>Table Number : '.$take_away[0]->table_no.'</p>';
							echo '<p>Dine Type : Dine In</p>';
						}
						else
						{
							echo '<p>Receipt No. : '.$take_away[0]->id.'</p>';
							echo '<p>Dine Type : Take Away</p>';
						}
						echo '</div>';
						echo '<div class="panel-body" style="height:300px;overflow-y: scroll; ">';

						$order_info = $this->order->getTableOrder($take_away[0]->id);
						foreach($order_info as $take)
						{
							echo '<div class="row">';
							echo '<div class="col-md-6" >';
							$item_name = $this->category->getItemName($take->item_id);
							echo '<p style="text-overflow: ellipsis; overflow: hidden; white-space: none;">'.$take->item_qty.' x '.$item_name[0]->item_name.'</p>';
							echo '</div>';
							if($take->cooking_status === 'New Order')
							{
								echo '<div class="col-md-3">';		
								echo '<form action="'.base_url().'kitchen/change_status_progress/'.$take->order_id.'a'.$take->item_id.'" method="post" role="form-group">';
								echo '<button type="submit" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-time"></span></button>';
								echo '</form>';
								echo '</div>';
								echo '<div class="col-md-3">';	
								echo '<form action="'.base_url().'kitchen/change_status_ready/'.$take->order_id.'a'.$take->item_id.'" method="post" role="form-group">';
								echo '<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span></button>';
								echo '</form>';
								echo '</div>';
							}
							elseif($take->cooking_status === 'In Progress')
							{
								echo '<div class="col-md-3">';		
								echo '<form action="'.base_url().'kitchen/change_status_progress/'.$take->order_id.'a'.$take->item_id.'" method="post" role="form-group">';
								echo '<button type="submit" class="btn btn-warning btn-block" disabled="true"><span class="glyphicon glyphicon-time"></span></button>';
								echo '</form>';
								echo '</div>';
								echo '<div class="col-md-3">';	
								echo '<form action="'.base_url().'kitchen/change_status_ready/'.$take->order_id.'a'.$take->item_id.'" method="post" role="form-group">';
								echo '<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span></button>';
								echo '</form>';
								echo '</div>';
							}
							else
							{
								echo 'Ready to serve.';
								echo '<br>';
							}		
							echo '</div>';
						}
						echo '</div>';
						echo '</div>';
						echo '</li>';

	    				$order = 'true';
					}
	            	else
	            	{
				    	$order = 'false';
	            	}
	            	
	            }
	        }
	        else
	        {
	        	echo '<center><h1 style="color:white">No Orders.</h1></center>';
	        }
			
	    }

	    public function getOrderById()
	    {
	    	$id = $_GET['id'];
	    	$count = 0;

	    	$order_info = $this->order->getTableOrder($id);
			
			foreach ($order_info as $row) {
				echo '<li class="list-group-item">';
				echo '<div class="row " >';
				echo '<div class="col-md-12">';
				echo '<div class="col-md-4 col-sm-4 col-xs-4">';
				echo '<span>';
					$flat_discount = $this->flat_discount->getFlatDiscount($row->item_id);
					$item_name = $this->category->getItemName($row->item_id);
				echo $item_name[0]->item_name;
				echo '</span>';
				echo '</div>';
				echo '<div class="col-md-4 col-sm-4 col-xs-4">';
				echo '<span>';
				echo $row->item_qty;
				echo '</span>';
				echo '</div>';
				echo '<div class="col-md-4 col-sm-4 col-xs-4">';
				echo '<div class="row">';
				if($row->cooking_status === 'New Order')
				{
					echo '<div class="col-md-6 col-sm-6 col-xs-6">';
					echo '<form action="'.base_url().'kitchen/change_status_progress/'.$row->order_id.'a'.$row->item_id.'" method="post" role="form-group">';
					echo '<button type="submit" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-time"></span></button>';
					echo '</form>';
					echo '</div>';
					echo '<div class="col-md-6 col-sm-6 col-xs-6">';
					echo '<form action="'.base_url().'kitchen/change_status_ready/'.$row->order_id.'a'.$row->item_id.'" method="post" role="form-group">';
					echo '<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span></button>';
					echo '</form>';
					echo '</div>';
				}
				elseif($row->cooking_status === 'In Progress')
				{
					echo '<div class="col-md-6 col-sm-6 col-xs-6">';
					echo '<form action="'.base_url().'kitchen/change_status_progress/'.$row->order_id.'a'.$row->item_id.'" method="post" role="form-group">';
					echo '<button type="submit" class="btn btn-warning btn-block" disabled="true"><span class="glyphicon glyphicon-time"></span></button>';
					echo '</form>';
					echo '</div>';
					echo '<div class="col-md-6 col-sm-6 col-xs-6">';
					echo '<form action="'.base_url().'kitchen/change_status_ready/'.$row->order_id.'a'.$row->item_id.'" method="post" role="form-group">';
					echo '<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span></button>';
					echo '</form>';
					echo '</div>';
				}
				else
				{
					echo 'This item is ready to serve.';
				}
				echo '</div>';
				echo '</div>';
				echo '</li>';
				if($row->cooking_status === 'Ready to Serve')
				{
					$count++;
				}

			}
	    }

	    public function change_status_progress($id)
	    {
	    	$ids = explode('a', $id);
	    	$order_id = $ids[0];
	    	$item_id = $ids[1];
			$update_info = array(
					'cooking_status'	=> 'In Progress',
					);
			$this->db->where('order_id', $order_id);
			$this->db->where('item_id', $item_id);
			$this->db->update('customer_orders', $update_info); 

			$query = $this->db->query('SELECT * FROM  customer_orders WHERE order_id = '.$order_id.' AND cooking_status = "In Progress"');
			$result = $query->result();

			$query1 = $this->db->query('SELECT * FROM  customer_orders WHERE order_id = '.$order_id);
			$result1 = $query1->result(); 


			if(count($result) <= count($result1))
			{
				$update_status = array(
					'cooking_status'	=> 'In Progress',
					);
				$this->db->where('id', $order_id);
				$add_order = $this->db->update('customer_order_info', $update_status);
			}

			redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	    public function change_status_ready($id)
	    {

	    	$ids = explode('a', $id);
	    	$order_id = $ids[0];
	    	$item_id = $ids[1];

			$update_info = array(
					'cooking_status'	=> 'Ready to Serve',
					);
			$this->db->where('order_id', $order_id);
			$this->db->where('item_id', $item_id);
			$this->db->update('customer_orders', $update_info);

			$query = $this->db->query('SELECT * FROM  customer_orders WHERE order_id = '.$order_id.' AND cooking_status = "Ready to Serve"');
			$result = $query->result(); 

			$query1 = $this->db->query('SELECT * FROM  customer_orders WHERE order_id = '.$order_id);
			$result1 = $query1->result(); 

			if(count($result) === count($result1))
			{
				$update_cooking_status = array(
					'cooking_status'	=> 'On Serve',
					);
				$this->db->where('id', $order_id);
				$add_order = $this->db->update('customer_order_info', $update_cooking_status);

				$update_status = $this->order->update_status($order_id);
				if(count($update_status) > 0)
				{
					$status = array(
		    			'status' 		=> 'done',
		    		);

		    		$this->db->where('id', $order_id);
					$this->db->update('customer_order_info', $status);
				}
			}
			if(count($result) < count($result1))
			{
				$update_status = array(
					'cooking_status'	=> 'In Progress',
					);
				$this->db->where('id', $order_id);
				$add_order = $this->db->update('customer_order_info', $update_status);
			}

			redirect($_SERVER['HTTP_REFERER'],'refresh');
	    }

	    public function table($table_no)
	    {
	    	if($this->session->userdata('logged_in'))
   			{
				$session_data = $this->session->userdata('logged_in');
				$table_no = $this->db->query('SELECT * FROM table_settings');
				$order_info = $this->order->getTableOrder($this->uri->segment(3));
				$alert = $this->session->flashdata('alert');

				$data = array(
			      'admin_id'		=> $session_data['admin_id'],
			      'username'		=> $session_data['username'],
			      'password'      	=> $session_data['password'],
			      );

				$this->load->view('layouts/header_payment',array(
						'table_no' => @$table_no->result()
					));
				$this->load->view('admin/table_order',array(
						'order_info'	=> $order_info,
						'note'		=> @$alert['note'],
					));
			}else{
				redirect('home','refresh');
			}
	    }

		// End Dashboard Class
	}