<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AZAZA POS</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
					<?php if(validation_errors()) {?>
						<div class="alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4 class="text-center"><?php echo validation_errors(); ?></h4>
						</div>
					<?php } ?>
					<?php if($this->session->flashdata('error')) {?>
						<div class="alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4 class="text-center"><?php echo $this->session->flashdata('error'); ?></h4>
						</div>
					<?php } ?>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>AZAZA</strong> pos</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to pos</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="<?php echo base_url('home/login'); ?>" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="username">Username</label>
			                        	<input type="text" name="username" placeholder="Username..." class="username form-control" id="username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="password form-control" id="password">

			                        </div>
			                        <button type="submit" class="btn">Sign in</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
          <!--Modal Message-->
       <div class="modal hide fade" id="Modal1" >
				<div class="modal-header">
				   <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px">×</button>
			  </div>
			  <div class="modal-body">
				   <h2>Invalid Username or Password</h2>
			  </div>
			  <div class="modal-footer">
			  </div>
		</div>
		<div class="modal hide fade" id="Modal2" >
				<div class="modal-header">
				   <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px">×</button>
			  </div>
			  <div class="modal-body">
				   <h2>Wrong Username or Password</h2>
			  </div>
			  <div class="modal-footer">
			  </div>
		</div>
        </div>
        <!-- Javascript -->
        <script src="<?php echo base_url();?>js/jquery.js"></script>
        <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url();?>js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
