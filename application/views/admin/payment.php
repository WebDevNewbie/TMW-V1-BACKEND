
		<input type="hidden" value="<?php echo $table_no[0]->table_no; ?>" id="num_table">
			<?php //for($x = 1 ; $x <= $table_no[0]->table_no ; $x++){ ?>
				<!-- <div class="col-md-3 col-sm-4 col-xs-6">
					<a href="<?php echo base_url().'payment/table/'.$x; ?>" class="thumbnail"  style="text-decoration:none;" id="tbl">
						<img src="<?php echo base_url().'img/payment.jpg' ;?>" class="img-responsive" alt="Cinque Terre" style="width:100%; height:150px;"> 
						<div id="tblnumber">
							<h4><strong>Table <?php echo $x;?></strong></h4>
						</div>
						<br>
						<div id="tblstatus">
							<div id="cooking_status<?php echo $x; ?>"></div>
						</div>
					</a>
				</div> -->
			<?php //} ?>
	<div class="panel panel-default " style="height:100%;position:fixed;width:98%;margin-top:-10px;margin-left:-25px;background:#434343;">
		<div class="panel-body " style="overflow-y:scroll;height:100%; padding-bottom:140px">
			<table class="table table-bordered table-border">
			    <thead>
			      	<tr>
			        	<th><h5 style="font-size:22px;">Receipt No. / Table Number</h5></th>
			        	<th><h5 style="font-size:22px;">Dine Type<h5></th>
			        	<th><h5 style="font-size:22px;">Status</h5></th>
			        	<th><h5 style="font-size:22px;">Action</h5></th>
			      	</tr>
			    </thead>
			    <tbody id="order_datas">
			    </tbody>
		  	</table>
		</div>
	</div>
</div>
</div>
</div>


	<script type="text/javascript">
		$(document).ready(function(e){
			$.ajaxSetup({cache:false});
			$('#order_datas').load('<?php echo base_url()."payment/getOrders" ; ?>'); 
			setInterval(function() { 
				$('#order_datas').load('<?php echo base_url()."payment/getOrders" ; ?>'); 
			}, 10000);

			$('#timeline_order').load('<?php echo base_url()."payment/timeline" ; ?>'); 
			setInterval(function() { 
				$('#timeline_order').load('<?php echo base_url()."payment/timeline" ; ?>'); 
			}, 20000);

	    });
	</script>

</body>
</html>