<?php $__env->startSection('header_scripts'); ?>
<link href="<?php echo e(CSS); ?>ajax-datatables.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

 <!-- Content Header (Page header) -->
    <section class="content-header">
      
     <div class="row">
  <div class="col-lg-12">
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('Home')); ?></a> </li>
      <li><a  href="<?php echo e(URL_CATEGORIES_DASHBOARD); ?>"><?php echo e(getPhrase('categories_dashboard')); ?></a></li>         
      <li class="active"><?php echo e(isset($title) ? $title : ''); ?></li>
    </ol>
  </div>
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
			<?php if(isset($parent) && $parent != ''): ?>
			<a href="<?php echo e(URL_CATEGORIES); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('List')); ?></a>
			<?php endif; ?>
			<span>&nbsp;&nbsp;</span><a href="<?php echo e(URL_CATEGORIES_ADD); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('Add')); ?></a>
			<span>&nbsp;&nbsp;</span><a href="<?php echo e(URL_IMPORT . 'category'); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('Import')); ?></a>
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
					
					<?php if(isset($parent) && $parent == ''): ?>
					<th><?php echo e(getPhrase('Sub-Cats')); ?></th>
					<?php endif; ?>
					
					<th><?php echo e(getPhrase('Status')); ?></th>
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
	<?php echo $__env->make('common.datatables',array('route'=>URL_CATEGORIES_LIST,'route_as_url'=>TRUE, 'params' => array('parent' => $parent)), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php else: ?>
	 <?php echo $__env->make('common.datatables',array('route'=>URL_CATEGORIES_LIST . '/' . $parent,'route_as_url'=>TRUE, 'params' => array('parent' => $parent)), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php endif; ?>
 
 <?php echo $__env->make('common.deletescript', array('route'=>URL_CATEGORIES_DELETE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>