<!DOCTYPE html>
<html lang="en">
<head>
  <title>POS System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"> 
 <link href = "<?php echo base_url();?>dist/css/bootstrap.min.css" rel = "stylesheet"  type="text/css">
 <link href = "<?php echo base_url();?>dist/css/home.css" rel = "stylesheet"  type="text/css">
 <link href = "<?php echo base_url();?>css/datepicker.css" rel = "stylesheet"  type="text/css">
 <link href = "<?php echo base_url();?>css/sidebar.css" rel = "stylesheet"  type="text/css">
  <script src="<?php echo base_url();?>dist/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>js/datepicker.js"></script>
  <script src="<?php echo base_url();?>js/angular.min.js"></script>
  <script src="<?php echo base_url();?>validation/formValidation.min.js"></script>
  <script src="<?php echo base_url();?>validation/bootstrap.min.js"></script>
  
</head>
<body >
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" >
					<span class="glyphicon glyphicon-cog" style="color:#fff; "></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_url().'kitchen';?>"><p class="pos_logo"></p></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li>&emsp;&emsp;</li>
					<li></li>
					<li><a href="<?php echo base_url();?>admin/user/logout"><img src="<?php echo base_url();?>img/off.png" class="logout img-responsive"/></a></li>

				</ul>
			</div>

		</div>
	<div class="border-line1"></div>
	<div class="border-line2"></div>
	</nav><br><br><br><br><br><br><br>

	<div id="mainboard-wrapper">
		<div class="container">
				<a id="animate"><img id="imgSlide" src="<?php echo base_url();?>img/trail.png" class="img-responsive" style="z-index:1; position: fixed; top: 300px;right:0;"/></a>
			<div class="row" >
				<div class="col-md-8 col-sm-8" id="viewOrders">
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
					
						<div class="container main_content">
<script> 
$(document).ready(function() {
  sidebarStatus = false;
  $('#timeline').css("display","none");
   $("#animate").click(function(){
		if(sidebarStatus == false){
				
				$('#viewOrders').css({width:"66.66666667%"});
				$('#timeline').css({width:"33.33333333%"});
				$('#timeline').css("display","initial");
				$('#timeline').css("background","#777");
				$('.trails').css("border","20px solid #777");
				$('#trails').css("height","500px");
				$('#imgSlide').css({right:"33%"});
				
			
			 sidebarStatus = true;
		}
		else{
				$('#viewOrders').css({width:"100%"});
				$('#timeline').css({width:"0%"});
				$('#timeline').css("display","none");
				$('#imgSlide').css({right:"0%"});
			
			sidebarStatus = false;
		}
		 
	  });
  
});

</script>