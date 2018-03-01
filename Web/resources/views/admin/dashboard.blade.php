@extends($layout)
 @section('content')
<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{ getPhrase('home') }}</a> </li>
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
                        <h4 class="card-title">{{$total_categories->count()}}</h4>
            <p class="card-text"><i class="fa fa-random"></i> Categories</p>
                    </div> <a class="card-footer text-muted" href="{{URL_CATEGORIES_DASHBOARD}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-red text-xs-center">
                    <div class="card-block">
                    <?php $total_products = App\Product::where('status','=','Active');?>
                        <h4 class="card-title">{{$total_products->count()}}</h4>
             <p class="card-text"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Products</p>
                    </div> <a class="card-footer text-muted" href="{{URL_PRODUCTS_DASHBOARD}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-blue text-xs-center">
                    <div class="card-block">
                    <?php $total_coupons = App\Coupon::where('status','=','1') ;?>
                        <h4 class="card-title">{{$total_coupons->count()}}</h4>
                   <p class="card-text"><i class="fa fa-hashtag"></i>  {{ getPhrase('coupons')}}</p>
                    </div> <a class="card-footer text-muted" href="{{URL_COUPONS}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-black text-xs-center">
                    <div class="card-block">
                    <?php $total_licences = App\Licence::where('status','=','Active');?>
                        <h4 class="card-title">{{$total_licences->count()}}</h4>
              <p class="card-text"><i class="fa fa-key" aria-hidden="true"></i> {{ getPhrase('licences')}}</p>
                    </div> <a class="card-footer text-muted" href="{{URL_LICENCES}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>

            <div class="col-md-3 ">
                <div class="card card-black text-xs-center">
                    <div class="card-block">
                    <?php $total_offers = App\Offers::where('status','=','Active');?>
                        <h4 class="card-title">{{$total_offers->count()}}</h4>
             <p class="card-text"><i class="fa fa-tags" aria-hidden="true"></i> {{ getPhrase('offers')}}</p>
                    </div> 
                    <a class="card-footer text-muted" href="{{URL_OFFERS}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-yellow text-xs-center">
                    <div class="card-block">
                    <?php $total_users = App\User::where('status','=','Active');?>
                        <h4 class="card-title">{{$total_users->count()}}</h4>
             <p class="card-text"><i class="fa fa-users" aria-hidden="true"></i> {{ getPhrase('users')}}</p>
                    </div> <a class="card-footer text-muted" href="{{URL_ADMIN_USERS_DASHBOARD}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
            
            <div class="col-md-3 ">
                <div class="card card-green text-xs-center">
                    <div class="card-block">
                        <h4 class="card-title">
             
               <i class="fa fa-cog" aria-hidden="true"></i>
            </h4>
                        <p class="card-text">{{ getPhrase('settings')}}</p>
                    </div> <a class="card-footer text-muted" href="{{URL_MASTERSETTINGS_SETTINGS}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
            
            <div class="col-md-3 ">
                <div class="card card-red text-xs-center helper_step10">
                    <div class="card-block">
                        <h4 class="card-title">

                      <i class="fa fa-file-o" aria-hidden="true"></i>
                  </h4>
                        <p class="card-text">{{ getPhrase('payment_reports')}}</p>
                    </div> <a class="card-footer text-muted" href="{{URL_PAYMENTS_DASHBOARD}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
  
            
            
             <div class="col-md-3 ">
                <div class="card card-blue text-xs-center helper_step10">
                    <div class="card-block">
                    <?php $total_sales = App\Payment_Items::select('id');?>
                        <h4 class="card-title">{{$total_sales->count()}}</h4>
          <p class="card-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ getPhrase('total_sales')}}</p>
                    </div> 
                    <a class="card-footer text-muted" href="{{URL_TOTAL_SALES}}">
                {{ getPhrase('view_all')}}
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
                    
                        <h4 class="card-title">{{currency($count)}}</h4>
          <p class="card-text"><i class="fa fa-money" aria-hidden="true"></i> </p>
                    </div> 
                    <a class="card-footer text-muted" >
                        {{ getPhrase('total_revenue')}}
                    </a> 
                   </div>
            </div>


        </div>
    </div>
</section>
@stop


@section('footer_scripts')
 @include('common.chart', array($chart_data,'ids'=>$ids))
@stop
