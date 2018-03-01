 <?php $__env->startSection('content'); ?>
<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>
            </ol>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content edd-container">
    <div id="page-wrapper edd-container">
        <div class="container-fluid">
            <div class="col-md-3">
                <div class="card card-green text-xs-center">
                    <div class="card-block">
                      <?php $total_categories = App\Category::where('status','=','Active');?>
                        <h4 class="card-title"><?php echo e($total_categories->count()); ?></h4>
            <p class="card-text"><i class="fa fa-random"></i> Categories</p>
                    </div> <a class="card-footer text-muted" href="<?php echo e(URL_CATEGORIES_DASHBOARD); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-red text-xs-center">
                    <div class="card-block">
                    <?php $total_products = App\Product::where('status','=','Active');?>
                        <h4 class="card-title"><?php echo e($total_products->count()); ?></h4>
             <p class="card-text"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Products</p>
                    </div> <a class="card-footer text-muted" href="<?php echo e(URL_PRODUCTS_DASHBOARD); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-blue text-xs-center">
                    <div class="card-block">
                    <?php $total_coupons = App\Coupon::where('status','=','1') ;?>
                        <h4 class="card-title"><?php echo e($total_coupons->count()); ?></h4>
                   <p class="card-text"><i class="fa fa-hashtag"></i>  <?php echo e(getPhrase('coupons')); ?></p>
                    </div> <a class="card-footer text-muted" href="<?php echo e(URL_COUPONS); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-black text-xs-center">
                    <div class="card-block">
                    <?php $total_licences = App\Licence::where('status','=','Active');?>
                        <h4 class="card-title"><?php echo e($total_licences->count()); ?></h4>
              <p class="card-text"><i class="fa fa-key" aria-hidden="true"></i> <?php echo e(getPhrase('licences')); ?></p>
                    </div> <a class="card-footer text-muted" href="<?php echo e(URL_LICENCES); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a> </div>
            </div>

            <div class="col-md-3 ">
                <div class="card card-black text-xs-center">
                    <div class="card-block">
                    <?php $total_offers = App\Offers::where('status','=','Active');?>
                        <h4 class="card-title"><?php echo e($total_offers->count()); ?></h4>
             <p class="card-text"><i class="fa fa-tags" aria-hidden="true"></i> <?php echo e(getPhrase('offers')); ?></p>
                    </div> 
                    <a class="card-footer text-muted" href="<?php echo e(URL_OFFERS); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-yellow text-xs-center">
                    <div class="card-block">
                    <?php $total_users = App\User::where('status','=','Active');?>
                        <h4 class="card-title"><?php echo e($total_users->count()); ?></h4>
             <p class="card-text"><i class="fa fa-users" aria-hidden="true"></i> <?php echo e(getPhrase('users')); ?></p>
                    </div> <a class="card-footer text-muted" href="<?php echo e(URL_ADMIN_USERS_DASHBOARD); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a> </div>
            </div>
            
            <div class="col-md-3 ">
                <div class="card card-green text-xs-center">
                    <div class="card-block">
                        <h4 class="card-title">
             
               <i class="fa fa-cog" aria-hidden="true"></i>
            </h4>
                        <p class="card-text"><?php echo e(getPhrase('settings')); ?></p>
                    </div> <a class="card-footer text-muted" href="<?php echo e(URL_MASTERSETTINGS_SETTINGS); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a> </div>
            </div>
            
            <div class="col-md-3 ">
                <div class="card card-red text-xs-center helper_step10">
                    <div class="card-block">
                        <h4 class="card-title">

                      <i class="fa fa-file-o" aria-hidden="true"></i>
                  </h4>
                        <p class="card-text"><?php echo e(getPhrase('payment_reports')); ?></p>
                    </div> <a class="card-footer text-muted" href="<?php echo e(URL_PAYMENTS_DASHBOARD); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a> </div>
            </div>
  
            
            
             <div class="col-md-3 ">
                <div class="card card-blue text-xs-center helper_step10">
                    <div class="card-block">
                    <?php $total_sales = App\Payment_Items::select('id');?>
                        <h4 class="card-title"><?php echo e($total_sales->count()); ?></h4>
          <p class="card-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo e(getPhrase('total_sales')); ?></p>
                    </div> 
                    <a class="card-footer text-muted" href="<?php echo e(URL_TOTAL_SALES); ?>">
                <?php echo e(getPhrase('view_all')); ?>

              </a> </div>
            </div>

            
             <div class="col-md-3 ">
                <div class="card card-red text-xs-center helper_step10 no-shade">
                    <div class="card-block">
                    <?php  
                $total_amount = App\Payment_Items::join('payments','payments.id','=','payments_items.payment_id')
                                          ->join('products','products.id','=','payments_items.item_id')
                                          ->where('payments.payment_status','=','success')
                                          ->select('payments.paid_amount')->get();

                                          $count = 0;

                                    foreach ($total_amount as $amount) {
                                        
                                        $count +=$amount->paid_amount; 
                                    }
                    ?>
                    
                        <h4 class="card-title"><?php echo e(currency($count)); ?></h4>
          <p class="card-text"><i class="fa fa-money" aria-hidden="true"></i> </p>
                    </div> 
                    <a class="card-footer text-muted" >
                        <?php echo e(getPhrase('total_revenue')); ?>

                    </a> 
                   </div>
            </div>


        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
 <?php echo $__env->make('common.chart', array($chart_data,'ids'=>$ids), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>