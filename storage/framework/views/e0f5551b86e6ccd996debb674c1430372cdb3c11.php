 
 <?php $__env->startSection('header_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 
 <?php if(checkRole(getUserGrade(7))): ?>
 <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2><?php echo e(Auth::user()->name); ?></h2>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(URL_USERS_DASHBOARD); ?>"><?php echo e(getPhrase('dashboard')); ?></a></li>
                        <li><?php echo e(getPhrase('profile')); ?></li>
                        
                  </ol>
                </div>
            </div>
        </div>
    </section>
 <?php endif; ?>


<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->

				<?php if(checkRole(getUserGrade(2))): ?>
				<div>
				    <section class="content-header">
                     <div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
						<li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a></li>
						<li><a href="<?php echo e(URL_ADMIN_USERS_DASHBOARD); ?>"><?php echo e(getPhrase('users_dashboard')); ?></a></li>
						<li><a href="<?php echo e(URL_USERS.'user'); ?>"><?php echo e(getPhrase('customers')); ?></a></li>
							<li><?php echo e($title); ?> </li>
						</ol>
					</div>
				
				</div>
				</section>
				</div>
				<?php endif; ?>
                    <?php if(checkRole(getUserGrade(7))): ?>
                  <section class="dashboard2">
                   <div class="container">
                  <h2><?php echo e(getPhrase('my_dashboard')); ?></h2>
			          <?php echo $__env->make('customer.menu', array('sub_active' => $sub_active, 'tab' => 'dashborad'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			       <?php endif; ?>
                     <div class="panel panel-custom">
				 	<div class="panel-heading">						
				 	<h1><?php echo e(getPhrase('details_of').' '.$record->name); ?></h1>	
				 </div>
					<div class="panel-body">
						<div class="profile-details text-center">
							<div class="profile-img"><img src="<?php echo e(getProfilePath($record->image,'profile')); ?>" alt="" width="100" height="100"></div>
							<div class="aouther-school">
								<h2><?php echo e($record->name); ?></h2>
								<p><span><?php echo e($record->email); ?></span></p>
								
							</div>

						</div>
						<hr>
						<h3 class="profile-details-title"><?php echo e(getPhrase('details')); ?></h3>
				<div class="row">
				<?php $login_user = Auth::user();
					?>
					<?php if($login_user->role_id!=5): ?>
						<div class="col-lg-4 col-md-4 col-xs-12">
						<div class="card card-blue text-xs-center">
						<div class="card-block">
							<h4 class="card-title"><?php echo e($purchase_items); ?></h4>
							<p class="card-text"><i class="fa fa-upload" aria-hidden="true"></i> <?php echo e(getPhrase('purchases')); ?></p>
						</div>
							<a class="card-footer text-muted" href="<?php echo e(URL_CUSTOMER_PURCHASES_LIST.$record->slug); ?>"><?php echo e(getPhrase('view_details')); ?></a>
						</div>
					</div>
					<?php endif; ?>

					<div class="col-lg-4 col-md-4 col-xs-12">
						<div class="card card-red text-xs-center">
							<div class="card-block">
							
								<h4 class="card-title"></h4>

								<h4 class="card-title"><?php echo e($customer_downloads); ?></h4>
								<p class="card-text"><i class="fa fa-flag"></i> <?php echo e(getPhrase('downloads')); ?></p>
							</div>
								<a class="card-footer text-muted" href="<?php echo e(URL_CUSTOMER_DOWLOADED_PRODUCTS.$record->slug); ?>"><?php echo e(getPhrase('view_details')); ?></a>
						</div>
					</div>

					
						<div class="col-lg-4 col-md-4 col-xs-12">
					<div class="card card-green text-xs-center">
							<div class="card-block">
							<?php $final_amount =0;
                 foreach ($total_amount as $amount) {
                    $final_amount += $amount->paid_amount;
                  }
                ?>
                  
                                 <h4 class="card-title"><?php echo e($final_amount); ?></h4>
								<p class="card-text"><i class="fa fa-money" aria-hidden="true"></i> <?php echo e(getPhrase('amount')); ?></p>
							</div>
							<?php if($login_user->role_id==5): ?>
                               <a class="card-footer text-muted" href="<?php echo e(URL_USERS_DASHBOARD.'/purchases'); ?>"><?php echo e(getPhrase('view_details')); ?></a>
                            <?php else: ?>
                            <a class="card-footer text-muted" href="<?php echo e(URL_CUSTOMER_PURCHASES_LIST.$record->slug); ?>"><?php echo e(getPhrase('view_details')); ?></a>
                            <?php endif; ?>   
                               
						</div>
						</div>
                     </div>
						 
						</div>
						 
 
					</div>
				</div>
				</section>
			<!-- /.container-fluid -->
</div>
<?php $__env->stopSection(); ?>
 

<?php $__env->startSection('footer_scripts'); ?>
 

<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>