

<?php if($note) { ?>
<br/>
  <div class="alert alert-success fade in" role="alert" id="note">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo '<strong>'.$note.'</strong>'; ?>
  </div>
<?php }?>
	<div class="panel panel-default " style="height:100%;position:fixed;width:73%;margin-top:-10px;margin-left:-25px;background:#434343;">
		<div class="panel-body " style="overflow-y:scroll;height:100%; padding-bottom:170px">
			<?php foreach ($category as $row) :?>
					 
				<div class="col-md-4 col-sm-6 col-xs-12">
					<a href="<?php echo base_url().'dashboard/category/'.$row->id; ?>" class="thumbnail"  style="text-decoration:none;">
						<img src="<?php if($row->path === 0 || $row->path === NULL || $row->path === ''){ echo base_url().'category_img/food.jpeg'; }else{ echo base_url().$row->path.$row->filename; } ?>" class="img-responsive" style="height:140px; width:100%;"> 
						<div id="opah">
							<h4 class="text-center"><?php echo $row->category_name; ?></h4>
						</div> 
					</a>
				</div> 

			<?php endforeach; ?>
		</div>
	</div>

	</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Add Category</h5>
			</div>
			<div class="modal-body">
				<form enctype="multipart/form-data" role="form" action="<?php echo base_url().'dashboard/add_category' ;?>" id="registerNewCategory" method="post" class="form-group">
					<div class="modal-body">
							<p>Category Name</p>
						<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div>
									<input type="text" class="form-control input-lg field" placeholder="Category Name" name="category_name" >
								</div>
						</div>
							<p>Description</p>
						<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
									<input type="text" class="form-control input-lg field" placeholder="Description" name="description" >
									
								</div>
								<p class="help-block with-errors"></p>
						</div>
							<p>Category Image</p>
						<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
									<input type="file" class="form-control input-lg field" name="userfile">
									
								</div>
								<p class="help-block with-errors"></p>
						</div>
						<button type="submit" id="menutab" class="btn btn-block btn-success btn-lg">Add</button>
					</div>		
				</form>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	setTimeout(function(){
			$( "#note" ).fadeOut( "slow" );
		}, 5000);
    $('#registerNewCategory').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            category_name: {
                validators: {
                    notEmpty: {
                        message: 'The Category Name is required'
                    },
		            regexp: {
		                regexp: /^[a-zA-Z0-9\s]+$/,
		                message: 'The Category Name can only consist of alphabetical, number and space'
		            }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'The Description is required'
                    },
		            regexp: {
		                regexp: /^[a-zA-Z0-9\s]+$/,
		                message: 'The Description can only consist of alphabetical, number and space'
		            }

                }
            }
        }
    });
});
</script>