<!DOCTYPE html>
<html lang="en">
<head>
  <title>POS System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href = "<?php echo base_url();?>/dist/css/bootstrap.min.css" rel = "stylesheet"  type="text/css">
 <link href = "<?php echo base_url();?>/dist/css/home.css" rel = "stylesheet"  type="text/css">
  <script src="<?php echo base_url();?>/dist/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>/dist/js/admin.js"></script>
</head>
<body>
	<div class="modal fade" id="noti_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<center><h6 class="modal-title" id="modal_message"></h6></center>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="<?php echo base_url();?>/img/poslogo.png" class="img-responsive"/></a>
			</div>
			<div class="" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" id="menutab"><img src="<?php echo base_url();?>/img/menutab.png" class="img-responsive"/></a></li>
					<li><a href="#"><img src="<?php echo base_url();?>/img/paymenttab.png" class="img-responsive"/></a></li>
					<li><a href="#"><img src="<?php echo base_url();?>/img/floorplantab.png" class="img-responsive"/></a></li>
					<li><a href="#"><img src="<?php echo base_url();?>/img/reporttab.png" class="img-responsive"/></a></li>
					<li>&emsp;&emsp;</li>
					<li><a href="<?php echo base_url();?>admin/user/logout"><img src="<?php echo base_url();?>/img/off.png" class="logout img-responsive"/></a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="border-line1"></div>
	<div class="border-line2"></div>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Category</h4>
				</div>
				<div class="modal-body">
					<form id="registerNewCategory"  class="form-group">
						<div class="modal-body">
							<div class="form-group">
								<p>Category Name</p>
									<div class="input-group">
										<div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div>
										<input type="text" class="form-control field" placeholder="Category Name" name="category_name" required>
									</div>
							</div>
							<div class="form-group">
								<p>Description</p>
									<div class="input-group">
										<div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
										<input type="text" class="form-control field" placeholder="Description" name="description" required>
									</div>
							</div>
							<button type="submit" id="menutab" class="btn btn-block btn-success">Add</button>
						</div>		
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="mainboard-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<div class="container">
							<div class="col-md-12" id="divlist">
								<div class="container main_content">
									<div class="row" id="Categ"><center>
									<?php foreach($result as $row) {?>	
										<a href="" onclick="viewDish(<?php echo $row->id;?>)">
											<div class="col-md-3">
												<p style="" ><?php echo $row->category_name;?></p>
											</div>
										</a>
									<?php } ?>	
									</div>
								</div>
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-5"></div>
									<div class="col-md-3">
										<?php echo $this->ajax_pagination->create_links(); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 side_nav">
					<div class="row">
						<div class="container category">
							<a  data-toggle="modal" data-target="#myModal">
								<div class="col-md-6">
									<h2>ADD Category</h2>
								</div>
								<div class="col-md-6">
									<img src="<?php echo base_url();?>/img/add.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<div class="row">
						<div class="container category">
							<a  href="#" id="editCategory">
								<div class="col-md-6">
									<h2>EDIT Category</h2>
								</div>
								<div class="col-md-6">
									<img src="<?php echo base_url();?>/img/edit.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
					<div class="hr-line"></div>
					<div class="row">
						<div class="container category">
							<a  href="#" id="deleteCategory">
								<div class="col-md-6">
									<h2>DELETE Category</h2>
								</div>
								<div class="col-md-6">
									<img src="<?php echo base_url();?>/img/delete.png" class="img-responsive"/>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="editModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Category</h4>
				</div>
				<div class="modal-body">
					<form id="registerNewCategory"  class="form-group">
						<div class="modal-body">
							<div class="form-group">
								<p>Category Name</p>
									<div class="input-group">
										<div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div>
										<input type="text" class="form-control field" placeholder="Display Category Here" name="category_name" required>
									</div>
							</div>
							<div class="form-group">
								<p>Description</p>
									<div class="input-group">
										<div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
										<input type="text" class="form-control field" placeholder="Display Category Here" name="description" required>
									</div>
							</div>
							<button type="submit" class="btn btn-block btn-success">Update</button>
						</div>		
					</form>
				</div>
			</div>
		</div>
	</div>
<div class="modal fade bs-example-modal-sm"  id="dltModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Delete Category</h4>
			  </div>
			  <div class="modal-body">
				<center>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger">Delete Now</button>
				</center>
			  </div>
			</div>
  </div>
</div>
</body>
</html>