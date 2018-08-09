    
    <?php if($note) { ?>
      <div class="alert alert-success fade in" role="alert" id="note">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo '<strong>'.$note.'</strong>'; ?>
      </div>
    <?php }?>
  <div class="panel panel-default " style="height:100%;margin:-30px;margin-top:-10px;background:#434343;">
    <div class="panel-body " style="overflow-y:scroll;height:100%; ">
      <table class="table table-bordered table-border">
        <thead>
          <tr>
            <th><h3>NAME</h3></th>
            <th><h3 class="text-right">ACTION</h3></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($category as $row) : ?>
            <tr>
              <td><h3><?php echo strtoupper($row->category_name); ?></h3></td>
              <td class="img-shadow "><a data-toggle="modal" data-target="<?php echo '#myModal'.$row->id; ?>" href="#"><img src="<?php echo base_url();?>img/edit_2.png" class="img-responsive"  align="right"/></a></td>
            </tr>
            <div id="<?php echo 'myModal'.$row->id; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Category</h4>
                  </div>
                  <div class="modal-body">
                    <form enctype="multipart/form-data"  action="<?php echo base_url().'dashboard/update_category' ;?>" id="editFormCategory" method="post" class="form-group">
                      <input type="hidden" value="<?php echo $row->id; ?>" name="cat_id">
                      <div class="modal-body">
                          <p>Category Name</p>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div>
                              <input type="text" value="<?php echo $row->category_name; ?>" class="form-control input-lg field" placeholder="Category Name" name="category_name">
                            </div>
                        </div>
                          <p>Description</p>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
                              <input type="text" value="<?php echo $row->description; ?>" class="form-control input-lg field" placeholder="Description" name="description">
                            </div>
                        </div>
                          <p>Category Image</p>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
                              <input type="file" class="form-control input-lg field" name="userfile">
                              <input type="hidden" value="<?php echo $row->filename; ?>" name="filename">
                            </div>
                        </div>
                        <button type="submit" id="menutab" class="btn btn-block btn-success btn-lg">Update</button>
                      </div>    
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
  	</div>
  </div>
  </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data"  action="<?php echo base_url().'dashboard/add_category' ;?>" id="registerNewCategory" method="post" class="form-group">
          <div class="modal-body">
              <p>Category Name</p>
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div>
                  <input type="text" class="form-control input-lg field" placeholder="Category Name" name="category_name">
                </div>
            </div>
              <p>Description</p>
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
                  <input type="text" class="form-control input-lg field" placeholder="Description" name="description">
                </div>
            </div>
              <p>Category Image</p>
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
                  <input type="file" class="form-control input-lg field" name="userfile">
                </div>
            </div>
            <button type="submit" id="menutab" class="btn btn-block btn-success">Add</button>
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
