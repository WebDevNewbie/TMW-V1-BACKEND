
<?php if($note) { ?>
  <div class="alert alert-success fade in" role="alert" id="note">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo '<strong>'.$note.'</strong>'; ?>
  </div>
<?php }?>
<div class="row" >
	<div class="panel panel-default " style="height:100%;margin:-10px;margin-top:-10px;background:#434343;">
    	<div class="panel-body " style="overflow-y:scroll;height:100%; ">
			<div class="col-md-4 col-sm-12 col-xs-12" style="border:1px solid black;height:450px;background-color:white;">
				<div class="row" style="background:#9ecc43; padding:15px; ">
					<div class="col-md-3 col-sm-3 col-xs-3">
						<label class="control-label" >ItemName</label>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<label class="control-label" >Quantity</label>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<label class="control-label" >Price</label>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<label class="control-label" >Status</label>
					</div>
				</div>
			  	<div class="row" style="height:380px;overflow-y: scroll; ">
			  		<?php if(count($order_info) > 0){ ?>
				    	<?php foreach($order_info as $row) { ?>
				    		<?php if($row->item_qty > 0) { ?>
						      	<li class="list-group-item">
									<div class="row " >
										<div class="col-md-12">
											<div class="col-md-3 col-sm-3 col-xs-3">
								      			<span>
													<?php 
								        				$this->load->model('_backend/category/category');
															$this->load->model('_backend/flat_discount');


								        				$flat_discount = $this->flat_discount->getFlatDiscount($row->item_id);

								        				$item_name = $this->category->getItemName($row->item_id);
								        				echo $item_name[0]->item_name;
								        			?>
												</span>
									    	</div>
									    	<div class="col-md-3 col-sm-3 col-xs-3">
								      			<span>
													<?php echo $row->item_qty; ?>
												</span>
									    	</div>
									    	<div class="col-md-3 col-sm-3 col-xs-3">
								      			<span>
													<?php 
								        				$this->load->model('_backend/percent_discount');
								        				$subtotal = 0;
								        				$discount = $this->percent_discount->getItemDiscount($row->item_id);
								        				if(count($discount) > 0)
								        				{
								        					$percent_discount = $discount[0]->discount_price/100;
									        				$subtot = $row->item_price * $row->item_qty;
									        				$discounted_subtot = $subtot * $percent_discount;
									        				$final_discount = $subtot - $discounted_subtot;

									        			}
									        			else
									        			{
									        				$final_discount = $row->item_price*$row->item_qty;
									        			}
								        				

								        				if($row->item_price !== '0')
									        			{
									        				echo '$'.number_format((float)$final_discount, 2, '.', '');
									        			}
									        			else
									        			{
									        				echo 'Free.';
									        			}

								        				$subtotal += $final_discount;
								        			?>
								        		</span>
											</div>
									    	<div class="col-md-3 col-sm-3 col-xs-3">
								      			<span>
													<?php 
													if ($row->cooking_status === '') {
														echo 'New Order';
													}
													else
													{
														echo $row->cooking_status; 
													}
													?>
												</span>
									    	</div>
										</div>
									</div>
								</li>
							<?php } ?>
					    <?php } ?>
					<?php }else{ ?>
						<br>
						<center><h2><span>No Order(s).</span><h2></center>
					<?php } ?>
			  	</div>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12" style="border:1px solid black;height:450px;background-color:white;">
				<form class="form-horizontal" action="<?php echo base_url().'payment/pay' ; ?>" method="post" role="form">
		  			<div class="row" style="background:#9ecc43; padding:4px;">
						<div class="col-md-4 col-sm-4">
							<?php if(@$order_info[0]->dine_type === '1') { ?>

								<label class="control-label" >Table #: <br><span style="color:#fff;"><?php echo @$order_info[0]->table_no; ?></span></label>
								<input type="hidden"  value="<?php echo @$order_info[0]->id; ?>" name="order_id" class="form-control" readonly>
							<?php }else{ ?>
								<label class="control-label" >Receipt #: <br><span style="color:#fff;"><?php echo @$order_info[0]->id; ?></span></label>
								<input type="hidden"  value="<?php echo @$order_info[0]->id; ?>" name="order_id" class="form-control" readonly>

							<?php } ?>
						 </div>
				      
						<div class="col-md-4 col-sm-4">
							<?php 	
								if(@$order_info[0]->dine_type === '1')
								{
									$dine = 'Dine In';
								}
								elseif(@$order_info[0]->dine_type === '2')
								{
									$dine = 'Take Out';
								} 
								else
								{
									$dine = '';
								}
							?>
							<label class="control-label" >Dine Type : <br><span style="color:#fff;"><?php echo @$dine; ?></span></label>
						</div>
						<div class="col-md-4 col-sm-4">
							<?php 	
								if(@$order_info[0]->bill_status === '0')
								{
									$stat = 'Unpaid';
								}
								elseif(@$order_info[0]->bill_status === '1')
								{
									$stat = 'Paid';
								} 
								else
								{
									$stat = '';
								} 
							?>
							<label class="control-label " >Status : <br><span style="color:#fff;"> <?php echo @$stat; ?></span></label>
						</div>
				    </div>
					<br>
				    <div class="row">
						<div class="col-md-12 col-sm-12 text-left">
							<div class="row ">
								<div class="col-md-4 col-sm-4">
									<label class="control-label" >Subtotal($) :</label>
								</div>
								<div class="col-md-8 col-sm-8">
									<input type="text" id="subtotal" value="<?php echo number_format((float)@$order_info[0]->total_payment, 2, '.', ''); ?>"  class="form-control input-lg" readonly>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<label class="control-label" >Cash ($): </label>
								</div>
								<div class="col-md-8 col-sm-8">
									<!-- <input type="text"  value="" placeholder="$00.00" class="form-control" id="cash" onkeyup="change_cash(this.value)"> -->
									<!-- <div class="input-group add-on"> -->
										<input type="text"  class="form-control input-lg" value="<?php echo @$order_info[0]->cash; ?>" placeholder="$00.00" name="cash" id="cash" onchange="change_cash(this.value)" readonly>
										<!-- <div class="input-group-btn">
											<button class="btn btn-primary" type="button" onclick="mycash();"><i class="glyphicon glyphicon-ok"></i></button>
										</div> -->
									<!-- </div> -->
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<label class="control-label" >Change ($) : </label>
								</div>
								<div class="col-md-8 col-sm-8">
									<input type="text"  value="" placeholder="$00.00" id="change" class="form-control input-lg" readonly>
								</div>
							</div>
							<br>
							<div class="row">
								<?php if(@$order_info[0]->bill_status === '1'){ ?>
									<div class="col-md-6 col-sm-6">
										<a disabled class="nothing btn btn-primary btn-block btn-lg" >%</a>
									</div>
								<?php }else{ ?>
									<div class="col-md-6 col-sm-6">
										<a data-toggle="modal" data-target="#percentModal" class="nothing btn btn-primary btn-block btn-lg" >%</a>
									</div>
								<?php } ?>
									<div class="col-md-6 col-sm-6">
										<a data-toggle="modal" data-target="#freeModal" class="nothing btn btn-success btn-block btn-lg" >Free</a>
									</div>
							</div><br>
							<div class="row">
								<?php if(@$order_info[0]->dine_type === '2') { ?>
									<?php if(@$order_info[0]->bill_status === '1'){ ?>
										<div class="col-md-6 col-sm-6">
											<a class="nothing btn btn-primary btn-block btn-lg" disabled>Add Order</a>
										</div>
									<?php }else{ ?>
										<div class="col-md-6 col-sm-6">
											<a href="<?php echo base_url().'add_order/index/'.@$order_info[0]->id; ?> "  class="nothing btn btn-primary btn-block btn-lg" >Add Order</a>
										</div>
									<?php } ?>
										<div class="col-md-6 col-sm-6">
											<button type="submit" class="btn btn-success btn-block btn-lg" id="button_submit" disabled>PAY</button>
										</div>
								<?php }else{ ?>
									<div class="col-md-12 col-sm-12">
										<button type="submit" class="btn btn-success btn-block btn-lg" id="button_submit" disabled>PAY</button>
									</div>
								<?php } ?>
							</div>
						</div>
						
				    </div>
				</form>
				<!--- % MODAL -->
				<div id="percentModal" class="modal fade" role="dialog">
			        <div class="modal-dialog modal-sm">
			          <div class="modal-content">
			            <div class="modal-header">
			              <button type="button" class="close" data-dismiss="modal">&times;</button>
			              <h5 class="modal-title">Discount</h5>
			            </div>
			            <div class="modal-body">
							<form enctype="multipart/form-data" id="discount_modal" action="<?php echo base_url().'payment/discounted_subtotal' ;?>" method="post" class="form-group">
				                <div class="modal-body">
				                    	<p>Enter Discount rate :</p>
				                  	<div class="form-group">
				                      	<div class="input-group">
				                        	<div class="input-group-addon">%</span></div>
				                        	<input type="text" value="" class="form-control input-lg field" placeholder="" name="discount" >
				                      		<input type="hidden" name="subtotal" value="<?php echo number_format((float)@$order_info[0]->total_payment, 2, '.', ''); ?>"  class="form-control input-lg" >
				                      		<input type="hidden"  value="<?php echo @$order_info[0]->id; ?>" name="order_id" class="form-control" >
				                      	</div>
				                  	</div>
				                  <button type="submit" id="menutab" class="btn btn-block btn-lg btn-success">Discount</button>
				                </div>    
		              		</form>
			            </div>
			          </div>
			        </div>
			    </div>

			    <div id="freeModal" class="modal fade" role="dialog">
			        <div class="modal-dialog modal-sm">
			          <div class="modal-content">
			            <div class="modal-header">
			              <button type="button" class="close" data-dismiss="modal">&times;</button>
			              <h5 class="modal-title">Free Items</h5>
			            </div>
			            <div class="modal-body">
							<form enctype="multipart/form-data" id="free_item_modal" action="<?php echo base_url().'payment/free_item_modal' ;?>" method="post" class="form-group">
				                <div class="modal-body">
				                   	<div class="row">
				                   		<div class="col-md-12">
								    		<div class="form-group">
								    			<label for="item_name" style="float: left;">Select Category :</label>
								      			<select class="form-control input-lg" id="" name="free_cat" onchange="get_category(this.value)"  >
									    			<option value="">Select </option>
									    			<?php foreach ($all_category as $row) { ?>
									    				<option value="<?php echo $row->id; ?>"><?php echo $row->category_name; ?> </option>
									    			<?php } ?>
									  			</select>
								    		</div>
								    	</div>
				                   	</div>
				                   	<div class="row">
								    	<div class="col-md-12" id="free_subcat" style="display:none;">
								    		<div class="form-group">
								    			<label for="item_name" style="float: left;">Select Subcategory :</label>
								      			<select class="form-control free_subcat input-lg" id="" name="free_subcat" onchange="get_subcat(this.value)" ></select>
								    		</div>
								    	</div>
				                   	</div>
				                   	<div class="row">
								    	<div class="col-md-12" id="free_item" style="display:none;">
								    		<div class="form-group">
								    			<label for="item_name" style="float: left;">Select Item :</label>
								      			<select class="form-control free_item input-lg" id="choose_item" name="free_item" onchange="free_items(this.value)" ></select>
								    		</div>
								    	</div>
				                   	</div>
				                   	<div class="row">
				                   		<div class="col-md-12" id="quantity" style="display:none;">
					                  		<div class="form-group">
					                  			<label for="quantity" style="float:left !important">Enter Quantity :</label>
					                        	<input type="text" value="" class="form-control input-lg field" placeholder="" name="quantity" >
					                      	</div>
								    	</div>
				                  	</div>
				                   	<input type="hidden" id="free_choose_item" name="free_choose_item">
				                   	<input type="hidden"  value="<?php echo @$order_info[0]->id; ?>" name="order_id" class="form-control" >
				                  <button type="submit" id="menutab" class="btn btn-block btn-lg btn-success">Add Free Item</button>
				                </div>    
		              		</form>
			            </div>
			          </div>
			        </div>
			    </div>

			    <script>
			    	$(document).ready(function() {
					    $('#discount_modal').formValidation({
					        framework: 'bootstrap',
					        icon: {
					            valid: 'glyphicon glyphicon-ok',
					            invalid: 'glyphicon glyphicon-remove',
					            validating: 'glyphicon glyphicon-refresh'
					        },
					        fields: {
					            discount: {
					                validators: {
					                    notEmpty: {
					                        message: 'The Discount rate is required'
					                    },
					                    numeric: {
					                        message: 'The Discount rate must be a number'
					                    }
					                }
					            },
					        }
					    });

					    $('#free_item_modal').formValidation({
					        framework: 'bootstrap',
					        icon: {
					            valid: 'glyphicon glyphicon-ok',
					            invalid: 'glyphicon glyphicon-remove',
					            validating: 'glyphicon glyphicon-refresh'
					        },
					        fields: {
					            free_cat: {
					                validators: {
					                    notEmpty: {
					                        message: 'Category is required'
					                    },
					                }
					            },
					            free_subcat: {
					                validators: {
					                    notEmpty: {
					                        message: 'Sub-Category is required'
					                    },
					                }
					            },
					            free_item: {
					                validators: {
					                    notEmpty: {
					                        message: 'Item is required'
					                    },
					                }
					            },
					            quantity: {
					                validators: {
					                    notEmpty: {
					                        message: 'Quantity is required'
					                    },
					                    numeric: {
					                        message: 'Quantity must be a number'
					                    }
					                }
					            },
					        }
					    });
					});
			    </script>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12" style="border:1px solid black;height:450px;background-color:white;" >
				<div class="row" style="background:#9ecc43; padding:15px;">
					<label class="control-label" >Enter Cash ($) </label>
				</div>
				<br>
				<div class="row" id="numpad789" >
					<!-- <a class="nothing btn-primary btn btn-lg btn-default " onclick="numpad(7)" style="width:32%;height: 80px;font-size: 40px;">7</a>
					<a class="nothing btn-primary btn btn-lg btn-default " onclick="numpad(8)" style="width:32%;height: 80px;font-size: 40px;">8</a>
					<a class="nothing btn-primary btn btn-lg btn-default " onclick="numpad(9)" style="width:32%;height: 80px;font-size: 40px;">9</a> -->
					<button class="nothing btn-primary btn btn-lg btn-default " id="seven" style="width:32%;height: 80px;font-size: 40px;">7</button>
					<a class="nothing btn-primary btn btn-lg btn-default " id="eight" style="width:32%;height: 80px;font-size: 40px;">8</a>
					<a class="nothing btn-primary btn btn-lg btn-default " id="nine" style="width:32%;height: 80px;font-size: 40px;">9</a>
				</div>
				<div class="row" style="margin-top:2px" id="numpad456">
					<!-- <a class="nothing btn-primary btn btn-lg btn-default " onclick="numpad(4)" style="width:32%;height: 80px;font-size: 40px;">4</a>
					<a class="nothing btn-primary btn btn-lg btn-default " onclick="numpad(5)" style="width:32%;height: 80px;font-size: 40px;">5</a>
					<a class="nothing btn-primary btn btn-lg btn-default " onclick="numpad(6)" style="width:32%;height: 80px;font-size: 40px;">6</a> -->
					<a class="nothing btn-primary btn btn-lg btn-default " id="four" style="width:32%;height: 80px;font-size: 40px;">4</a>
					<a class="nothing btn-primary btn btn-lg btn-default " id="five" style="width:32%;height: 80px;font-size: 40px;">5</a>
					<a class="nothing btn-primary btn btn-lg btn-default " id="six" style="width:32%;height: 80px;font-size: 40px;">6</a>
				</div>
				<div class="row" style="margin-top:2px" id="numpad123">
					<!-- <a class="nothing btn-primary btn btn-lg btn-default " onclick="numpad(1)" style="width:32%;height: 80px;font-size: 40px;">1</a>
					<a class="nothing btn-primary btn btn-lg btn-default " onclick="numpad(2)" style="width:32%;height: 80px;font-size: 40px;">2</a>
					<a class="nothing btn-primary btn btn-lg btn-default " onclick="numpad(3)" style="width:32%;height: 80px;font-size: 40px;">3</a> -->
					<a class="nothing btn-primary btn btn-lg btn-default " id="one" style="width:32%;height: 80px;font-size: 40px;">1</a>
					<a class="nothing btn-primary btn btn-lg btn-default " id="two" style="width:32%;height: 80px;font-size: 40px;">2</a>
					<a class="nothing btn-primary btn btn-lg btn-default " id="three" style="width:32%;height: 80px;font-size: 40px;">3</a>
				</div>
				<div class="row" style="margin-top:2px" id="numpad0">
					<!-- <a class="nothing btn-primary btn btn-lg btn-default " onclick="numpad(0)" style="width:32%;height: 80px;font-size: 40px;">0</a>
					<a class="nothing btn-primary btn btn-lg btn-default " onclick="dot()" onclick="numpad(9)"style="width:32%;height: 80px;font-size: 40px;">.</a>
					<a class="nothing btn-primary btn btn-lg btn-default " onclick="backspace()" style="width:32%;height: 80px;font-size: 40px;"><span class="glyphicon  glyphicon-arrow-left"></span></a> -->
					<a class="nothing btn-primary btn btn-lg btn-default " id="zero" style="width:32%;height: 80px;font-size: 40px;">0</a>
					<a class="nothing btn-primary btn btn-lg btn-default " id="dot" style="width:32%;height: 80px;font-size: 40px;">.</a>
					<a class="nothing btn-primary btn btn-lg btn-default " id="backspace" style="width:32%;height: 80px;font-size: 40px;"><span class="glyphicon  glyphicon-arrow-left"></span></a>
					<!-- <a class="nothing btn-primary btn btn-lg btn-default " onclick="change_cash_()" style="width:23%; height: 65px;font-size: 30px;">=</span></a> -->
				</div>
			</div>
		</div>
	</div>
</div>

</div>
</div>
<script src="<?php echo base_url().'dist/js/numpad.js'; ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){

		setTimeout(function(){
				$( "#note" ).fadeOut( "slow" );
			}, 3000);

		$('#timeline_order').load('<?php echo base_url()."payment/timeline" ; ?>'); 
		setInterval(function() { 
			$('#timeline_order').load('<?php echo base_url()."payment/timeline" ; ?>'); 
		}, 20000);

		$('#change').val(0);
		var change =  parseFloat($('#cash').val()) - parseFloat($('#subtotal').val());
		$('#change').val(change.toFixed(2));
		if($('#cash').val() == '' || $('#cash').val() == null || isNaN($('#cash').val()) || $('#cash').val() === '0')
		{
			$('#change').val(0);
		}
		if(change.toFixed(2) >= 0)
		{
			var element = document.getElementById('button_submit');
		    element.removeAttribute("disabled");
		}
		else
		{
			var element = document.getElementById('button_submit');
		    element.setAttribute('disabled','true');
		}
	});
	function change_cash(val)
	{
		var change =  parseFloat(val) - parseFloat($('#subtotal').val());
		$('#change').val(change.toFixed(2));
		if(val == '' || val == null || isNaN(val))
		{
			$('#change').val(0);
		}
		if(change.toFixed(2) >= 0)
		{
			var element = document.getElementById('button_submit');
		    element.removeAttribute("disabled");
		}
		else
		{
			var element = document.getElementById('button_submit');
		    element.setAttribute('disabled','true');
		}
	}
	function mycash()
	{
		var change =  parseFloat($('#cash').val()) - parseFloat($('#subtotal').val());
		$('#change').val(change.toFixed(2));
		if($('#cash').val() == '' || $('#cash').val() == null || isNaN($('#cash').val()))
		{
			$('#change').val(0);
		}
		if(change.toFixed(2) >= 0)
		{
			var element = document.getElementById('button_submit');
		    element.removeAttribute("disabled");
		}
		else
		{
			var element = document.getElementById('button_submit');
		    element.setAttribute('disabled','true');
		}
	}

	function numpad(val)
	{
		var tmp_val = $('#cash').val();
		if(tmp_val == 0)
		{
			var cash = val;
		}
		else
		{
			var cash = tmp_val + val;
		}
		$('#cash').val(cash);

		var change =  parseFloat(cash) - parseFloat($('#subtotal').val());
		$('#change').val(change.toFixed(2));
		if(cash == '' || cash == null || isNaN(cash))
		{
			$('#change').val(0);
		}
		if(change.toFixed(2) >= 0)
		{
			var element = document.getElementById('button_submit');
		    element.removeAttribute("disabled");
		}
		else
		{
			var element = document.getElementById('button_submit');
		    element.setAttribute('disabled','true');
		}
	}
	function dot()
	{
		var tmp_val = $('#cash').val();
		var tmp_val1 = $('#cash').val();
		if(tmp_val == 0)
		{
			var cash = 0 + '.';
		}
		else
		{
			var cash = tmp_val + '.';
		}
		$('#cash').val(cash);

		var change =  parseFloat(cash) - parseFloat($('#subtotal').val());
		$('#change').val(change.toFixed(2));
		if(cash == '' || cash == null || isNaN(cash))
		{
			$('#change').val(0);
		}
		if(change.toFixed(2) >= 0)
		{
			var element = document.getElementById('button_submit');
		    element.removeAttribute("disabled");
		}
		else
		{
			var element = document.getElementById('button_submit');
		    element.setAttribute('disabled','true');
		}
	}

	function backspace()
	{
		var val = $('#cash').val();
		var tmp_num = '';
		var tmp = '';
		for(var x = 0 ; x < val.length-1 ; x++)
		{
			tmp = val.split('');
			tmp_num += tmp[x];
		}
		if(tmp_num == '')
		{
			$('#cash').val('0');
		}
		else
		{
			$('#cash').val(tmp_num);
		}

		var change =  parseFloat(tmp_num) - parseFloat($('#subtotal').val());
		$('#change').val(change.toFixed(2));
		if(tmp_num == '' || tmp_num == null || isNaN(tmp_num))
		{
			$('#change').val(0);
		}
		if(change.toFixed(2) >= 0)
		{
			var element = document.getElementById('button_submit');
		    element.removeAttribute("disabled");
		}
		else
		{
			var element = document.getElementById('button_submit');
		    element.setAttribute('disabled','true');
		}
		
	}

	function change_cash_()
	{
		var val = $('#cash').val();
		var change =  parseFloat(val) - parseFloat($('#subtotal').val());
		$('#change').val(change.toFixed(2));
		if(val == '' || val == null || isNaN(val))
		{
			$('#change').val(0);
		}
		if(change.toFixed(2) >= 0)
		{
			var element = document.getElementById('button_submit');
		    element.removeAttribute("disabled");
		}
		else
		{
			var element = document.getElementById('button_submit');
		    element.setAttribute('disabled','true');
		}
	}

	function get_category(val)
	{
		// $('#select_item').css('display','block');
		$.get('<?php echo base_url()."discount/get_sub_or_item"; ?>',{cat_id:val},function ( response ){
			if($.parseJSON(response).type == 'subcat')
			{
				$('select.free_subcat').empty();
				$('#free_subcat').css('display','block');
				$('#free_item').css('display','none');

				$('select.free_subcat').append('<option value="">Select</option');
				var datas = $.parseJSON(response).data;
				for(x = 0; x < datas.length ; x++)
				{
					$('select.free_subcat').append('<option  value="'+datas[x].id+'">'+datas[x].subcat_name+'</option');
				}
			}
			else if($.parseJSON(response).type == 'item')
			{
				$('select.free_item').empty();
				$('#free_subcat').css('display','none');
				$('#free_item').css('display','block');

				$('select.free_item').append('<option value="">Select</option');
				var datas = $.parseJSON(response).data;
				for(x = 0; x < datas.length ; x++)
				{
					$('select.free_item').append('<option  value="'+datas[x].id+'">'+datas[x].item_name+'</option');
				}
			}
			else
			{
				$('#free_subcat').css('display','none');
				$('#free_item').css('display','none');
			}

		});

	}

	function get_subcat(val)
	{
		$('select.free_item').empty();
		$('#free_item').css('display','block');
		$('select.free_item').append('<option value="">Select</option');
		$.get('<?php echo base_url()."discount/get_item"; ?>',{id:val},function ( response ){
			var datas = $.parseJSON(response);
			for(x = 0; x < datas.length ; x++)
			{
				$('select.free_item').append('<option  value="'+datas[x].id+'">'+datas[x].item_name+'</option');
			}
		});
	}

	function free_items(val)
	{
		$('#free_choose_item').val(val);
		$('#quantity').css('display','block');
	}
</script>

</body>
</html>