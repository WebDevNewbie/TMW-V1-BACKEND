<!DOCTYPE html>
<html lang="en">
<head>
  <title>POS System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"> 
 <link href = "<?php echo base_url();?>dist/css/bootstrap.min.css" rel = "stylesheet"  type="text/css">
 <link href = "<?php echo base_url();?>dist/css/home.css" rel = "stylesheet"  type="text/css">
 <link href = "<?php echo base_url();?>css/datepicker.css" rel = "stylesheet"  type="text/css">
 <link href = "<?php echo base_url();?>dist/css/sidebar.css" rel = "stylesheet"  type="text/css">
  <script src="<?php echo base_url();?>dist/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>js/datepicker.js"></script>
  <script src="<?php echo base_url();?>js/angular.min.js"></script>
  <script src="<?php echo base_url();?>js/validator.js"></script>
  <script src="<?php echo base_url();?>validation/formValidation.min.js"></script>
  <script src="<?php echo base_url();?>validation/bootstrap.min.js"></script>

  
</head>
<body >
	<div>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" >
					<span class="glyphicon glyphicon-cog glyphicon-lg" style="color:#fff; font-size:50px"></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_url().'dashboard';?>"><p class="pos_logo"></p></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<?php if(@$usertype !== 'kitchen') { ?>
					<li><a href="<?php echo base_url().'dashboard';?>" id="menutab"><img src="<?php echo base_url();?>img/menutab.png" class="img-responsive"/></a></li>
					<li><a href="<?php echo base_url().'payment';?>"><img src="<?php echo base_url();?>img/paymenttab.png" class="img-responsive"/></a></li>
					<!--<li><a href="#"><img src="<?php echo base_url();?>/img/floorplantab.png" class="img-responsive"/></a></li>-->
					<li><a data-toggle="modal" data-target="#addAccount"><img src="<?php echo base_url();?>img/account.png" class="img-responsive"/></a></li>
					<li><a data-toggle="modal" data-target="#tableCtrl" href="#"><img src="<?php echo base_url();?>img/cog.png" class="logout img-responsive"/></a></li>
					<?php } ?>
					<li><a href="<?php echo base_url();?>admin/user/logout"><img src="<?php echo base_url();?>img/off.png" class="logout img-responsive"/></a></li>

				</ul>
			</div>

			

		</div>
	<div class="border-line1"></div>
	<div class="border-line2"></div>
	</nav><br><br><br><br><br><br><br>

	<div id="tableCtrl" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h5 class="modal-title">Table Settings</h5>
            </div>
            <div class="modal-body">
                <?php if(count($table_no) > 0) { ?>
              		<form enctype="multipart/form-data" id="update_tbl" action="<?php echo base_url().'dashboard/update_table_ctrl' ;?>" method="post" class="form-group">
		                <div class="modal-body">
		                    	<p>No. of Tables</p>
		                  	<div class="form-group">
		                      	<div class="input-group">
		                        	<div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div>
		                        	<input type="text" value="<?php echo $table_no[0]->table_no; ?>" class="form-control input-lg field" placeholder="" name="table_no" >
		                        	<input type="hidden" value="<?php echo $table_no[0]->id; ?>" class="form-control field" placeholder="" name="table_id" required>
		                      	</div>
		                  	</div>
		                  <button type="submit" id="menutab" class="btn btn-block btn-lg btn-success">Update</button>
		                </div>    
              		</form>
              	<?php }else{ ?>
					<form enctype="multipart/form-data" id="add_tbl" action="<?php echo base_url().'dashboard/add_table_ctrl' ;?>" method="post" class="form-group">
		                <div class="modal-body">
		                  	<div class="form-group">
		                    	<p>No. of Tables</p>
		                      	<div class="input-group">
		                        	<div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div>
		                        	<input type="text" value="" class="form-control input-lg field" placeholder="" name="table_no" >
		                      	</div>
		                  	</div>
		                  <button type="submit" id="menutab" class="btn btn-block  btn-lg btn-success">Save</button>
		                </div>    
              		</form>
              	<?php } ?>
            </div>
          </div>
        </div>
    </div>
    <script>
	$(document).ready(function() {
	    $('#update_tbl').formValidation({
	        framework: 'bootstrap',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            table_no: {
	                validators: {
	                    notEmpty: {
	                        message: 'The Table Number is required'
	                    },
	                    numeric: {
	                        message: 'The Table Number must be a number'
	                    }
	                }
	            },
	        }
	    });
	    $('#add_tbl').formValidation({
	        framework: 'bootstrap',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            table_no: {
	                validators: {
	                    notEmpty: {
	                        message: 'The Table Number is required'
	                    },
	                    numeric: {
	                        message: 'The Table Number must be a number'
	                    }
	                }
	            },
	        }
	    });
	});
	</script>
	<!-- Add Account Modal -->
	<div class="modal fade" id="addAccount" tabindex="-1" role="dialog" aria-labelledby="addAccount">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title" id="myModalLabel">Add Account</h3>
		  	</div>
			<form role="form" action="<?php echo base_url().'home/addAccount';?>" method="post" id="newAccount" class="form-group">
			  	<div class="modal-body">
					<div class="row">
						<div class="col-md-8 col-sm-8">
							<div class="form-group">
								<label for="username">Username</label>
								<div class="input-group">
					                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
									<input type="text" name="username" placeholder="Please enter Username" class="username form-control input-lg " id="username" >
								</div>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<div class="input-group">
					                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
									<input type="password" name="password" placeholder="Please enter Password" class="password form-control input-lg " id="password" >
								</div>
							</div>
							<div class="form-group">
								<label for="repassword">Re-type Password</label>
								<div class="input-group">
					                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
									<input type="password" name="repassword" placeholder="Please Re-type Password" class="password form-control input-lg " id="repassword" >
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group pull-right">
								<label for="usertype">User Type</label>
								<select class="form-control input-lg " id="usertype" name="usertype">
								  <option value="0">Admin</option>
								  <option value="1">Kiosk - Take Away</option>
								  <option value="2">Kiosk - Dine In</option>
								  <option value="3">Kitchen</option>
								</select>
							</div>
						</div>
					</div>
				
			  	</div>
			  	<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-lg">SAVE</button>
					<a class="btn btn-default btn-lg" data-dismiss="modal">Close</a>
			  	</div>
		  	</form>
		  </div>
		</div>
	  </div>
	</div>

			<script>
			$(document).ready(function() {
			    $('#newAccount').formValidation({
			        framework: 'bootstrap',
			        icon: {
			            valid: 'glyphicon glyphicon-ok',
			            invalid: 'glyphicon glyphicon-remove',
			            validating: 'glyphicon glyphicon-refresh'
			        },
			        fields: {
			            username: {
			                validators: {
			                    notEmpty: {
			                        message: 'The Username is required'
			                    },
				                regexp: {
				                    regexp: /^\S+$/,
				                    message: 'White Space not allow !'
				                },
			                    stringLength: {
			                        min: 6,
			                        max: 30,
			                        message: 'The Username must be more than 6 and less than 30 characters long'
			                    }
			                }
			            },
			            password: {
			                validators: {
			                    notEmpty: {
			                        message: 'The Password is required'
			                    },
			                    stringLength: {
			                        min: 6,
			                        max: 30,
			                        message: 'The Password must be more than 6 and less than 30 characters long'
			                    }
			                }
			            },
			            repassword: {
			                validators: {
			                    notEmpty: {
			                        message: 'The Confirm Password is required'
			                    },
			                    identical: {
				                    field: 'password',
				                    message: 'The password and its confirm are not the same'
				                },
			                    stringLength: {
			                        min: 6,
			                        max: 30,
			                        message: 'The Confirm Password must be more than 6 and less than 30 characters long'
			                    }
			                }
			            }, 
			            usertype: {
			                validators: {
			                    notEmpty: {
			                        message: 'The UserType is required'
			                    }
			                }
			            },
			        }
			    });
			});
			</script>
	<div id="mainboard-wrapper" >
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-9 col-xs-12" id="divlist">
					<div class="row">
						<div class="col-md-12">
							<?php if(validation_errors()) {?>
								<div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h5 class="text-center"><?php echo validation_errors(); ?></h5>
								</div>
							<?php } ?>
							<?php if($this->session->flashdata('addAccount')) {?>
								<div class="alert alert-success alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h5 class="text-center"><?php echo $this->session->flashdata('addAccount'); ?></h5>
								</div>
							<?php } ?>
							<?php if($this->session->flashdata('error')) {?>
								<div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h5 class="text-center"><?php echo $this->session->flashdata('error'); ?></h5>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="container main_content" >
