		
		<br>
		<?php if($note) { ?>
		  	<div class="alert alert-success fade in" role="alert">
		    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    	<?php echo '<strong>'.$note.'</strong>'; ?>
		  	</div>
		<?php }?>
		<div class="panel panel-primary">
		  	<div class="panel-heading">Discount Information</div>
			<ul class="nav nav-tabs">
		    	<li class="active"><a data-toggle="tab" href="#add_discount">Add Discount</a></li>
			    <li><a data-toggle="tab" href="#edit_discount">Edit Discount</a></li>
			    <li><a data-toggle="tab" href="#delete_discount">Delete Discount</a></li>
		  	</ul>
		  	<div class="panel-body">
		  		<div class="tab-content">
		  			<div id="add_discount" class="tab-pane fade in active">

				  		<div class="row">
				  			<div class="col-md-12">
				  				<form role="form">
					  				<div class="form-group">
							  			<label for="sel1" style="float:left !important;">Select Discount:</label>
							  			<label id="note"></label>&nbsp;<label id="note1"></label>&nbsp;<label id="note2"></label>
							  			<select class="form-control input-lg" id="sel1" onchange="get_discount(this.value)">
							    			<option value="">Select </option>
							    			<option value="1">Flat Discount</option>
							    			<option value="2">Percent (%) Discount</option>
							    			<option value="3">Buy X Get X Free</option>
							  			</select>
									</div>
								</form>
				  			</div>
				  		</div>
						<div class="row flat_discount" style="display:none">
				  			<div class="col-md-12">
				  				<form action="<?php echo base_url().'discount/add_flat_discount' ; ?>" id="add_flat_discount" method="post" role="form">
									<div class="form-group">
									    <label for="item_name" style="float: left;">Buy :</label>
								      	<input type="text" class="input-lg form-control" id="fd_item_name" value="<?php echo $item[0]->item_name ;?>" name="fd_item_name" readonly>
								      	<input type="hidden" class="form-control" id="fd_item_id" value="<?php echo $item[0]->id ;?>" name="fd_item_id" readonly>
								    </div>
						  			<div class="row">
										<div class="form-group">
									    	<div class="col-md-2">
									    		<div class="form-group">
									    			<label for="item_name" style="float: left;">At (SGD):</label>
									      			<input type="text" class="form-control input-lg " id="fd_price" name="fd_price" placeholder="$0.00">
									    		</div>
									    	</div>
											<div class="col-md-10">
									    		<div class="form-group">
											      	<label for="item_name" style="float: left;">Limited to (Leave 0 if no limit):</label>
											      	<input type="text" class="form-control input-lg" id="fd_limited_to"  name="fd_limited_to" >
											    </div>
										    </div>
									    </div>
									</div>
				  					<div class="form-group">
								      	<label for="from" style="float: left;">Discount from:</label>
								      	<input type="text"class="form-control input-lg datepicker_discount_from_flat" placeholder="Click to popup DatePicker" id="from" name="discount_from" readonly>
								    </div>
				  					<div class="form-group">
								      	<label for="to" style="float: left;">Discount to:</label>
								      	<input type="text" class="form-control input-lg datepicker_discount_to_flat" placeholder="Click to popup DatePicker" id="to" name="discount_to" readonly>
								    </div>
								    <div class="form-group">
								      	<button type="submit" class="btn btn-lg btn-block btn-success">Add Discount</button>
								    </div>
								</form>
				  			</div>
				  		</div>

				  		<div class="row percent_discount" style="display:none">
				  			<div class="col-md-12">
				  				<form action="<?php echo base_url().'discount/add_percent_discount' ; ?>" id="add_percent_discount" method="post" role="form">
				  					<div class="form-group">
								      	<label for="item_name" style="float: left;">Item Name:</label>
								      	<input type="text" class="form-control input-lg" id="item_name" value="<?php echo $item[0]->item_name ;?>" name="item_name" readonly>
								      	<input type="hidden" class="form-control" id="item_id" value="<?php echo $item[0]->id ;?>" name="item_id" readonly>
								      	<input type="hidden" name="cat_id" value="<?php echo $cat_item_id; ?>">
								    </div>
				  					<div class="form-group">
								      	<label for="percent" style="float: left;">% Discount:</label>
								      	<input type="text" class="form-control input-lg" id="percent" name="percent_discount" >
								    </div>
				  					<div class="form-group" >
								      	<label for="from" style="float: left;">Discount from:</label>
								      	<input type="text" class="datepicker_discount_from_per form-control input-lg" placeholder="Click to popup DatePicker" id="from" name="discount_from" readonly>
								    </div>
				  					<div class="form-group">
								      	<label for="to" style="float: left;">Discount to:</label>
								      	<input type="text" class="form-control datepicker_discount_to_per input-lg" placeholder="Click to popup DatePicker" id="to" name="discount_to" readonly >
								    </div>
								    <div class="form-group">
								      	<button type="submit" class="btn btn-success btn-lg btn-block">Add Discount</button>
								    </div>
								</form>
				  			</div>
				  		</div>

				  		<div class="row buy_take" style="display:none">
				  			<div class="col-md-12">
				  				<form action="<?php echo base_url().'discount/add_buy_take_discount'; ?>" id="add_buy_take_discount" method="post" role="form">
								    <div class="row">
										<div class="form-group">
									    	<div class="col-md-2">
									    		<div class="form-group">
									    			<label for="item_name" style="float: left;">Buy :</label>
									      			<input type="text" class="form-control input-lg" id="bt_buy_num" name="bt_buy_num" onkeyup="buy_note(this.value)" >
									    		</div>
									    	</div>
											<div class="col-md-10">
										      	<label for="item_name" style="float: left;">Item Name :</label>
										      	<input type="text" class="form-control input-lg" id="bt_item_name" value="<?php echo $item[0]->item_name ;?>" name="bt_item_name" readonly>
										      	<input type="hidden" class="form-control" id="bt_item_id" value="<?php echo $item[0]->id ;?>" name="bt_item_id" readonly>
										    </div>
									    </div>
									</div>
								    <div class="row">
								    	<div class="col-md-2">
								    		<div class="form-group">
								    			<label for="item_name" style="float: left;">Get :</label>
								      			<input type="text" class="form-control input-lg" id="bt_get_num" name="bt_get_num" onkeyup="get_note(this.value)"  >
								    		</div>
								    	</div>
								    	<div class="col-md-3">
								    		<div class="form-group">
								    			<label for="item_name" style="float: left;">Select Category :</label>
								      			<select class="form-control input-lg" id="" name="bt_cat" onchange="get_category(this.value)"  >
									    			<option value="">Select </option>
									    			<?php foreach ($all_category as $row) { ?>
									    				<option value="<?php echo $row->id; ?>"><?php echo $row->category_name; ?> </option>
									    			<?php } ?>
									  			</select>
								    		</div>
								    	</div>
								    	<div class="col-md-3" id="sel_subcat_add" style="display:none;">
								    		<div class="form-group">
								    			<label for="item_name" style="float: left;">Select Subcategory :</label>
								      			<select class="form-control sel_subcat_add input-lg" id="" name="bt_subcat" onchange="get_subcat(this.value)" ></select>
								    		</div>
								    	</div>
								    	<div class="col-md-3" id="sel_item_add" style="display:none;">
								    		<div class="form-group">
								    			<label for="item_name" style="float: left;">Select Item :</label>
								      			<select class="form-control sel_item_add input-lg" id="bt_sel_item" name="bt_sel_item" onchange="note(this)" ></select>
								    		</div>
								    	</div>
								    </div>
				  					<div class="form-group">
								      	<label for="from" style="float: left;">Discount from:</label>
								      	<input class="form-control datepicker_discount_from_buy input-lg" placeholder="Click to popup DatePicker" id="from" name="discount_from" readonly>
								    </div>
				  					<div class="form-group">
								      	<label for="to" style="float: left;">Discount to:</label>
								      	<input class="form-control datepicker_discount_to_buy input-lg"placeholder="Click to popup DatePicker"  id="to" name="discount_to" readonly>
								    </div>
								    <div class="form-group">
								      	<button type="submit" class="btn btn-success btn-lg btn-block">Add Discount</button>
								    </div>
								</form>
				  			</div>
				  		</div>
		  			</div>
		  			<div id="edit_discount" class="tab-pane fade">
						<?php if(count($get_flat_discount) > 0) { ?>
			  				<div class="row">
					  			<div class="col-md-12">
					  				<form role="form">
						  				<div class="form-group">
								  			<label for="sel1" style="float:left !important;">Select Discount:</label>
								  			<select class="form-control input-lg " id="edit_fd" onchange="get_discount(this.value)" disabled>
								    			<option value="">Select </option>
								    			<option value="1" selected>Flat Discount</option>
								    			<option value="2">Percent (%) Discount</option>
								    			<option value="3">Buy X Get X Free</option>
								  			</select>
										</div>
									</form>
					  			</div>
					  		</div>
		  					<div class="row flat_discount_edit" style="display:none">
					  			<div class="col-md-12">
					  				<?php foreach ($get_flat_discount as $row) { ?>
						  				<form action="<?php echo base_url().'discount/update_flat_discount' ; ?>" id="update_flat_discount" method="post" role="form">
											<div class="form-group">
											    <label for="item_name" style="float: left;">Buy :</label>
										      	<input type="text" class="form-control input-lg" id="fd_item_name" value="<?php echo $item[0]->item_name ;?>" name="fd_item_name" readonly>
										      	<input type="hidden" class="form-control" id="fd_item_id" value="<?php echo $item[0]->id ;?>" name="fd_item_id" readonly>
										      	<input type="hidden" class="form-control" id="fd_id" value="<?php echo $row->id ;?>" name="fd_id" readonly>
										    </div>
								  			<div class="row">
												<div class="form-group">
											    	<div class="col-md-2">
											    		<div class="form-group">
											    			<label for="item_name" style="float: left;">At (SGD):</label>
											      			<input type="text" class="form-control input-lg" id="fd_price" value="<?php echo $row->price; ?>" name="fd_price" placeholder="$0.00" required>
											    		</div>
											    	</div>
													<div class="col-md-10">
												      	<label for="item_name" style="float: left;">Limited to (Leave blank if no limit):</label>
												      	<input type="text" class="form-control input-lg" id="fd_limited_to" value="<?php echo $row->limited_to; ?>" name="fd_limited_to" value="0">
												    </div>
											    </div>
											</div>
						  					<div class="form-group">
										      	<label for="from" style="float: left;">Discount from:</label>
										      	<input class="form-control datepicker_from_update_flat input-lg" id="from" value="<?php echo $row->discount_from; ?>" name="discount_from" readonly>
										    </div>
						  					<div class="form-group">
										      	<label for="to" style="float: left;">Discount to:</label>
										      	<input class="form-control datepicker_to_update_flat input-lg" id="to" value="<?php echo $row->discount_to; ?>" name="discount_to" readonly >
										    </div>
										    <div class="form-group">
										      	<button type="submit" class="btn btn-success btn-lg btn-block">Update Discount</button>
										    </div>
										</form>
									<?php } ?>
					  			</div>
					  		</div>
					  	<?php } ?>

		  				<?php if(count($get_percent_discount) > 0) { ?>
			  				<div class="row">
					  			<div class="col-md-12">
					  				<form role="form">
						  				<div class="form-group">
								  			<label for="sel1" style="float:left !important;">Select Discount:</label>
								  			<select class="form-control input-lg" id="edit_" onchange="get_discount(this.value)" disabled>
								    			<option value="">Select </option>
								    			<option value="1">Flat Discount</option>
								    			<option value="2" selected>Percent (%) Discount</option>
								    			<option value="3">Buy X Get X Free</option>
								  			</select>
										</div>
									</form>
					  			</div>
					  		</div>

					  		<div class="row percent_discount_edit" style="display:none">
					  			<div class="col-md-12">
					  				<?php foreach ($get_percent_discount as $row) { ?>
						  				<form action="<?php echo base_url().'discount/update_percent_discount' ; ?>" id="update_percent_discount" method="post" role="form">
						  					<div class="form-group">
										      	<label for="item_name" style="float: left;">Item Name:</label>
										      	<input type="text" class="form-control input-lg" id="item_name" value="<?php echo $item[0]->item_name ;?>" name="item_name" readonly>
										      	<input type="hidden" name="id" value="<?php echo $row->id; ?>">
										    </div>
						  					<div class="form-group">
										      	<label for="percent" style="float: left;">% Discount:</label>
										      	<input type="text" class="form-control input-lg" value="<?php echo $row->discount_price; ?>" id="percent" name="percent_discount" >
										    </div>
						  					<div class="form-group">
										      	<label for="from" style="float: left;">Discount from:</label>
										      	<input class="form-control datepicker_from_update_per input-lg" value="<?php echo $row->discount_from; ?>" id="from" name="discount_from" readonly>
										    </div>
						  					<div class="form-group">
										      	<label for="to" style="float: left;">Discount to:</label>
										      	<input class="form-control datepicker_to_update_per input-lg" value="<?php echo $row->discount_to; ?>" id="to" name="discount_to" readonly >
										    </div>
										    <div class="form-group">
										      	<button type="submit" class="btn btn-success btn-lg btn-block">Update Discount</button>
										    </div>
										</form>
									<?php } ?>
					  			</div>
					  		</div>
					  	<?php } ?>
					  	<?php if(count($get_buy_take_discount) > 0) { ?>
					  		<div class="row">
					  			<div class="col-md-12">
					  				<form role="form">
						  				<div class="form-group">
								  			<label for="sel1" style="float:left !important;">Select Discount:</label>
								  			<select class="form-control input-lg" id="edit_bt" onchange="get_discount(this.value)" disabled>
								    			<option value="">Select </option>
								    			<option value="1">Flat Discount</option>
								    			<option value="2" >Percent (%) Discount</option>
								    			<option value="3" selected>Buy X Get X Free</option>
								  			</select>
										</div>
									</form>
					  			</div>
					  		</div>
							<div class="row buy_take_edit" style="display:none">
					  			<div class="col-md-12">
					  				<?php foreach ($get_buy_take_discount as $row) { ?>
					  				<?php 
										$this->load->model('_backend/buy_take_discount');	

					    				$get_cat = $this->buy_take_discount->getCat($row->select_item_id);
					    				$category_id = $get_cat[0]->category_id;
					    				$subcategory_id = $get_cat[0]->subcat_id;

					    			?>
						  				<form action="<?php echo base_url().'discount/edit_buy_take_discount'; ?>" id="edit_buy_take_discount" method="post" role="form">
										    <div class="row">
												<div class="form-group">
											    	<div class="col-md-2">
											    		<div class="form-group">
											    			<label for="item_name" style="float: left;">Buy :</label>
											      			<input type="text" value="<?php echo $row->buy_num;?>" class="form-control input-lg" id="bt_buy_num" name="bt_buy_num_edit" onkeyup="buy_note(this.value)" required>
											    		</div>
											    	</div>
													<div class="col-md-10">
												      	<label for="item_name" style="float: left;">Item Name :</label>
												      	<input type="text" class="form-control input-lg" id="bt_item_name" value="<?php echo $item[0]->item_name ;?>" name="bt_item_name_edit" readonly>
												      	<input type="hidden" class="form-control" id="bt_item_id" value="<?php echo $item[0]->id ;?>" name="bt_item_id_edit" readonly>
												      	<input type="hidden" class="form-control" id="bt_id_edit" value="<?php echo $row->id ;?>" name="bt_id_edit" readonly>
												    </div>
											    </div>
											</div>
										    <div class="row">
										    	<div class="col-md-2">
										    		<div class="form-group">
										    			<label for="item_name" style="float: left;">Get :</label>
										      			<input type="text" class="form-control input-lg" value="<?php echo $row->get_num;?>" id="bt_get_num" name="bt_get_num_edit" onkeyup="get_note(this.value)"  required>
										    		</div>
										    	</div>
										    	<div class="col-md-3">
										    		<div class="form-group">
										    			<label for="item_name" style="float: left;">Select Category :</label>
										    			<input type="hidden" id="categ_id" value="<?php echo $category_id;?>">
										    			<input type="hidden" id="subcateg_id" value="<?php echo $subcategory_id;?>">
										    			<input type="hidden" id="select_item_id" value="<?php echo $row->select_item_id;?>">
										      			<select class="form-control input-lg" id="" name="bt_cat" onchange="get_category_edit(this.value)"  required>
											    			<option value="">Select </option>
											    			<?php foreach ($all_category as $key) { ?>
											    				<?php if($category_id === $key->id){ ?>
																	<option value="<?php echo $key->id; ?>" selected><?php echo $key->category_name; ?> </option>
											    				<?php } else {?>
											    					<option value="<?php echo $key->id; ?>"><?php echo $key->category_name; ?> </option>
											    				<?php } ?>
											    			<?php } ?>
											  			</select>
										    		</div>
										    	</div>
										    	<div class="col-md-3" id="sel_subcat_edit" style="display:none;">
										    		<div class="form-group">
										    			<label for="item_name" style="float: left;">Select Subcategory :</label>
										      			<select class="form-control sel_subcat_edit input-lg" id="" name="bt_subcat" onchange="get_subcat_edit(this.value)" ></select>
										    		</div>
										    	</div>
										    	<div class="col-md-3" id="sel_item_edit" style="display:none;">
										    		<div class="form-group">
										    			<label for="item_name" style="float: left;">Select Item :</label>
										      			<select class="form-control sel_item_edit input-lg" id="bt_sel_item" value="<?php echo $row->select_item_id;?>" name="bt_sel_item_edit" onchange="note_edit(this)" required></select>
										    		</div>
										    	</div>
										    </div>
						  					<div class="form-group">
										      	<label for="from" style="float: left;">Discount from:</label>
										      	<input class="form-control datepicker_from_update_buy input-lg" value="<?php echo $row->discount_from;?>" id="from" name="discount_from_edit" readonly>
										    </div>
						  					<div class="form-group">
										      	<label for="to" style="float: left;">Discount to:</label>
										      	<input class="form-control datepicker_to_update_buy input-lg" value="<?php echo $row->discount_to;?>" id="to" name="discount_to_edit" readonly >
										    </div>
										    <div class="form-group">
										      	<button type="submit" class="btn btn-success btn-lg btn-block">Update Discount</button>
										    </div>
										</form>
									<?php } ?>
					  			</div>
					  		</div>
					  	<?php } ?>
		  			</div>
		  			<div id="delete_discount" class="tab-pane fade">
		  				<?php if(count($get_flat_discount) > 0) { ?>
			  				<div class="row">
					  			<div class="col-md-12">
					  				<form role="form">
						  				<div class="form-group">
								  			<label for="sel1" style="float:left !important;">Select Discount:</label>
								  			<select class="form-control input-lg" id="delete_fd" onchange="get_discount(this.value)" disabled>
								    			<option value="">Select </option>
								    			<option value="1" selected>Flat Discount</option>
								    			<option value="2">Percent (%) Discount</option>
								    			<option value="3">Buy X Get X Free</option>
								  			</select>
										</div>
									</form>
					  			</div>
					  		</div>
		  					<div class="row flat_discount_delete" style="display:none">
					  			<div class="col-md-12">
					  				<?php foreach ($get_flat_discount as $row) { ?>
						  				<form action="<?php echo base_url().'discount/delete_flat_discount' ; ?>" method="post" role="form">
											<div class="form-group">
											    <label for="item_name" style="float: left;">Buy :</label>
										      	<input type="text" class="form-control input-lg" id="fd_item_name" value="<?php echo $item[0]->item_name ;?>" name="fd_item_name" readonly>
										      	<input type="hidden" class="form-control" id="fd_item_id" value="<?php echo $item[0]->id ;?>" name="fd_item_id" readonly>
										    	<input type="hidden" class="form-control" id="fd_id" value="<?php echo $row->id ;?>" name="fd_id" readonly>
										    </div>
								  			<div class="row">
												<div class="form-group">
											    	<div class="col-md-2">
											    		<div class="form-group">
											    			<label for="item_name" style="float: left;">At (SGD):</label>
											      			<input type="text" class="form-control input-lg" id="fd_price" value="<?php echo $row->price; ?>" name="fd_price" placeholder="$0.00" readonly>
											    		</div>
											    	</div>
													<div class="col-md-10">
												      	<label for="item_name" style="float: left;">Limited to (Leave blank if no limit):</label>
												      	<input type="text" class="form-control input-lg" id="fd_limited_to" value="<?php echo $row->limited_to; ?>" name="fd_limited_to" value="0" readonly>
												    </div>
											    </div>
											</div>
						  					<div class="form-group">
										      	<label for="from" style="float: left;">Discount from:</label>
										      	<input class="form-control datepicker input-lg" id="from" value="<?php echo $row->discount_from; ?>" name="discount_from" readonly>
										    </div>
						  					<div class="form-group">
										      	<label for="to" style="float: left;">Discount to:</label>
										      	<input class="form-control datepicker input-lg" id="to" value="<?php echo $row->discount_to; ?>" name="discount_to" readonly >
										    </div>
										    <div class="form-group">
										      	<button type="submit" class="btn btn-success btn-lg btn-block">Delete Discount</button>
										    </div>
										</form>
									<?php } ?>
					  			</div>
					  		</div>
					  	<?php } ?>

		  				<?php if(count($get_percent_discount) > 0) { ?>
			  				<div class="row">
					  			<div class="col-md-12">
					  				<form role="form">
						  				<div class="form-group">
								  			<label for="sel1" style="float:left !important;">Select Discount:</label>
								  			<select class="form-control input-lg" id="delete_" onchange="get_discount(this.value)" disabled>
								    			<option value="">Select </option>
								    			<option value="1">Flat Discount</option>
								    			<option value="2" selected>Percent (%) Discount</option>
								    			<option value="3">Buy X Get X Free</option>
								  			</select>
										</div>
									</form>
					  			</div>
					  		</div>

							<div class="row flat_discount_delete" style="display:none">
					  			<div class="col-md-12">
					  			</div>
					  		</div>

					  		<div class="row percent_discount_delete" style="display:none">
					  			<div class="col-md-12">
					  				<?php foreach ($get_percent_discount as $row) { ?>
						  				<form action="<?php echo base_url().'discount/delete_percent_discount' ; ?>" method="post" role="form">
						  					<div class="form-group">
										      	<label for="item_name" style="float: left;">Item Name:</label>
										      	<input type="text" class="form-control input-lg" id="item_name" value="<?php echo $item[0]->item_name ;?>" name="item_name" readonly>
										      	<input type="hidden" name="id" value="<?php echo $row->id; ?>">
										    </div>
						  					<div class="form-group">
										      	<label for="percent" style="float: left;">% Discount:</label>
										      	<input type="text" class="form-control input-lg" value="<?php echo $row->discount_price; ?>" id="percent" name="percent_discount" readonly>
										    </div>
						  					<div class="form-group">
										      	<label for="from" style="float: left;">Discount from:</label>
										      	<input class="form-control datepicker input-lg" value="<?php echo $row->discount_from; ?>" id="from" name="discount_from" readonly>
										    </div>
						  					<div class="form-group">
										      	<label for="to" style="float: left;">Discount to:</label>
										      	<input class="form-control datepicker input-lg" value="<?php echo $row->discount_to; ?>" id="to" name="discount_to" readonly >
										    </div>
										    <div class="form-group">
										      	<button type="submit" class="btn btn-success btn-lg btn-block">Delete Discount</button>
										    </div>
										</form>
									<?php } ?>
					  			</div>
					  		</div>
					  	<?php } ?>

					  	<?php if(count($get_buy_take_discount) > 0) { ?>
					  		<div class="row">
					  			<div class="col-md-12">
					  				<form role="form">
						  				<div class="form-group">
								  			<label for="sel1" style="float:left !important;">Select Discount:</label>
								  			<select class="form-control input-lg" id="delete_bt" onchange="get_discount(this.value)" disabled="true">
								    			<option value="">Select </option>
								    			<option value="1">Flat Discount</option>
								    			<option value="2" >Percent (%) Discount</option>
								    			<option value="3" selected>Buy X Get X Free</option>
								  			</select>
										</div>
									</form>
					  			</div>
					  		</div>
							<div class="row buy_take_delete" style="display:none">
					  			<div class="col-md-12">
					  				<?php foreach ($get_buy_take_discount as $row) { ?>
					  				<?php 
										$this->load->model('_backend/buy_take_discount');	

					    				$get_cat = $this->buy_take_discount->getCat($row->select_item_id);
					    				$category_id = $get_cat[0]->category_id;
					    				$subcategory_id = $get_cat[0]->subcat_id;

					    			?>
						  				<form action="<?php echo base_url().'discount/delete_buy_take_discount'; ?>" method="post" role="form">
										    <div class="row">
												<div class="form-group">
											    	<div class="col-md-2">
											    		<div class="form-group">
											    			<label for="item_name" style="float: left;">Buy :</label>
											      			<input type="text" value="<?php echo $row->buy_num;?>" class="form-control input-lg" id="bt_buy_num" name="bt_buy_num_edit" onkeyup="buy_note(this.value)" readonly >
											    		</div>
											    	</div>
													<div class="col-md-10">
												      	<label for="item_name" style="float: left;">Item Name :</label>
												      	<input type="text" class="form-control input-lg" id="bt_item_name" value="<?php echo $item[0]->item_name ;?>" name="bt_item_name_edit" readonly>
												      	<input type="hidden" class="form-control" id="bt_item_id" value="<?php echo $item[0]->id ;?>" name="bt_item_id_edit" readonly>
												      	<input type="hidden" class="form-control" id="bt_id_edit" value="<?php echo $row->id ;?>" name="bt_id_edit" readonly>
												    </div>
											    </div>
											</div>
										    <div class="row">
										    	<div class="col-md-2">
										    		<div class="form-group">
										    			<label for="item_name" style="float: left;">Get :</label>
										      			<input type="text" class="form-control input-lg" value="<?php echo $row->get_num;?>" id="bt_get_num" name="bt_get_num_edit" onkeyup="get_note(this.value)"  readonly >
										    		</div>
										    	</div>
										    	<div class="col-md-3">
										    		<div class="form-group">
										    			<label for="item_name" style="float: left;">Select Category :</label>
										    			<input type="hidden" id="categ_id" value="<?php echo $category_id;?>">
										    			<input type="hidden" id="subcateg_id" value="<?php echo $subcategory_id;?>">
										    			<input type="hidden" id="select_item_id" value="<?php echo $row->select_item_id;?>">
										      			<select class="form-control input-lg" id="" onchange="get_category_delete(this.value)"  disabled="true" >
											    			<option value="">Select </option>
											    			<?php foreach ($all_category as $key) { ?>
											    				<?php if($category_id === $key->id){ ?>
																	<option value="<?php echo $key->id; ?>" selected><?php echo $key->category_name; ?> </option>
											    				<?php } else {?>
											    					<option value="<?php echo $key->id; ?>"><?php echo $key->category_name; ?> </option>
											    				<?php } ?>
											    			<?php } ?>
											  			</select>
										    		</div>
										    	</div>
										    	<div class="col-md-3" id="sel_subcat_delete" style="display:none;">
										    		<div class="form-group">
										    			<label for="item_name" style="float: left;">Select Subcategory :</label>
										      			<select class="form-control sel_subcat_delete input-lg" id="" onchange="get_subcat_delete(this.value)" disabled="true"></select>
										    		</div>
										    	</div>
										    	<div class="col-md-3" id="sel_item_delete" style="display:none;">
										    		<div class="form-group">
										    			<label for="item_name" style="float: left;">Select Item :</label>
										      			<select class="form-control sel_item_delete input-lg" id="bt_sel_item" value="<?php echo $row->select_item_id;?>" name="bt_sel_item_edit" onchange="note_edit(this)" disabled="true" ></select>
										    		</div>
										    	</div>
										    </div>
						  					<div class="form-group">
										      	<label for="from" style="float: left;">Discount from:</label>
										      	<input class="form-control datepicker input-lg" value="<?php echo $row->discount_from;?>" id="from" name="discount_from_edit" readonly >
										    </div>
						  					<div class="form-group">
										      	<label for="to" style="float: left;">Discount to:</label>
										      	<input class="form-control datepicker input-lg" value="<?php echo $row->discount_to;?>" id="to" name="discount_to_edit" readonly >
										    </div>
										    <div class="form-group">
										      	<button type="submit" class="btn btn-success btn-lg btn-block">Delete Discount</button>
										    </div>
										</form>
									<?php } ?>
					  			</div>
					  		</div>
					  	<?php } ?>
		  			</div>
		  		</div>
			    
		  	</div>
		</div>

		<div id="myModalItem" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Add Item</h4>
		      </div>
		      <div class="modal-body">
		        <form enctype="multipart/form-data"  action="<?php echo base_url().'dashboard/add_item/'.$cat_id ;?>"id="registerNewitem" method="post" class="form-group">
		          <input type="hidden" value="<?php echo $subcat_id; ?> " name="subcat_id">
		          <input type="hidden" value="<?php echo $cat_id; ?> " name="cat_id">
		          <div class="modal-body">
		            <div class="form-group">
		              <label>Item Name</label>
		                <div class="input-group">
		                  <div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div>
		                  <input type="text" class="form-control field input-lg" placeholder="Item Name" name="item_name" required>
		                </div>
		            </div>
		            <div class="form-group">
		              <label>Description</label>
		                <div class="input-group">
		                  <div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
		                  <input type="text" class="form-control field input-lg" placeholder="Description" name="description" required>
		                </div>
		            </div>
		            <div class="form-group">
		              <label>Price</label>
		                <div class="input-group">
		                  <div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
		                  <input type="text" class="form-control field input-lg" placeholder="Price" name="price" required>
		                </div>
		            </div>
		            <div class="form-group">
		              <label>Item Image</labelp>
		                <div class="input-group">
		                  <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
		                  <input type="file" class="form-control field input-lg" name="userfile">
		                </div>
		            </div>
		            <button type="submit" id="menutab" class="btn btn-block btn-success btn-lg">Add</button>
		          </div>    
		        </form>
		      </div>
		    </div>
		  </div>
		</div>

	</div>
</div>

<script type="text/javascript">
	function get_discount(val)
	{
		if(val == '1')
		{
			$('.flat_discount').css('display','block');
			$('.percent_discount').css('display','none');
			$('.buy_take').css('display','none');
		}
		else if(val == '2')
		{
			$('.flat_discount').css('display','none');
			$('.percent_discount').css('display','block');
			$('.buy_take').css('display','none');
		}
		else if(val == '3')
		{
			$('.flat_discount').css('display','none');
			$('.percent_discount').css('display','none');
			$('.buy_take').css('display','block');
		}
	}

	function get_category(val)
	{
		// $('#select_item').css('display','block');
		$.get('<?php echo base_url()."discount/get_sub_or_item"; ?>',{cat_id:val},function ( response ){
			if($.parseJSON(response).type == 'subcat')
			{
				$('select.sel_subcat_add').empty();
				$('#sel_subcat_add').css('display','block');
				$('#sel_item_add').css('display','none');

				$('select.sel_subcat_add').append('<option value="">Select</option');
				var datas = $.parseJSON(response).data;
				for(x = 0; x < datas.length ; x++)
				{
					$('select.sel_subcat_add').append('<option  value="'+datas[x].id+'">'+datas[x].subcat_name+'</option');
				}
			}
			else if($.parseJSON(response).type == 'item')
			{
				$('select.sel_item_add').empty();
				$('#sel_subcat_add').css('display','none');
				$('#sel_item_add').css('display','block');

				$('select.sel_item_add').append('<option value="">Select</option');
				var datas = $.parseJSON(response).data;
				for(x = 0; x < datas.length ; x++)
				{
					$('select.sel_item_add').append('<option  value="'+datas[x].id+'">'+datas[x].item_name+'</option');
				}
			}
			else
			{
				$('#sel_subcat').css('display','none');
				$('#sel_item').css('display','none');
			}

		});

	}

	function get_category_edit(val)
	{
		$.get('<?php echo base_url()."discount/get_sub_or_item"; ?>',{cat_id:val},function ( response ){
			if($.parseJSON(response).type == 'subcat')
			{
				$('select.sel_subcat_edit').empty();
				$('#sel_subcat_edit').css('display','block');
				$('#sel_item_edit').css('display','none');

				$('select.sel_subcat_edit').append('<option value="">Select</option');
				var datas = $.parseJSON(response).data;
				for(x = 0; x < datas.length ; x++)
				{
					$('select.sel_subcat_edit').append('<option  value="'+datas[x].id+'">'+datas[x].subcat_name+'</option');
				}
			}
			else if($.parseJSON(response).type == 'item')
			{
				$('select.sel_item_edit').empty();
				$('#sel_subcat_edit').css('display','none');
				$('#sel_item_edit').css('display','block');

				$('select.sel_item_edit').append('<option value="">Select</option');
				var datas = $.parseJSON(response).data;
				for(x = 0; x < datas.length ; x++)
				{
					$('select.sel_item_edit').append('<option  value="'+datas[x].id+'">'+datas[x].item_name+'</option');
				}
			}
			else
			{
				$('#sel_subcat_edit').css('display','none');
				$('#sel_item_edit').css('display','none');
			}

		});
	}

	function get_subcat(val)
	{
		$('select.sel_item_add').empty();
		$('#sel_item_add').css('display','block');
		$('select.sel_item_add').append('<option value="">Select</option');
		$.get('<?php echo base_url()."discount/get_item"; ?>',{id:val},function ( response ){
			var datas = $.parseJSON(response);
			for(x = 0; x < datas.length ; x++)
			{
				$('select.sel_item_add').append('<option  value="'+datas[x].id+'">'+datas[x].item_name+'</option');
			}
		});
	}

	function get_subcat_edit(val)
	{
		$('select.sel_item_edit').empty();
		$('#sel_item_edit').css('display','block');
		$('select.sel_item_edit').append('<option value="">Select</option');
		$.get('<?php echo base_url()."discount/get_item"; ?>',{id:val},function ( response ){
			var datas = $.parseJSON(response);
			for(x = 0; x < datas.length ; x++)
			{
				$('select.sel_item_edit').append('<option  value="'+datas[x].id+'">'+datas[x].item_name+'</option');
			}
		});
	}

	function note(e)
	{
		$('#note2').empty();
		$.get('<?php echo base_url()."discount/get_item_name"; ?>',{id:e.value},function ( response ){
			var note = $.parseJSON(response)+' FREE ! "';
			$('#note2').text(note);
		});
	}

	function note_edit(e)
	{
		$('#note2').empty();
		$.get('<?php echo base_url()."discount/get_item_name"; ?>',{id:e.value},function ( response ){
			var note = $.parseJSON(response)+' FREE ! "';
			$('#note2').text(note);
		});
	}

	function buy_note(val)
	{
		if(val != 0)
		{
			var note = '" Buy '+$('#bt_buy_num').val()+' '+$('#bt_item_name').val();
			$('#note').text(note);
		}
		else
		{
			$('#note').empty();
		}
	}

	function get_note(val)
	{
		if(val != 0)
		{
			var note = ' Get '+$('#bt_get_num').val()+' ';
			$('#note1').text(note);
		}
		else
		{
			$('#note1').empty();
		}
	}
</script>

<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });




	// $('.flat_discount_edit').css('display','block');
	// $('.percent_discount_edit').css('display','block');
	// $('.buy_take_edit').css('display','block');

	// $('.flat_discount_delete').css('display','block');
	// $('.percent_discount_delete').css('display','block');
	// $('.buy_take_delete').css('display','block');

	if($('#edit_fd').val() === '1')
	{
		$('.flat_discount_edit').css('display','block');
	}
	if($('#edit_').val() === '2')
	{
		$('.percent_discount_edit').css('display','block');
	}
	if($('#edit_bt').val() === '3')
	{
		$('.buy_take_edit').css('display','block');
	}
	if($('#delete_fd').val() === '1')
	{
		$('.flat_discount_delete').css('display','block');
	}
	if($('#delete_').val() === '2')
	{
		$('.percent_discount_delete').css('display','block');
	}
	if($('#delete_bt').val() === '3')
	{
		$('.buy_take_delete').css('display','block');
	}


	$.get('<?php echo base_url()."discount/get_sub_or_item"; ?>',{cat_id:$('#categ_id').val()},function ( response ){
		if($.parseJSON(response).type == 'subcat')
		{
			$('select.sel_subcat_edit').empty();
			$('#sel_subcat_edit').css('display','block');
			$('#sel_item_edit').css('display','block');

			$('select.sel_subcat_edit').append('<option value="">Select</option');
			var datas = $.parseJSON(response).data;
			for(x = 0; x < datas.length ; x++)
			{	
				if(datas[x].id === $('#subcateg_id').val())
				{
					$('select.sel_subcat_edit').append('<option  value="'+datas[x].id+'" selected>'+datas[x].subcat_name+'</option');
				}
				else
				{
					$('select.sel_subcat_edit').append('<option  value="'+datas[x].id+'">'+datas[x].subcat_name+'</option');
				}
				
			}

			$('select.sel_subcat_delete').empty();
			$('#sel_subcat_delete').css('display','block');
			$('#sel_item_delete').css('display','block');
			$('select.sel_subcat_delete').append('<option value="">Select</option');
			var datas = $.parseJSON(response).data;
			for(x = 0; x < datas.length ; x++)
			{	
				if(datas[x].id === $('#subcateg_id').val())
				{
					$('select.sel_subcat_delete').append('<option  value="'+datas[x].id+'" selected>'+datas[x].subcat_name+'</option');
				}
				else
				{
					$('select.sel_subcat_delete').append('<option  value="'+datas[x].id+'">'+datas[x].subcat_name+'</option');
				}
				
			}

			$('select.sel_item_edit').empty();
			$('#sel_item_edit').css('display','block');
			$('select.sel_item_edit').append('<option value="">Select</option');
			$.get('<?php echo base_url()."discount/get_item"; ?>',{id:$('#subcateg_id').val()},function ( response ){
				var datas = $.parseJSON(response);
				console.log(response);
				for(x = 0; x < datas.length ; x++)
				{
					if(datas[x].id === $('#select_item_id').val())
					{
						$('select.sel_item_edit').append('<option  value="'+datas[x].id+'" selected>'+datas[x].item_name+'</option');
					}
					else
					{
						$('select.sel_item_edit').append('<option  value="'+datas[x].id+'">'+datas[x].item_name+'</option');
					}
				}
			});

			$('select.sel_item_edit').empty();
			$('#sel_item_edit').css('display','block');
			$('select.sel_item_delete').append('<option value="">Select</option');
			$.get('<?php echo base_url()."discount/get_item"; ?>',{id:$('#subcateg_id').val()},function ( response ){
				var datas = $.parseJSON(response);
				console.log(response);
				for(x = 0; x < datas.length ; x++)
				{
					if(datas[x].id === $('#select_item_id').val())
					{
						$('select.sel_item_delete').append('<option  value="'+datas[x].id+'" selected>'+datas[x].item_name+'</option');
					}
					else
					{
						$('select.sel_item_delete').append('<option  value="'+datas[x].id+'">'+datas[x].item_name+'</option');
					}
				}
			});
		}
		else if($.parseJSON(response).type == 'item')
		{
			$('select.sel_item_edit').empty();
			$('#sel_subcat_edit').css('display','none');
			$('#sel_item_edit').css('display','block');

			$('select.sel_item_edit').append('<option value="">Select</option');
			var datas = $.parseJSON(response).data;
			for(x = 0; x < datas.length ; x++)
			{
				if($('#select_item_id').val() === datas[x].id)
				{
					$('select.sel_item_edit').append('<option value="'+datas[x].id+'" selected >'+datas[x].item_name+'</option');
				}
				else
				{
					$('select.sel_item_edit').append('<option  value="'+datas[x].id+'">'+datas[x].item_name+'</option');
				}
			}

			$('select.sel_item_delete').empty();
			$('#sel_subcat_delete').css('display','none');
			$('#sel_item_delete').css('display','block');

			$('select.sel_item_delete').append('<option value="">Select</option');
			var datas = $.parseJSON(response).data;
			for(x = 0; x < datas.length ; x++)
			{
				if($('#select_item_id').val() === datas[x].id)
				{
					$('select.sel_item_delete').append('<option value="'+datas[x].id+'" selected >'+datas[x].item_name+'</option');
				}
				else
				{
					$('select.sel_item_delete').append('<option  value="'+datas[x].id+'">'+datas[x].item_name+'</option');
				}
			}
		}
		else
		{
			$('#sel_subcat').css('display','none');
			$('#sel_item').css('display','none');
		}

	});

	
});
</script>

<script>
$(document).ready(function() {
	$('.datepicker')
        .datepicker({
            format: 'yyyy-mm-dd'
        });
	$('#registerNewitem').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            item_name: {
                validators: {
                    notEmpty: {
                        message: 'The Sub-Category Name is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The Sub-Category Name can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'The Description is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9!@#$%\^&*)(+=._-]*$/,
                        message: 'White Spaces not allowed'
                    }

                }
            },
            price: {
                validators: {
                    notEmpty: {
                        message: 'The Price is required'
                    },
                    numeric: {
                        message: 'The Price must be a number'
                    }

                }
            }
        }
    });
	$('.datepicker_discount_from_flat')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#add_flat_discount').formValidation('revalidateField', 'discount_from');
        });
    $('.datepicker_discount_to_flat')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#add_flat_discount').formValidation('revalidateField', 'discount_to');
        });
    $('#add_flat_discount').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fd_price: {
                validators: {
                    notEmpty: {
                        message: 'The Price is required'
                    },
                    numeric: {
                        message: 'The Price must be a number'
                    }

                }
            },
            fd_limited_to: {
                validators: {
                    notEmpty: {
                        message: 'The Limited is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9!@#$%\^&*)(+=._-]*$/,
                        message: 'White Spaces not allowed'
                    },
                    numeric: {
                        message: 'The Limited must be a number'
                    }

                }
            },
            discount_from: {
                validators: {
                    notEmpty: {
                        message: 'The Discount From is required'
                    }
                }
            },
            discount_to: {
                validators: {
                    notEmpty: {
                        message: 'The Discount To is required'
                    }
                }
            }
        }
    });
	$('.datepicker_discount_from_per')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#add_percent_discount').formValidation('revalidateField', 'discount_from');
        });
    $('.datepicker_discount_to_per')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#add_percent_discount').formValidation('revalidateField', 'discount_to');
        });
	$('#add_percent_discount').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            percent_discount: {
                validators: {
                    notEmpty: {
                        message: 'The Price is required'
                    },
                    numeric: {
                        message: 'The Price must be a number'
                    }

                }
            },
            discount_from: {
                validators: {
                    notEmpty: {
                        message: 'The Discount From is required'
                    },
                }
            },
            discount_to: {
                validators: {
                    notEmpty: {
                        message: 'The Discount To is required'
                    },
                }
            }
        }
    });
    $('.datepicker_discount_from_buy')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#add_buy_take_discount').formValidation('revalidateField', 'discount_from');
        });
    $('.datepicker_discount_to_buy')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#add_buy_take_discount').formValidation('revalidateField', 'discount_to');
        });
    $('#add_buy_take_discount').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            bt_buy_num: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },
                    numeric: {
                        message: 'This field must be a number'
                    }

                }
            },
            bt_get_num: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },
                    numeric: {
                        message: 'This field must be a number'
                    }

                }
            },
            bt_cat: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },

                }
            },
            bt_subcat: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },

                }
            },
            bt_sel_item: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },

                }
            },
            discount_from: {
                validators: {
                    notEmpty: {
                        message: 'The Discount From is required'
                    }
                }
            },
            discount_to: {
                validators: {
                    notEmpty: {
                        message: 'The Discount To is required'
                    }
                }
            }
        }
    });
	$('.datepicker_from_update_flat')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#update_flat_discount').formValidation('revalidateField', 'discount_from');
        });
    $('.datepicker_to_update_flat')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#update_flat_discount').formValidation('revalidateField', 'discount_to');
        });
    $('#update_flat_discount').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fd_price: {
                validators: {
                    notEmpty: {
                        message: 'The Price is required'
                    },
                    numeric: {
                        message: 'The Price must be a number'
                    }

                }
            },
            fd_limited_to: {
                validators: {
                    notEmpty: {
                        message: 'The Limited is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9!@#$%\^&*)(+=._-]*$/,
                        message: 'White Spaces not allowed'
                    },
                    numeric: {
                        message: 'The Limited must be a number'
                    }

                }
            },
            discount_from: {
                validators: {
                    notEmpty: {
                        message: 'The Discount From is required'
                    }
                }
            },
            discount_to: {
                validators: {
                    notEmpty: {
                        message: 'The Discount To is required'
                    }
                }
            }
        }
    });
	$('.datepicker_from_update_per')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#update_percent_discount').formValidation('revalidateField', 'discount_from');
        });
    $('.datepicker_to_update_per')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#update_percent_discount').formValidation('revalidateField', 'discount_to');
        });
    $('#update_percent_discount').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            percent_discount: {
                validators: {
                    notEmpty: {
                        message: 'The Price is required'
                    },
                    numeric: {
                        message: 'The Price must be a number'
                    }

                }
            },
            discount_from: {
                validators: {
                    notEmpty: {
                        message: 'The Discount From is required'
                    },
                }
            },
            discount_to: {
                validators: {
                    notEmpty: {
                        message: 'The Discount To is required'
                    },
                }
            }
        }
    });
    $('.datepicker_from_update_buy')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#edit_buy_take_discount').formValidation('revalidateField', 'discount_from_edit');
        });
    $('.datepicker_to_update_buy')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#edit_buy_take_discount').formValidation('revalidateField', 'discount_to_edit');
        });
    $('#edit_buy_take_discount').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            bt_buy_num_edit: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },
                    numeric: {
                        message: 'This field must be a number'
                    }

                }
            },
            bt_get_num_edit: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },
                    numeric: {
                        message: 'This field must be a number'
                    }

                }
            },
            bt_cat: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },

                }
            },
            bt_subcat: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },

                }
            },
            bt_sel_item: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },

                }
            },
            discount_from_edit: {
                validators: {
                    notEmpty: {
                        message: 'The Discount From is required'
                    }
                }
            },
            discount_to_edit: {
                validators: {
                    notEmpty: {
                        message: 'The Discount To is required'
                    }
                }
            }
        }
    });
});
</script>
