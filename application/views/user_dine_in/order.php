			<div class="row text-center previewOrder">
				<div class="col-md-5 col-sm-5" id="thiSide">
					<div class="panel panel-success" id="orderNow">
				  	<!-- Default panel contents -->
					  	<div class="panel-heading">
					  		<div class="row">
					  			<div class="col-md-6">
					  				<strong >Table No. </strong><?php echo '<strong>'.$orders['table_num'].'</strong>';?>
					  			</div>
					  			<div class="col-md-3"></div>
					  			<div class="col-md-3">
					  				<?php if($orders['dine_take'] === '1') { ?>
										<strong > Dine In</strong>
					  				<?php }elseif($orders['dine_take'] === '2'){ ?>
					  					<strong > Take Out</strong>
					  				<?php } ?>
					  			</div>
					  			
					  		</div>
					  	</div>

					  	<!-- Table -->
					  	<table class="table">
					    	<thead>
						      	<tr >
						        	<th class="text-center">Dish name</th>
						        	<th class="text-center">No. of order</th>
						        	<th class="text-center">Original Price</th>
						      	</tr>
						    </thead>
						    <tbody>
						    	<?php foreach ($order_data as $row) { 
						    		if(count($row) > 1)
										{ ?>
								    	<tr>
								        	<td>
												<?php 
							        				$this->load->model('_backend/category/category');

							        				$item_name = $this->category->getItemName($row['item_id']);
							        				echo $item_name[0]->item_name;
							        			?>
								        	</td>
								        	<td><?php echo $row['item_qty']; ?></td>
								        	<td><?php echo 'P'.number_format((float)$row['item_price'], 2, '.', ''); ?></td>
								      	</tr>
						    	<?php }
						    		} ?>
						    </tbody>
					  	</table>
					  	<div class="panel-body text-left" >
							
							<?php if (count($order_data) != 0) : ?>
								<div class="row">
									<div class="col-md-10 col-sm-6 col-xs-8">
										<h3>Subtotal : </h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-4">
										<h3 style="float:right"><?php echo 'P'.$orders['total_order']; ?></h3>
									</div>
								</div>
								<div class="row">
									<div class="col-md-10 col-sm-6 col-xs-8">
										<h3>Discount : </h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-4">
										<h3 style="float:right"></h3>
									</div>
								</div>
								<div class="row">
									<div class="col-md-10 col-sm-6 col-xs-8">
										<h3>Total Payment : </h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-4">
										<h3 style="float:right"></h3>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="col-md-7 col-sm-7 menuCateg" >
					<div class="panel panel-success">
						<div class="panel-heading">
					  		<div class="row">
					  			<center><strong>FORM OF PAYMENT</strong></center>
					  		</div>
					  	</div>
					  	<div class="panel-body">
					    	<!-- <div class="panel panel-primary">

							  	<div class="panel-heading">Discount Information</div>
							  	<div class="panel-body">
							  		<div class="row">
							  			<div class="col-md-3">
							  				<a data-toggle="modal" data-target="#myModalSeniorCitizen" class="btn btn-primary" href="#">Senior Citizen</a>
						  				    <div id="myModalSeniorCitizen" class="modal fade" role="dialog">
										        <div class="modal-dialog">
										          	<div class="modal-content">
											            <div class="modal-header">
											              	<button type="button" class="close" data-dismiss="modal">&times;</button>
											              	<h4 class="modal-title">Senior Citizen Discount</h4>
											            </div>
											            <div class="modal-body">
											              	<form class="form-horizontal" role="form">
															  	<div class="form-group">
																    <label class="control-label col-sm-4" for="subtot">Subtotal Payment :</label>
																    <div class="col-sm-8">
																      	<label class="control-label" id="subtot"><?php echo 'P'.$orders['total_order']; ?></label>
																    </div>
															  	</div>
															  	<div class="form-group">
																    <label class="control-label col-sm-4" for="percent">% Discount :</label>
																    <div class="col-sm-8"> 
																      <div class="input-group">
																	  	<input type="text" class="form-control" id="percent" aria-label="Amount (to the nearest dollar)">
																	  	<span class="input-group-addon">%</span>
																	</div>
																    </div>
															  	</div>
															  	<div class="form-group"> 
																    <div class="col-sm-12">
																      <button type="submit" class="btn btn-primary btn-block">Submit</button>
																    </div>
																</div>
															</form>
											            </div>
										          	</div>
										        </div>
  											</div>
							  			</div>
							  			<div class="col-md-3">
							  				<button class="btn btn-primary">Flat Discount</button>
							  			</div>
							  			<div class="col-md-3">
							  				<button class="btn btn-primary">Percent(%) Discount</button>
							  			</div>
							  			<div class="col-md-3">
							  				<button class="btn btn-primary">Buy X Get X Free !</button>
							  			</div>
							  		</div>
							  		
							  	</div>
							</div> -->

					  	</div>
					</div>
				</div>
</body>
</html>