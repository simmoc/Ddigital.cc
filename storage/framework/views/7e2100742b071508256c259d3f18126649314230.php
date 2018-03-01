<?php $__env->startSection('content'); ?>

  <?php if(checkRole(getUserGrade(2))): ?>

 <!-- Content Header (Page header) -->
  <section class="content-header">

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>
			<?php if( $model == 'category' ): ?>
				<li><a  href="<?php echo e(URL_CATEGORIES_DASHBOARD); ?>"><?php echo e(getPhrase('categories_dashboard')); ?></a></li>
				<li><a  href="<?php echo e(URL_CATEGORIES); ?>"><?php echo e(getPhrase( $prev_title )); ?></a></li>
			<?php elseif( $model == 'product' ): ?>
				<li><a  href="<?php echo e(URL_PRODUCTS_DASHBOARD); ?>"><?php echo e(getPhrase('products_dashboard')); ?></a></li>
				<li><a  href="<?php echo e(URL_PRODUCTS); ?>"><?php echo e(getPhrase( $prev_title )); ?></a></li>
			<?php elseif( $model == 'user' ): ?>
				<li><a  href="<?php echo e(URL_ADMIN_USERS_DASHBOARD); ?>"><?php echo e(getPhrase('users_dashboard')); ?></a></li>
				<li><a  href="<?php echo e(URL_USERS."all"); ?>"><?php echo e(getPhrase( $prev_title )); ?></a></li>
			<?php endif; ?>
			<li class="active"><?php echo e(isset($title) ? $title : ''); ?></li>
		</ol>
	</div>
</div>
</section>

<?php endif; ?>

 <!-- Main content -->
  <?php if(checkRole(getUserGrade(2))): ?>

<section class="content">
  <div class="row">
	<!-- left column -->
	<div class="col-md-10 col-md-offset-1">
	  <!-- general form elements -->
	  <div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo e($title); ?></h3>
		</div>

		<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
		<!-- /.box-header -->
		<?php echo Form::open(array('url' => URL_IMPORT_READEXCEL . $model, 'method' => 'POST', 'name'=>'formName', 'files'=>'true')); ?>

		
		     <div class="box-body">
			 
			 <div class="col-md-12">
			 <?php
			 $link_title = getPhrase('Download template here');
			 ?>
				<?php if( $model == 'category' ): ?>
					<a href="<?php echo e(UPLOADS_EXCEL_TEMPLATES_CATEGORIES_TEMPLATE); ?>"><?php echo e($link_title); ?></a>
				<?php elseif( $model == 'product' ): ?>
					<a href="<?php echo e(UPLOADS_EXCEL_TEMPLATES_PRODUCTS_TEMPLATE); ?>"><?php echo e($link_title); ?></a>
				<?php elseif( $model == 'user' ): ?>
					<a href="<?php echo e(UPLOADS_EXCEL_TEMPLATES_USERS_TEMPLATE); ?>"><?php echo e($link_title); ?></a>
				<?php endif; ?>
			 </div>
		<div class="col-md-12">
			<div class="form-group">
				<?php echo e(Form::label('excel', getPhrase( 'excel' ) )); ?> <?php echo required_field();; ?>

				<?php echo e(Form::file('excel', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Introduction Offer' ),'accept'=>'.xls,.xlsx', 
				'data-toggle' => 'tooltip',
				'ng-model'=>'excel',
				'required'=> 'true',
				'ng-class'=>'{"has-error": formName.excel.$touched && formName.excel.$invalid}',
				))); ?>

				<div class="validation-error" ng-messages="formName.excel.$error" >
					<?php echo getValidationMessage(); ?>

				</div>
			</div>
		</div>		
		
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary"><?php echo e(getPhrase('Import')); ?>

                   </button></div>
              </div>
		
		<?php echo Form::close(); ?>

	  
	   
	  </div>
	  <!-- /.box -->


	</div>
	<!--/.col (left) -->
  
  </div>
  <!-- /.row -->
</section>

<?php else: ?>
<section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2><?php echo e(Auth::user()->name); ?></h2>
                </div>
            </div>
        </div>
    </section>


     <section class="dashboard2">
        <div class="container">
        
            <h2><?php echo e(getPhrase('my_dashboard')); ?></h2>
			<?php echo $__env->make('productvendor.menu', array('sub_active' => '$sub_active', 'tab' => 'products'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			
			<div class="alert alert-success"><?php echo e(getPhrase('admin_commission : ')); ?> <?php echo e(getSetting('admin_commission_for_a_vendor_product', 'site_settings')); ?> %</div>
			
			<div class="row">
	<!-- left column -->
	<div class="col-md-12 edd-import">
	  <!-- general form elements -->
	  <div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo e($title); ?></h3>
		</div>

		<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
		<!-- /.box-header -->
		<?php echo Form::open(array('url' => URL_IMPORT_READEXCEL . $model, 'method' => 'POST', 'name'=>'formName', 'files'=>'true')); ?>

		
		     <div class="box-body">
			 
			 <div class="col-md-12">
			 <?php
			 $link_title = getPhrase('Download template here');
			 ?>
				<?php if( $model == 'category' ): ?>
					<a href="<?php echo e(UPLOADS_EXCEL_TEMPLATES_CATEGORIES_TEMPLATE); ?>"><?php echo e($link_title); ?></a>
				<?php elseif( $model == 'product' ): ?>
					<a href="<?php echo e(UPLOADS_EXCEL_TEMPLATES_PRODUCTS_TEMPLATE); ?>"><?php echo e($link_title); ?></a>
				<?php elseif( $model == 'user' ): ?>
					<a href="<?php echo e(UPLOADS_EXCEL_TEMPLATES_USERS_TEMPLATE); ?>"><?php echo e($link_title); ?></a>
				<?php endif; ?>
			 </div>
		<div class="col-md-12">
			<div class="form-group">
				<?php echo e(Form::label('excel', getPhrase( 'excel' ) )); ?> <?php echo required_field();; ?>

				<?php echo e(Form::file('excel', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Introduction Offer' ),'accept'=>'.xls,.xlsx', 
				'data-toggle' => 'tooltip',
				'ng-model'=>'excel',
				'required'=> 'true',
				'ng-class'=>'{"has-error": formName.excel.$touched && formName.excel.$invalid}',
				))); ?>

				<div class="validation-error" ng-messages="formName.excel.$error" >
					<?php echo getValidationMessage(); ?>

				</div>
			</div>
		</div>		
		
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary"><?php echo e(getPhrase('Import')); ?>

                   </button></div>
              </div>
		
		<?php echo Form::close(); ?>

	  
	   
	  </div>
	  <!-- /.box -->


	</div>
	<!--/.col (left) -->
  
  </div>
           
			
      
            </div>
		
	</section>


	<?php endif; ?>

  
    <!-- /.content -->
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>