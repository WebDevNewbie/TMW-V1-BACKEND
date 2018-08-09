<br>
<input type="hidden" value="<?php echo $table_no[0]->table_no; ?>" id="num_table">
	
<ul class="kitchen">
	<div id="order_datas"></div>
</ul>
</div>
</div>
</div>
<div class="col-md-4 col-sm-4"  id="timeline" style="position:fixed;height:100%; background-color: #777777;" >
	<div class="row " id="trails">
		<div class="container ">
			<div class="row trails" style="background:#9fcb47;">
				<div class="col-md-12 col-sm-12" >
					<h3 class="text-left">Timeline for On Serve Orders</h3>
					
				</div>
			</div>
			<div class="row bg-warning scrollable-menu" style="margin-left:5px;margin-right:5px; margin-top:-19px;">
				<div class="col-md-12 col-sm-12" >
					<ul class="timeline">
						<li class="time-label">
							<span class="bg-success">
								<?php echo date('F d, Y'); ?>
							</span>
						</li>
						<div id="timeline_order"></div>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
</div>

	<script type="text/javascript">
		$(document).ready(function(e){
			$.ajaxSetup({cache:false});
			$('#order_datas').load('<?php echo base_url()."kitchen/getOrders" ; ?>'); 
			setInterval(function() { 
				$('#order_datas').load('<?php echo base_url()."kitchen/getOrders" ; ?>'); 
			}, 20000);

			$('#timeline_order').load('<?php echo base_url()."payment/timeline" ; ?>'); 
			// setInterval(function() { 
			// 	$('#timeline_order').load('<?php echo base_url()."payment/timeline" ; ?>'); 
			// }, 20000);

	    });

	    function get_order(val)
	    {
	    	$.get('<?php echo base_url()."kitchen/getOrderById"; ?>',{id:val},function ( data ){
				$('#orders').html(data);

			});
	    }
	</script>

</body>
</html>