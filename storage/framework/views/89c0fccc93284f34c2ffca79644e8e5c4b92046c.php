<?php $__env->startSection('content'); ?>

<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<section class="content-header">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
						 <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"> <?php echo e(getPhrase('home')); ?></i></a> </li>
              <li><a href="<?php echo e(URL_PRODUCTS_DASHBOARD); ?>"> <?php echo e(getPhrase('products_dashboard')); ?></a> </li>
              <li><a href="<?php echo e(URL_PRODUCTS); ?>"><?php echo e(getPhrase('products')); ?></a> </li>
              <li><a href="<?php echo e(URL_PRODUCT_DETAILS.$product_details->id); ?>"><?php echo e($product_details->name); ?> <?php echo e(getPhrase('dashboard')); ?></a> </li>
              <li><?php echo e($product_details->name); ?> <?php echo e(getPhrase('categories')); ?></li>
						</ol>
					</div>
				</div>
				</section>
								
				<!-- /.row -->
				

						<?php if(Auth::user()->role_id == VENDOR_ROLE_ID): ?>
	
	
	<!--SECTION cart DASHBOARD-2-->
    <section class="dashboard2">
        <div class="container">
            <h2><?php echo e(getPhrase('my_dashboard')); ?></h2>
			<?php echo $__env->make('productvendor.menu', array('sub_active' => $sub_active, 'tab' => 'products'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<div class="box-header">
			<a href="<?php echo e(URL_PRODUCTS_ADD); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('Add')); ?></a>
            </div>
			<div id="history" class="tab-pane fade in active">
				
				<table id="example2" class="table table-bordered table-hover datatable">
					<thead>
								<tr>
									<th><?php echo e(getPhrase('sno')); ?></th>
									<th><?php echo e(getPhrase('product_name')); ?></th>
									<th><?php echo e(getPhrase('category')); ?></th>
									
									<th><?php echo e(getPhrase('status')); ?></th>
									
								</tr>
							</thead>
							<?php $sno = 1; ?>
							<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							 <?php $category_details  = App\Category::where('id','=',$category->category_id)
							                                          ->get()->first();

                              ?>
							<tr>
								<td><?php echo e($sno++); ?></td>
								<td><?php echo e($product_details->name); ?></td>
								<td><?php echo e($category_details->title); ?></td>
								<td><?php echo e($category_details->status); ?></td>
								
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
				  </table>
			</div>
		</div>
	</section>
	<?php else: ?> 

	                <div class="panel panel-custom">
					<div class="panel-heading">
					<div>
						
						<h2><?php echo e($product_details->name); ?>-<?php echo e(getPhrase('categories_list')); ?></h2>

						</div>
					
					<div class="panel-body packages" id="myForm">
						<div> 
						<table class="table table-striped table-bordered student-attendance-table datatable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php echo e(getPhrase('s.no', 'upper')); ?></th>
									<th><?php echo e(getPhrase('product_name')); ?></th>
									<th><?php echo e(getPhrase('category')); ?></th>
									
									<th><?php echo e(getPhrase('status')); ?></th>
									
								</tr>
							</thead>
							<?php $sno = 1; ?>
							<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							 <?php $category_details  = App\Category::where('id','=',$category->category_id)
							                                          ->get()->first();

                              ?>
							<tr>
								<td><?php echo e($sno++); ?></td>
								<td><?php echo e($product_details->name); ?></td>
								<td><?php echo e($category_details->title); ?></td>
								<td><?php echo e($category_details->status); ?></td>
								
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</table>

						<?php endif; ?>
						</div>
						
					</div>
				</div>

			</div>
		</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>