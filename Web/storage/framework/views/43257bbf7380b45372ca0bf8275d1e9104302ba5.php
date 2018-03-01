<?php $__env->startSection('header_scripts'); ?>
<link href="<?php echo e(CSS); ?>ajax-datatables.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div id="page-wrapper" ng-controller="payments_report">
            <div class="container-fluid">
                <!-- Page Heading -->
                <section class="content-header">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>
                            <?php if($payment_mode=='online'): ?>
                            <li><a href="<?php echo e(URL_ONLINE_PAYMENT_REPORTS); ?>"><?php echo e($payments_mode); ?></a> </li>
                            <?php else: ?>
                            <li><a href="<?php echo e(URL_OFFLINE_PAYMENT_REPORTS); ?>"><?php echo e($payments_mode); ?></a> </li>
                            <?php endif; ?>
                           
                            <li><?php echo e($title); ?></li>
                        </ol>
                    </div>
                </div>
                </section>
                                
                <!-- /.row -->
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h1><?php echo e($title); ?></h1>
                    </div>
                    <div class="panel-body packages">
                        <div> 
                        <table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo e(getPhrase('image')); ?></th>
                                    <th><?php echo e(getPhrase('user_name')); ?></th>
                                    <th><?php echo e(getPhrase('paid_amount')); ?></th>
                                    <th><?php echo e(getPhrase('payment_details')); ?></th>
                                    <th><?php echo e(getPhrase('updated_at')); ?></th>
                                    <th><?php echo e(getPhrase('payment_status')); ?></th>
                                    <th><?php echo e(getPhrase('product_details')); ?></th>
                                    
                                </tr>
                            </thead>
                             
                        </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
<?php echo Form::open(array('url' => URL_PAYMENT_APPROVE_OFFLINE_PAYMENT, 'method' => 'POST', 'name'=>'formQuiz ',  )); ?>

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e(getPhrase('offline_payment_details')); ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-8 col-md-offset-2" id="details">
              
           </div>
        </div>
      </div>
      <div class="modal-footer">
      <button class="btn btn-lg btn-success button" name="submit" value="approve" ><?php echo e(getPhrase('approve')); ?></button>
      <button class="btn btn-lg btn-danger button" name="submit" value="reject" ><?php echo e(getPhrase('reject')); ?></button>
        <button type="button" class="btn btn-lg btn-default button" data-dismiss="modal"><?php echo e(getPhrase('close')); ?></button>
      </div>
    </div>
<?php echo Form::close(); ?>

  </div>
</div>

 <div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e(getPhrase('product_details')); ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-8 col-md-offset-2" id="product_details">
              
           </div>
        </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-lg btn-default button" data-dismiss="modal"><?php echo e(getPhrase('ok')); ?></button>
      </div>
    </div>

  </div>
</div>


        </div>

       
<?php $__env->stopSection(); ?>

 
<?php $__env->startSection('footer_scripts'); ?>
  
 <?php echo $__env->make('common.datatables', array('route'=>$ajax_url, 'route_as_url' => TRUE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<script>
function viewDetails(record_id)
{    

  
	$.ajax({
		url : '<?php echo e(URL_GET_PAYMENT_RECORD); ?>',
		method:'post',
		data:{
			_token:'<?php echo e(Session::token()); ?>',
			record_id:record_id
		},
		dataType: 'html',
	}).done(function (data) {
		
	$('#details').html(data);
	    $('#myModal').modal('show');
	}).fail(function () {
		alert('Posts could not be loaded.');
	});
	
}

function viewProductDetails(record_id)
{    
  
    $.ajax({
        url : '<?php echo e(URL_GET_PAYMENT_PRODUCT_DETAILS); ?>',
        method:'post',
        data:{
            _token:'<?php echo e(Session::token()); ?>',
            record_id:record_id
        },
        dataType: 'html',
    }).done(function (data) {
        
    $('#product_details').html(data);
        $('#myModal1').modal('show');
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
    
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>