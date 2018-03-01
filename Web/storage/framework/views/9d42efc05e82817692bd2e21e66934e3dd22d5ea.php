<?php $__env->startSection('header_scripts'); ?>
<link href="<?php echo e(CSS); ?>ajax-datatables.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

 <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <ol class="breadcrumb">
        <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('Home')); ?></a></li>
        
        <li class="active"><?php echo e(getPhrase('Templates')); ?></li>
        
      </ol>
        </div>
    </section>
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
               <div class="panel-heading">
                    
                        <div class="pull-right messages-buttons">
                            <a href="<?php echo e(URL_TEMPLATES_ADD); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('Add')); ?></a>
                             
                        </div>
                        <h2><?php echo e($title); ?></h2>
                    </div>
		
		
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
					<th><?php echo e(getPhrase('Title')); ?></th>
					<th><?php echo e(getPhrase('Type')); ?></th>
					<?php if(isset($parent) && $parent == ''): ?>
					<th><?php echo e(getPhrase('Template Type')); ?></th>
					<?php endif; ?>
					<th><?php echo e(getPhrase('Subject')); ?></th>
					<th><?php echo e(getPhrase('From Email')); ?></th>
					<th><?php echo e(getPhrase('From Name')); ?></th>
					<th><?php echo e(getPhrase('Action')); ?></th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
 
           
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
  
      <!-- /.row -->
    </section>
    <!-- /.content -->

 <?php $__env->stopSection(); ?>
 
<?php $__env->startSection('footer_scripts'); ?>
 <?php if($parent == ''): ?>
	<?php echo $__env->make('common.datatables',array('route'=>URL_TEMPLATES_LIST,'route_as_url'=>TRUE, 'params' => array('parent' => $parent)), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php else: ?>
	 <?php echo $__env->make('common.datatables',array('route'=>URL_TEMPLATES_LIST . '/' . $parent,'route_as_url'=>TRUE, 'params' => array('parent' => $parent)), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php endif; ?>
 
 <?php echo $__env->make('common.deletescript', array('route'=>URL_TEMPLATES_DELETE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>