
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
            <th><h3>PRICE</h3></th>
            <th><h3 class="text-right">ACTION</h3></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($category as $row) : ?>
            <tr>
          		<td><h3><?php echo strtoupper($row->item_name); ?></h3></td>
          		<td><h3><?php echo "$ ".$row->price; ?></h3></td>
          		<td class="img-shadow "><a data-toggle="modal" data-target="<?php echo '#myModalItem'.$row->id; ?>" href="#"><img src="<?php echo base_url();?>img/edit_2.png" class="img-responsive"  align="right"/></a></td>
        	  </tr>

            <div id="<?php echo 'myModalItem'.$row->id; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Item</h4>
                  </div>
                  <div class="modal-body">
                    <form enctype="multipart/form-data"  action="<?php echo base_url().'dashboard/update_item/'.$row->id ;?>"id="updateItem" method="post" class="form-group">
                      <input type="hidden" value="<?php echo $row->category_id; ?>" name="cat_id">
                      <div class="modal-body">
                        <div class="form-group">
                          <p>Item Name</p>
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div>
                              <input type="text" value="<?php echo $row->item_name; ?>" class="form-control input-lg field" placeholder="Item Name" name="item_name">
                            </div>
                        </div>
                        <div class="form-group">
                          <p>Description</p>
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
                              <input type="text" value="<?php echo $row->description; ?>" class="form-control input-lg field" placeholder="Description" name="description">
                            </div>
                        </div>
                        <div class="form-group">
                          <p>Price</p>
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
                              <input type="decimal" value="<?php echo $row->price; ?>" class="form-control input-lg field" placeholder="Price" name="price">
                            </div>
                        </div>
                        <div class="form-group">
                          <p>Item Image</p>
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
                              <input type="file" class="form-control input-lg field" name="userfile">
                              <input type="hidden" value="<?php echo $row->filename; ?>" name="filename">
                            </div>
                        </div>
                        <button type="submit" id="menutab" class="btn btn-block btn-lg btn-success">Update</button>
                        <a href="<?php echo base_url().'discount/discount_item/'.$this->uri->segment(3).'x'.$row->id;?>" id="discount" class="btn btn-block btn-lg btn-primary">Discount Section</a>
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

<div id="myModalItem" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Item</h4>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data"  action="<?php echo base_url().'dashboard/add_item/' ;?>" id="addItems" method="post" class="form-group">
          <input type="hidden" value="<?php echo $subcat_id; ?> " name="subcat_id">
          <input type="hidden" value="<?php echo $cat_id; ?> " name="cat_id">
          <div class="modal-body">
              <p>Item Name</p>
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-list"></span></div>
                  <input type="text" class="form-control input-lg field" placeholder="Item Name" name="item_name">
                </div>
            </div>
              <p>Description</p>
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
                  <input type="text" class="form-control input-lg field" placeholder="Description" name="description">
                </div>
            </div>
              <p>Price</p>
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-share-alt"></span></div>
                  <input type="decimal" class="form-control input-lg field" placeholder="Price" name="price">
                </div>
            </div>
              <p>item Image</p>
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
                  <input type="file" class="form-control field" name="userfile">
                </div>
            </div>
            <button type="submit" id="menutab" class="btn btn-block btn-lg btn-success">Add</button>
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
    $('#addItems').formValidation({
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
                        message: 'The Item Name is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9\s]+$/,
                        message: 'The Item Name can only consist of alphabetical, number and space'
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
});
</script>