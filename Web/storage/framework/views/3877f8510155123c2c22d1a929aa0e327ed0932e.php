<?php $__env->startSection('content'); ?>
 <section class="content-header">
     <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"> <?php echo e(getPhrase('home')); ?></i></a> </li>
              <li><a href="<?php echo e(URL_PRODUCTS_DASHBOARD); ?>"> <?php echo e(getPhrase('products_dashboard')); ?></a> </li>
              <li><a href="<?php echo e(URL_PRODUCTS); ?>"><?php echo e(getPhrase('products')); ?></a> </li>
              <li><?php echo e($product_details->name); ?> <?php echo e(getPhrase('details')); ?></li>
                         
            </ol>
          </div>
        </div>
</section>


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
        
        <section class="content">

    <div id="page-wrapper" class="edd-test">
      <div class="container-fluid">
      <div class="col-md-3">
            <div class="card card-green text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
                <i class="fa fa-random" aria-hidden="true"></i><span><br/>
             <?php $categories_count = App\Products_Categories::where('product_id',$product_id)->get()->count();?>
                <?php echo e($categories_count); ?></span>
            </h4>

                <p class="card-text"><?php echo e(getPhrase('categories')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_PRODUCT_CATEGORIES.$product_id); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-blue text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
           
                <i class="fa fa-credit-card" aria-hidden="true"></i><span><br/>
          <?php $sales_count = App\Payment_Items::where('item_id',$product_id)->get()->count();?>
               <?php echo e($sales_count); ?></span>


            </h4>

                <p class="card-text"><?php echo e(getPhrase('sales')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_PRODUCTS_SALES.$product_id); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-red text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
             
           <i class="fa fa-money" aria-hidden="true"></i><span><br/>

               <?php 
               $final_amount =0;
                 foreach ($total_amount as $amount) {

                    $final_amount += $amount->after_discount;
                  }
                ?>
                <?php echo e($final_amount); ?></span>

            </h4>

                <p class="card-text"><?php echo e(getPhrase('amount')); ?></p>
              </div>
                <a class="card-footer text-muted" 
                   href="<?php echo e(URL_PRODUCTS_SALES.$product_id); ?>">
                    <?php echo e(getPhrase('view_all')); ?>

                </a>
             
            </div>
          </div>

      </div> 
   </div>
    </section>
      </div>
    </div>
  </section>
  <?php else: ?>
     <!-- Main content -->
    <section class="content">

    <div id="page-wrapper">
      <div class="container-fluid">
      <div class="col-md-3">
            <div class="card card-green text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
                <i class="fa fa-random" aria-hidden="true"></i><span><br/>
             <?php $categories_count = App\Products_Categories::where('product_id',$product_id)->get()->count();?>
                <?php echo e($categories_count); ?></span>
            </h4>

                <p class="card-text"><?php echo e(getPhrase('categories')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_PRODUCT_CATEGORIES.$product_id); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-blue text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
          
          <i class="fa fa-credit-card" aria-hidden="true"></i><span><br/>
          <?php $sales_count = App\Payment_Items::where('item_id',$product_id)->get()->count();?>
               <?php echo e($sales_count); ?></span>


            </h4>

                <p class="card-text"><?php echo e(getPhrase('sales')); ?></p>
              </div>
              <a class="card-footer text-muted" 
              href="<?php echo e(URL_PRODUCTS_SALES.$product_id); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-red text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
         
           <i class="fa fa-money" aria-hidden="true"></i><span><br/>

               <?php $final_amount =0;
                 foreach ($total_amount as $amount) {
                    $final_amount += $amount->after_discount;
                  }
                ?>
                <?php echo e(currency($final_amount)); ?></span>

            </h4>

                <p class="card-text"><?php echo e(getPhrase('amount')); ?></p>
              </div>
                <a class="card-footer text-muted" 
                   href="<?php echo e(URL_PRODUCTS_SALES.$product_id); ?>">
                    <?php echo e(getPhrase('view_all')); ?>

                </a>
              
            </div>
          </div>

      </div> 
   </div>
    </section>

    <?php endif; ?>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

 <?php echo $__env->make('common.chart', array($chart_data,'ids' => array('myChart1')), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>