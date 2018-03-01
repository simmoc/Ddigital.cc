	<script src="<?php echo e(JS); ?>bootstrap-toggle.min.js"></script>
 	<script src="<?php echo e(JS); ?>jquery.dataTables.min.js"></script>
	<script src="<?php echo e(JS); ?>dataTables.bootstrap.min.js"></script>
	
	<?php 	$routeValue= $route; ?> 

	<?php if(!isset($route_as_url)): ?>
	{
		<?php $routeValue =  route($route); ?>
	}
	<?php endif; ?>
	
	<?php  
	$setData = array();
		if(isset($table_columns))
		{
			foreach($table_columns as $col) {
				$temp['data'] = $col;
				$temp['name'] = $col;
				array_push($setData, $temp);
			}
			$setData = json_encode($setData);
		}
	?>
 

  <script>

  var tableObj;
  
    $(document).ready(function(){
    	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
		});
    	
   		 tableObj = $('.datatable').DataTable({
	            processing: true,
	            serverSide: true,
	            cache: true,
	            type: 'GET',
				<?php if(isset($frontend)): ?>
				sDom: '<"top">rt<"bottom"p><"clear">',
				fnDrawCallback: function() {
					$(".datatable thead").remove();
				},
				<?php endif; ?>
	            ajax: '<?php echo e($routeValue); ?>',
	            <?php if(isset($table_columns)): ?>
	            columns: <?php echo $setData; ?>

	            <?php endif; ?>
	    });
    });
  </script>