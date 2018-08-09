</div>
<?php //echo dump_exit($uri_segment); ?>
				<div class="col-md-3 col-sm-3 side_nav">

					<!--- Sub-Category -->
					<?php if($uri_segment === 'category'){ ?>
						<div class="row">
							<div class="container category">
								<a data-toggle="modal" data-target="#myModalSub" href="#">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<h2>Add</h2> <h5 style="color:white;">Sub-Category</h5>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<img src="<?php echo base_url();?>/img/add.png" class="img-responsive"/>
									</div>
								</a>
							</div>
						</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'none'){ ?>
						<div class="row">
							<div class="container category">
								<a data-toggle="modal" data-target="#myModalSub" href="#">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<h2>Add</h2> <h5 style="color:white">Sub-Category</h5>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<img src="<?php echo base_url();?>/img/add.png" class="img-responsive"/>
									</div>
								</a>
							</div>
						</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'category'){ ?>
						<div class="row">
							<div class="container category">
								<a href="<?php echo base_url().'dashboard/edit_subcategory/'.$this->uri->segment(3) ; ?>">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<h2>Edit</h2> <h5 style="color:white;">Sub-Category</h5>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<img src="<?php echo base_url();?>/img/edit.png" class="img-responsive"/>
									</div>
								</a>
							</div>
						</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'category'){ ?>
						<div class="row">
							<div class="container category">
								<a href="<?php echo base_url().'dashboard/delete_subcategory/'.$this->uri->segment(3) ; ?>">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<h2>Delete</h2> <h5 style="color:white;">Sub-Category</h5>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<img src="<?php echo base_url();?>/img/delete.png" class="img-responsive"/>
									</div>
								</a>
							</div>
						</div>
					<div class="hr-line"></div>
					<?php } ?>


					<!--- Items -->
					<?php if($uri_segment === 'sub_category'){ ?>
					<div class="row">
						<div class="container category">
							<a data-toggle="modal" data-target="#myModalItem" href="#">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Add Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/add.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'edit_item'){ ?>
					<div class="row">
						<div class="container category">
							<a data-toggle="modal" data-target="#myModalItem" href="#">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Add Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/add.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'none'){ ?>
					<div class="row">
						<div class="container category">
							<a data-toggle="modal" data-target="#myModalItem" href="#">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Add Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/add.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'item'){ ?>
					<div class="row">
						<div class="container category">
							<a data-toggle="modal" data-target="#myModalItem" href="#">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Add Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/add.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'delete_item'){ ?>
					<div class="row">
						<div class="container category">
							<a data-toggle="modal" data-target="#myModalItem" href="#">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Add Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/add.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'discount'){ ?>
					<div class="row">
						<div class="container category">
							<a data-toggle="modal" data-target="#myModalItem" href="#">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Add Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/add.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'sub_category'){ ?>
					<div class="row">
						<div class="container category">
							<a  href="<?php echo base_url().'dashboard/edit_item/'.$this->uri->segment(3); ?>">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Edit Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/edit.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'edit_item'){ ?>
					<div class="row">
						<div class="container category">
							<a  href="<?php echo base_url().'dashboard/edit_item/'.$cat_id; ?>">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Edit Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/edit.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'item'){ ?>
					<div class="row">
						<div class="container category">
							<a  href="<?php echo base_url().'dashboard/edit_item/'.$subcat_id.'a'.$cat_id; ?>">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Edit Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/edit.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'delete_item'){ ?>
					<div class="row">
						<div class="container category">
							<a  href="<?php echo base_url().'dashboard/edit_item/'.$cat_id; ?>">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Edit Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/edit.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'discount'){ ?>
					<div class="row">
						<div class="container category">
							<a  href="<?php echo base_url().'dashboard/edit_item/'.$cat_id; ?>">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Edit Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/edit.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<?php } ?>
					<?php if($uri_segment === 'sub_category'){ ?>
					<div class="row">
						<div class="container category">
							<a href="<?php echo base_url().'dashboard/delete_item/'.$this->uri->segment(3); ?>">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Delete Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/delete.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<?php } ?>
					<?php if($uri_segment === 'item'){ ?>
					<div class="row">
						<div class="container category">
							<a href="<?php echo base_url().'dashboard/delete_item/'.$subcat_id.'a'.$cat_id; ?>">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Delete Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/delete.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<?php } ?>
					<?php if($uri_segment === 'edit_item'){ ?>
					<div class="row">
						<div class="container category">
							<a href="<?php echo base_url().'dashboard/delete_item/'.$this->uri->segment(3); ?>">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Delete Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/delete.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<?php } ?>
					<?php if($uri_segment === 'delete_item'){ ?>
					<div class="row">
						<div class="container category">
							<a href="<?php echo base_url().'dashboard/delete_item/'.$cat_id; ?>">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Delete Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/delete.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<?php } ?>
					<?php if($uri_segment === 'discount'){ ?>
					<div class="row">
						<div class="container category">
							<a href="<?php echo base_url().'dashboard/delete_item/'.$cat_id; ?>">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<h2>Delete Item</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<img src="<?php echo base_url();?>/img/delete.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>