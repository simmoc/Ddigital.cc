<?php $__env->startSection('header_scripts'); ?>
<link href="<?php echo e(CSS); ?>ajax-datatables.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

 <!-- Content Header (Page header) -->
    
	 <!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="row">
	  <div class="col-lg-12">
		<ol class="breadcrumb">
		  <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('Home')); ?></a> </li> 
		<li><a  href="<?php echo e(URL_OFFERS); ?>"><?php echo e(getPhrase('offers')); ?></a></li>  		  
		  <li class="active"><?php echo e(isset($title) ? $title : ''); ?></li>
		</ol>
	  </div>
	</div>
	</section>
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="box">
            <div class="box-header">
              <a href="<?php echo e(URL_OFFERS); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('List')); ?></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"><strong><?php echo e(getPhrase('Title')); ?></strong> <span class="pull-right"><?php echo e($record->title); ?></span></a></li>
				
				<li><a href="#"><strong><?php echo e(getPhrase('Slug')); ?></strong> <span class="pull-right"><?php echo e($record->slug); ?></span></a></li>			
                
                <li><a href="#"><strong><?php echo getPhrase('Description'); ?> </strong><span class="pull-right"><?php echo e($record->description); ?></span></a></li>
				
				<li><a href="#"><strong><?php echo e(getPhrase('Image')); ?></strong><span class="pull-right"><?php echo e($record->image); ?></span></a></li>
				
				<?php
				$product = App\Product::where('id', '=',$record->product_id )->first();
				?>
                <li><a href="#"><strong><?php echo e(getPhrase('Product')); ?></strong><span class="pull-right"><?php echo e($product->name); ?></span></a></li>
				
                <li><a href="#"><strong><?php echo e(getPhrase('use_product_title')); ?></strong><span class="pull-right"><?php echo e(ucfirst( $record->use_product_title )); ?></span></a></li>
				
				<li><a href="#"><strong><?php echo e(getPhrase('use_product_description')); ?></strong><span class="pull-right"><?php echo e(ucfirst( $record->use_product_description )); ?></span></a></li>
				
				<li><a href="#"><strong><?php echo e(getPhrase('use_product_image')); ?></strong><span class="pull-right"><?php echo e(ucfirst( $record->use_product_image )); ?></span></a></li>
				
				<li><a href="#"><strong><?php echo e(getPhrase('start_date_time')); ?></strong><span class="pull-right"><?php echo e($record->start_date_time); ?></span></a></li>
				<li><a href="#"><strong><?php echo e(getPhrase('end_date_time')); ?></strong><span class="pull-right"><?php echo e($record->end_date_time); ?></span></a></li>				
				<li><a href="#"><strong>Status</strong><span class="pull-right"><?php echo e(ucfirst( $record->status )); ?></span></a></li>              
                <li><a href="#"><strong>Created At </strong><span class="pull-right"><?php echo e($record->created_at); ?></span></a></li>				
                <li><a href="#"><strong>Updated At</strong><span class="pull-right"><?php echo e($record->updated_at); ?></span></a></li>				
                               
              </ul>
              
            </div>

          </div>
          
        </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
 
           
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

 <?php $__env->stopSection(); ?>
 
<?php $__env->startSection('footer_scripts'); ?>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>