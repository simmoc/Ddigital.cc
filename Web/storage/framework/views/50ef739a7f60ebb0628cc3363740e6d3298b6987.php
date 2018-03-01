<?php $__env->startSection('content'); ?>
 <section class="content-header">
    <div class="row">
      <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a></li>
        <li class="active"><?php echo e($title); ?></li>
      </ol>
     </div>
     </div>
</section>
     <!-- Main content -->
    <section class="content">

    <div id="page-wrapper">
      <div class="container-fluid">
      <div class="col-md-3">
            <div class="card card-green text-xs-center">
              <div class="card-block">
       
              <h4 class="card-title">
                <?php $adminObject =  App\User::where('role_id','=',1)->get()->count();
                               
               ?>
               <?php echo e($adminObject); ?>

            </h4>

                <p class="card-text"><?php echo e(getPhrase('owners')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_USERS.'owner'); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-red text-xs-center">
              <div class="card-block">
        
              <h4 class="card-title">
                <?php $adminObject =  App\User::where('role_id','=',2)->get()->count();
                               
               ?>
               <?php echo e($adminObject); ?>

            </h4>

                <p class="card-text"><?php echo e(getPhrase('admins')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_USERS.'admin'); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-blue text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
          
                <?php $adminObject =  App\User::where('role_id','=',3)->get()->count();
                               
               ?>
               <?php echo e($adminObject); ?>

            </h4>

                <p class="card-text"><?php echo e(getPhrase('executives')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_USERS.'executive'); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-black text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
          
                <?php $adminObject =  App\User::where('role_id','=',4)->get()->count();
                               
               ?>
               <?php echo e($adminObject); ?>

            </h4>

                <p class="card-text"><?php echo e(getPhrase('vendors')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_USERS.'vendor'); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-yellow text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
        
                <?php $adminObject =  App\User::where('role_id','=',5)->get()->count();
                               
               ?>
               <?php echo e($adminObject); ?>

            </h4>

                <p class="card-text"><?php echo e(getPhrase('customers')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_USERS.'user'); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-blue text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
         
                <?php $adminObject =  App\User::get()->count();
                               
               ?>
               <?php echo e($adminObject); ?>

            </h4>

                <p class="card-text"><?php echo e(getPhrase('all_users')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_USERS.'all'); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

          <div class="col-md-3 ">
            <div class="card card-green text-xs-center helper_step10">
              <div class="card-block">
              <h4 class="card-title">
                             <i class="fa fa-user-plus" aria-hidden="true"></i>
                             <?php echo e(getPhrase('create_user')); ?>                                  
                             </h4>
              

              </div>
            <a class="card-footer text-muted" 
              href="<?php echo e(URL_USERS_ADD); ?>">
                <?php echo e(getPhrase('create')); ?>

              </a>
              
            </div>
          </div>
      </div> 
   </div>
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>