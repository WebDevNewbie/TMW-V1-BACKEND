			<ol class="breadcrumb" style="position:fixed;width:100%">
			  	<li><a href="<?php echo base_url().'kiosk_take_out';?>">Menu Category</a></li>
			  	<?php if($this->uri->segment(2) !== 'select_category') { ?>
			  		<li><a onclick="goBack()">Sub Category</a></li>
			  		<?php } ?>
			  	<li class="active">Select Item</li>
			</ol>
			<div class="row ">
				<div class="col-md-5 col-sm-5" id="thiSide">
					<div class="row">
						<div class="panel panel-success" style="z-index:9999;position:fixed;height:100%;width:41.66666667%; margin-top:50px;padding: 10px;background-color: #777777;">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-3 col-sm-3 col-xs-4">
							      			<span>
							        			Name
							      			</span>
								    	</div>
								    	<div class="col-md-3 col-sm-3 col-xs-4">
							      			<span>
							        			Qty
							      			</span>
								    	</div>
								    	<div class="col-md-3 col-sm-3 col-xs-4">
							      			<span>
							        			Price
							      			</span>
								    	</div>
								    	<div class="col-md-3 col-sm-3 col-xs-4">
							      			<span>
							        			Action
							      			</span>
								    	</div>
								    </div>
								</div>
							</div>
							
							<?php if (count($order_data) != 0) : ?>
								<ul class="list-group" style="height:47%;overflow-y: scroll;">
									<?php 
										foreach ($order_data as $row) {
											if(count($row) > 1)
											{ ?>
								    			<li class="list-group-item">
													<div class="row " >
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-3">
												      			<span>
												        			<?php 
												        				$this->load->model('_backend/category/category');
		      															$this->load->model('_backend/flat_discount');


												        				$flat_discount = $this->flat_discount->getFlatDiscount($row['item_id']);

												        				$item_name = $this->category->getItemName($row['item_id']);
												        				echo $item_name[0]->item_name;
												        			?>
												      			</span>
													    	</div>
													    	<div class="col-md-3 col-sm-3 col-xs-3">
												      			<span>
												        			<?php echo $row['item_qty']; ?>
												      			</span>
													    	</div>
													    	<div class="col-md-3 col-sm-3 col-xs-3">
												      			<span>
												        			<?php 
												        				$this->load->model('_backend/percent_discount');

												        				$discount = $this->percent_discount->getItemDiscount($row['item_id']);
												        				if(count($discount) > 0)
												        				{
												        					$percent_discount = $discount[0]->discount_price/100;
													        				$subtot = $row['item_price'] * $row['item_qty'];
													        				$discounted_subtot = $subtot * $percent_discount;
													        				$final_discount = $subtot - $discounted_subtot;

													        			}
													        			else
													        			{
													        				$final_discount = $row['item_price']*$row['item_qty'];
													        			}
												        				

												        				if($row['item_price'] !== '0')
													        			{
													        				echo '$'.number_format((float)$final_discount, 2, '.', '');
													        			}
													        			else
													        			{
													        				echo 'For Free.';
													        			}

												        				$subtotal += $final_discount;
												        			?>

												      			</span>
													    	</div>
													    	<div class="col-md-3 col-sm-3 col-xs-3 action-btn">
																<span>
																	<?php if($row['item_price'] === @$flat_discount[0]->price) 
																		 { if(@$flat_discount[0]->limited_to === '0'){ ?>
													        				<a href="#" data-toggle="modal" data-target="#editqty_modal<?php echo $row['item_id']; ?><?php echo $row['count']; ?>" class="btn btn-md btn-primary">
														        				<span class="glyphicon glyphicon-pencil"></span>
														      				</a>
														      		<?php } ?>
													      			<?php }elseif($row['item_price'] !== '0'){ ?>
																		<a href="#" data-toggle="modal" data-target="#editqty_modal<?php echo $row['item_id']; ?><?php echo $row['count']; ?>" class="btn btn-md btn-primary">
													        				<span class="glyphicon glyphicon-pencil"></span>
													      				</a>
													      			<?php } ?>
												      			</span>
																<span>
																	<?php if($row['item_price'] !== '0') { ?>
													      				<a href="<?php echo base_url().'kiosk_take_out/removeItem/'.$row['count'] ; ?>" class="btn btn-md btn-danger">
													        				<span class="glyphicon glyphicon-remove"></span>
													      				</a>
													      			<?php } ?>
												      			</span>
													    	</div>
													    </div>
													</div><br>

													<!-- MODAL -->
													<?php if($row['item_price'] !== '0') { ?>
										    			<div id="editqty_modal<?php echo $row['item_id']; ?><?php echo $row['count']; ?>" class="modal fade" role="dialog">
															<div class="modal-dialog modal-sm">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="modal-title">Edit Quantity</h4>
																	</div>
																	<div class="modal-body">
																		<form action="<?php echo base_url().'kiosk_take_out/edit_qty'; ?>" method="post" class="form-group">
																			<div class="modal-body">
																				<div class="form-group">
																					<p class="text-center">Quantity</p>
																						<div class="input-group text-center">
																							<!-- <div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div> -->
																							<!-- <input type="number" class="form-control field" name="item_qty" value="<?php echo $row['item_qty']; ?>" required> -->
																							<div class="input-group">
																						      	<div class="input-group-btn">
																									<a href="javascript:void(0)" onClick="edit_minus(<?php echo $row['item_id'];?><?php echo $row['count']; ?>)" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-minus"></span></a>
																								</div>
																									<input type="text" value="<?php echo $row['item_qty']; ?>" class="form-control input-lg" id="order_nums<?php echo $row['item_id'];?><?php echo $row['count']; ?>" name="item_qtys" readonly>
																						      	<div class="input-group-btn">
																									<a href="javascript:void(0)" onClick="edit_add(<?php echo $row['item_id'];?><?php echo $row['count']; ?>)" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span></a>
																								</div>
																							</div>
																							<input type="hidden" value="<?php echo current_url(); ?>" name="urls" id="url" >
																		      				<input type="hidden" value="<?php echo $row['item_id']; ?>" id="item_id<?php echo $row['item_id']; ?>" name="item_ids" >
																		      				<input type="hidden" value="<?php echo $row['item_price']; ?>" id="item_price<?php echo $row['item_price'];?>" name="item_prices" >
																		      				<input type="hidden" value="<?php echo $row['count']; ?>" id="item_count<?php echo $row['count'];?>" name="count" >
																						</div>
																				</div>
																				<button type="submit" id="menutab" class="btn btn-block btn-success btn-lg">Update</button>
																			</div>		
																		</form>
																	</div>
																</div>
															</div>
														</div>
													<?php } ?>
								    			</li>
										<?php
											}	
										}
										?>
								</ul>
							<?php endif; ?>
				  			<div class="panel-body" >
								<?php if (count($order_data) != 0) : ?>
									<div class="row">
										<div class="col-md-10 col-sm-6 col-xs-8">
											<h3 style="color:white;">Total Payment : </h3>
										</div>
										<div class="col-md-2 col-sm-6 col-xs-4">
											<h3 style="float:right;color:white;"><?php echo '$'.number_format((float)$subtotal, 2, '.', ''); ?></h3>
										</div>
									</div>

									<form action="<?php echo base_url().'kiosk_take_out/order'; ?>" method="post">
										<input type="hidden" value="" id="table_no" name="table_no">
										<input type="hidden" value="" id="dine_take" name="dine_take">
										<input type="hidden" value="<?php echo number_format((float)$subtotal, 2, '.', ''); ?>" name="total_order">
										<center><button type="submit" class="btn btn-success btn-lg">Order Now</button></center>
									</form>

								<?php endif; ?>
								<?php if (count($order_data) == 0) : ?>
									<div class="row">
										<div class="col-md-12">
											<center><h3 style="color:white;">No order</h3></center>
										</div>
									</div>
								<?php endif; ?>
				  			</div>
						</div>
					</div>
				</div>
				<div class="col-md-7 col-sm-7" >
					<div class="panel panel-success" style="height:100%;position:fixed;margin-right:10px;margin-top:50px">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-4 col-sm-4" ></div>
								<div class="text-center col-md-4 col-sm-4" >
								<h5>
									<p style="color:white;font-size:20px;font-weight: bold;">
										<?php 
										if(@$subcat_name !== NULL)
										{
											echo $subcat_name[0]->subcat_name;
										}
										else
										{
											echo $cat_name[0]->category_name;
										}
											
										?>
									</p>
								</h5>
								</div>
								<div class="col-md-4 col-sm-4" >
									<?php if(count($category) > 0) { ?>
											<div class="row">
													<div class=" addAll" style="margin-right:50px;margin-top:10px;float:right;">
														<form action="<?php echo base_url().'kiosk_take_out/order_items1' ; ?>" method="post">
															<input type="hidden" value="<?php echo current_url(); ?>" id="url" name="url1">
															<input type="hidden" value="" id="values"  name="values">
															<button type="submit" onclick="qty()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Add Dishes</button>
														</form>
													</div>
											</div>
									<?php } ?>
								</div>
							</div>
						</div>
			  			<div class="panel-body"  style="overflow-y:auto;height:90%; padding-bottom:230px;margin-left:5px;margin-right:5px;">
							<?php if(count($category) > 0) { ?>
				    			<?php foreach ($category as $row) : ?>
			    					<?php 
									 	$this->load->model('_backend/percent_discount');
									 	$this->load->model('_backend/buy_take_discount');
								      	$this->load->model('_backend/flat_discount');

			    						$get_percent_discount = $this->percent_discount->getItemDiscount($row->id);
										$get_buy_take_discount = $this->buy_take_discount->getDiscount($row->id);
										$get_flat_discount = $this->flat_discount->getFlatDiscount($row->id);
			    					?>
									
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 itemSelect">
											<p class="text-center">Quantity</p>
											<div class="input-group">
										      	<div class="input-group-btn">
													<button onClick="minus(<?php echo $row->id;?>)" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-minus"></span></button>
												</div>
													<input type="text" value="0" class="form-control input-lg" id="order_num<?php echo $row->id;?>" name="order_num" readonly>
										      	<div class="input-group-btn">
													<button onClick="add(<?php echo $row->id;?>)" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span></button>
												</div>
											</div>
											<?php if(count($get_percent_discount) > 0 || count($get_buy_take_discount) > 0 || count($get_flat_discount) > 0){ ?>
												<div class="alert alert-info" role="alert" style="margin-top:5px !important;margin-bottom:5px !important">
													<?php 
														if(count($get_flat_discount) > 0)
														{
															foreach ($get_flat_discount as $fd) 
															{
																if($fd->limited_to !== '0')
																{
																	$limit_note = ' (limited to '.$fd->limited_to.'pc(s) per transaction).';
																}
																else
																{
																	$limit_note = ' (no limit per transaction)';
																}
																echo '<center>Buy '.$row->item_name.' @ $'.number_format((float)$fd->price, 2, '.', '').$limit_note.'</center>';

															}
													 	} 
													?>
													<?php 
													 	if(count($get_percent_discount) > 0)
													 	{
															foreach ($get_percent_discount as $pd) 
															{
																echo '<center>Available @ '.$pd->discount_price.'% discount.</center>';

															}
													 	} 
													?>
													<?php 
													 	if(count($get_buy_take_discount) > 0)
													 	{
															foreach ($get_buy_take_discount as $btd) 
															{

																$item_name = $this->category->getItemName($btd->select_item_id);

																echo '<center>Buy '.$btd->buy_num.' Get '.$btd->get_num.' '.$item_name[0]->item_name.' Free.</center>';

															}
													 	} 
													?>
												</div>
											<?php } ?>
											
												<!-- <div class="alert alert-info text-center" role="alert" style="margin-top:5px !important;margin-bottom:5px !important">
													No Available discount at this time.
												</div> -->
											
											<img src="<?php if($row->path === 0 || $row->path === NULL || $row->path === ''){ echo base_url().'category_img/food.jpeg'; }else{ echo base_url().$row->path.$row->filename; } ?>" class="img-responsive" style="border-radius:4px; border:2px solid #666;height:150px; width:100%; padding:2px;"> 
											<div id="opah">
												<h4 class="text-center"><?php echo $row->item_name.' @ $ '.number_format((float)$row->price, 2, '.', ''); ?></h4>
											</div> 
											<form action="<?php echo base_url().'kiosk_take_out/order_items' ;?>" method="post">
												<input type="hidden" value="<?php echo current_url(); ?>" name="url" id="url" >
												<input type="hidden" value="<?php echo $row->id; ?>" id="item_id<?php echo $row->id;?>" name="item_id" >
												<input type="hidden" value="<?php echo $row->price; ?>" id="item_price<?php echo $row->id;?>" name="item_price" >
												<input type="hidden" value="0" id="order_qty<?php echo $row->id;?>" name="item_qty" >
												<!-- <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-plus"></span> Add Dish</button> -->
											</form>
									</div> 
									
								
								<?php endforeach; ?>
							<?php }else{ ?>
								<center><h3> No Items Available !</h3></center>
							<?php }?>
			  			</div>
					</div>
				</div>

			</div>

		</div>
	</div>

	<script>
		$(document).ready(function(){
		    $('#dine_type').val('1');
			$('#dine_take').val('1');
		});
		function dine_type(val)
		{
			$('#dine_type').val(val);
			$('#dine_take').val(val);
		}
		function minus(id)
		{
			var num = $('#order_num'+id).val();
			var tot = parseInt(num)-1;

			if(tot < 0)
			{
				$('#order_num'+id).val('0');
				$('#order_qty'+id).val('0');
			}
			else
			{
				$('#order_num'+id).val(tot);
				$('#order_qty'+id).val(tot);
			}

			
		}

		function add(id)
		{
			var num = $('#order_num'+id).val();
			var tot = parseInt(num)+1;
			var qty = 0;

			$('#order_num'+id).val(tot);
			$('#order_qty'+id).val(tot);
		}

		function edit_minus(id)
		{
			var num = $('#order_nums'+id).val();
			var tot = parseInt(num)-1;

			if(tot < 0)
			{
				$('#order_nums'+id).val('0');
			}
			else
			{
				$('#order_nums'+id).val(tot);
			}

			
		}

		function edit_add(id)
		{
			var num = $('#order_nums'+id).val();
			var tot = parseInt(num)+1;
			var qty = 0;

			$('#order_nums'+id).val(tot);
		}

		function qty()
		{
		    var num = document.getElementsByName("order_num");
		    var id = document.getElementsByName("item_id");
		    var qtys = document.getElementsByName("item_qty");
		    var price = document.getElementsByName("item_price");
		    var val = "";

		    for(var i = 0 ; i < num.length ; i++)
		    {
		    	// console.log(id[i]);
		    	// console.log($('#'+num[i].id));
		    	if($('#'+num[i].id).val() > 0 )
		    	{
		    		// console.log(id[i]);
		    		// console.log(id[i].value+'-'+$("#"+num[i].id).val()+'-'+price[i].value+'/');
				    val += id[i].value+'-'+$("#"+num[i].id).val()+'-'+price[i].value+'/';
				    $('#values').val(val);
		    	}
		    }
		}

		function table_num(val)
		{
			$('#table_no').val(val);
		}
		
		function goBack() {
    window.history.back();
}
	</script>
</body>
</html>