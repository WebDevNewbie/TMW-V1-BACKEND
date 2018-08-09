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
  <script src="<?php echo base_url();?>dist/js/tap.js"></script>
 
</head>
<body >
	<!-- <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" >
					<span class="glyphicon glyphicon-cog" style="color:#fff; "></span>
				</button>
				<?php if($this->uri->segment(1) === 'kiosk_dine_in') { ?>
					<a class="navbar-brand" href="<?php echo base_url().'kiosk_dine_in';?>"><p class="pos_logo"></p></a>
				<?php }elseif($this->uri->segment(1) === 'kiosk_take_out'){ ?>
					<a class="navbar-brand" href="<?php echo base_url().'kiosk_take_out';?>"><p class="pos_logo"></p></a>
				<?php }elseif($this->uri->segment(1) === 'add_order'){ 
					$rcpt_id = $this->session->userdata('rcpt_id');
					?>
					<a class="navbar-brand" href="<?php echo base_url().'add_order/index/'.$rcpt_id['rcpt_id'];?>"><p class="pos_logo"></p></a>
				<?php } ?>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<?php if($this->uri->segment(1) !== 'add_order'){ ?>
						<li><a data-toggle="modal" data-target="#addMember"><img src="<?php echo base_url();?>img/member.png" class="img-responsive"/></a></li>
					<?php } ?>
					<li>&emsp;&emsp;</li>
					<li></li>
					<li class="dropdown">
					 <a href="<?php echo base_url();?>admin/user/logout"><img src="<?php echo base_url();?>img/off.png" class="logout img-responsive"/></a>
					</li>
				</ul>
			</div>
		</div>

	<div class="border-line1"></div>
	<div class="border-line2"></div>
	</nav> <br><br><br><br><br><br><br>-->

	<nav class="navbar navbar-inverse navbar-fixed-top" style="z-index:1;">
	  	<div class="container-fluid">
		    <div class="navbar-header">
		      	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>                        
		      	</button>
		      	<?php if($this->uri->segment(1) === 'kiosk_dine_in') { ?>
					<a class="navbar-brand" href="<?php echo base_url().'kiosk_dine_in';?>"><p class="pos_logo"></p></a>
				<?php }elseif($this->uri->segment(1) === 'kiosk_take_out'){ ?>
					<a class="navbar-brand" href="<?php echo base_url().'kiosk_take_out';?>"><p class="pos_logo"></p></a>
				<?php }elseif($this->uri->segment(1) === 'add_order'){ 
					$rcpt_id = $this->session->userdata('rcpt_id');
					?>
					<a class="navbar-brand" href="<?php echo base_url().'add_order/index/'.$rcpt_id['rcpt_id'];?>"><p class="pos_logo"></p></a>
				<?php } ?>
		    </div>
	    	<div class="collapse navbar-collapse" id="myNavbar">
		      	<ul class="nav navbar-nav navbar-right">
		        	<?php if($this->uri->segment(1) !== 'add_order'){ ?>
							<li><a data-toggle="modal" onclick="hide_order()" data-target="#addMember"><img src="<?php echo base_url();?>img/member.png" class="img-responsive" /></a></li>
						<?php } ?>
						<li>&emsp;&emsp;</li>
						<li></li>
						<li class="dropdown">
						 <a href="<?php echo base_url();?>admin/user/logout"><img src="<?php echo base_url();?>img/off.png" class="logout img-responsive"/></a>
						</li>
		      	</ul>
	    	</div>
	  	</div>
	  	<div class="border-line1"></div>
		<div class="border-line2"></div>
	</nav><br><br><br><br><br><br><br>
	<!-- Add Member Modal -->
	<div class="modal fade" id="addMember" tabindex="-1" role="dialog" aria-labelledby="addMember">
		<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h3 class="modal-title" id="myModalLabel">Membership Registration</h3>
		  </div>
		  <div class="modal-body">
			<form role="form" action="<?php echo base_url();?>home/addMember" id="addMember" method="post" >
					
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label for="fname">FirstName</label>
							<div class="input-group">
				                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
								<input type="text" name="fname" placeholder="Enter Your FirstName" class="fname form-control input-lg" id="fname" >
							</div>
						</div>
						<div class="form-group">
							<label for="mname">MiddleName</label>
							<div class="input-group">
				                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
								<input type="text" name="mname" placeholder="Enter Your MiddleName" class="mname form-control input-lg" id="mname" >
							</div>
						</div>
						<div class="form-group">
							<label for="lname">LastName</label>
							<div class="input-group">
				                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
								<input type="text" name="lname" placeholder="Enter Your LastName" class="lname form-control input-lg" id="lname" >
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label for="bday">Birthday</label>
							<div class="input-group">
				                <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
								<input type="date" class="form-control input-lg" name="bday"  id="bday">
							</div>
						</div>
						<div class="form-group">
							<label for="mnumber">Mobile No.</label>
							<div class="input-group">
				                <div class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></div>
								<input type="text" name="mnumber" placeholder="Enter Your Number" class="mnumber form-control input-lg" id="mnumber" >
							</div>
						</div>
					</div>
				</div>
			
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary btn-lg ">SAVE</button>
			<button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Close</button>
		  </form>
		  </div>
		</div>
	  </div>
	</div>

	<script>
	$(document).ready(function() {
	    $('#addMember').formValidation({
	        framework: 'bootstrap',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            fname: {
	                validators: {
	                    notEmpty: {
	                        message: 'The Firstname is required'
	                    },
	                    regexp: {
	                        regexp: /^[a-zA-Z\s]+$/,
	                        message: 'The First name can only consist of alphabetical and space'
	                    }
	                }
	            },
	            lname: {
	                validators: {
	                    notEmpty: {
	                        message: 'The Lastname is required'
	                    },
	                    regexp: {
	                        regexp: /^[a-zA-Z\s]+$/,
	                        message: 'The Last name can only consist of alphabetical and space'
	                    }
	                }
	            },
	            bday: {
	                validators: {
	                    notEmpty: {
	                        message: 'The Discount From is required'
	                    }
	                }
	            },
	            mnumber: {
	                validators: {
	                    notEmpty: {
	                        message: 'The Mobile Number is required'
	                    },
	                    numeric: {
	                        message: 'The Mobile Number must be a number'
	                    }

	                }
	            },
	        }
	    });
	});
	</script>
	<div id="mainboard-wrapper">
		<div class="container">
							<?php if(validation_errors()) {?>
								<div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h5 class="text-center"><?php echo validation_errors(); ?></h5>
								</div>
							<?php } ?>
							<?php if($this->session->flashdata('addMember')) {?>
								<div class="alert alert-success alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h5 class="text-center"><?php echo $this->session->flashdata('addMember'); ?></h5>
								</div>
							<?php } ?>
							<?php if($this->session->flashdata('error')) {?>
								<div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h5 class="text-center"><?php echo $this->session->flashdata('error'); ?></h5>
								</div>
							<?php } ?>
		<a id="animate"><img id="imgSlide" src="<?php echo base_url();?>img/gray.png" class="img-responsive" style="z-index:9999; position: fixed; top: 320px;left: 0;"/></a>
<script> 
$(document).ready(function() {
  sidebarStatus = false;
  $('#thiSide').css("display","none");
   $("#animate").click(function(){
		if(sidebarStatus == false){
				
				$('.col-md-5').css({width:"41.66666667%"});
				$('#imgSlide').css({left:"41%"});
				$('.col-md-7').css({width:"58.33333333%"});
				$('#thiSide').css("display","initial");
				$('.previewOrder').css("padding-top","30px");
				$('.previewOrder').css("background-color","#777");
				$('.previewOrder').css("margin-top","-22px");
				$('.menuCateg').css("margin-top","-30px");
				$('.menuCateg').css("padding-top","29px");
				$('.menuCateg').css("background-color","#eee");
				$('.itemSelect').css("width","50%");
				$('.kiosk').css("width","33.33333333%");
				$('.addAll').css("margin-left","75%");
				
				
			
			 sidebarStatus = true;
		}
		else{
			$('.col-md-7').css("float","right").css({width:"100%"});
			$('#imgSlide').css({left:"0"});
			$('.col-md-5').css({width:"0%"});
			$('#thiSide').css("display","none");
			$('.previewOrder').css("padding-top","30px");
			$('.previewOrder').css("background-color","#777");
			$('.previewOrder').css("margin-top","-22px");
			$('.menuCateg').css("margin-top","-30px");
			$('.menuCateg').css("padding-top","29px");
			$('.menuCateg').css("background-color","#eee");
			$('.itemSelect').css("width","25%");
			$('.addAll').css("margin-left","0%");
			$('.kiosk').css("width","25%");
			
			sidebarStatus = false;
		}
		 
	  });
  
});

function hide_order()
{
	$('.col-md-7').css("float","right").css({width:"100%"});
	$('#imgSlide').css({left:"0"});
	$('.col-md-5').css({width:"0%"});
	$('#thiSide').css("display","none");
	$('.previewOrder').css("padding-top","30px");
	$('.previewOrder').css("background-color","#777");
	$('.previewOrder').css("margin-top","-22px");
	$('.menuCateg').css("margin-top","-30px");
	$('.menuCateg').css("padding-top","29px");
	$('.menuCateg').css("background-color","#eee");
	$('.itemSelect').css("width","25%");
	$('.addAll').css("margin-left","0%");
	$('.kiosk').css("width","25%");
}

</script>
