<?php $__env->startSection('content'); ?>
 <section class="content-header">
 <div class="row">
  <div class="col-lg-12">
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('Home')); ?></a> </li>
      <li class="active"><?php echo e(isset($title) ? $title : ''); ?></li>
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
       
              <i class="fa fa-list" aria-hidden="true"></i>

            </h4>

                <p class="card-text"><?php echo e(getPhrase('list')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_PRODUCTS); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-red text-xs-center">
              <div class="card-block">
  
              <h4 class="card-title">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>


            </h4>

                <p class="card-text"><?php echo e(getPhrase('add')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_PRODUCTS_ADD); ?>">
                <?php echo e(getPhrase('create')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-blue text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
        
            <i class="fa fa-download" aria-hidden="true"></i>

            </h4>

                <p class="card-text"><?php echo e(getPhrase('import')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_IMPORT.'product'); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

      </div> 
   </div>
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>