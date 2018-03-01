@extends($layout)

@section('content')
 <section class="content-header">
     <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"> {{getPhrase('home')}}</i></a> </li>
              <li><a href="{{URL_PRODUCTS_DASHBOARD}}"> {{getPhrase('products_dashboard')}}</a> </li>
              <li><a href="{{URL_PRODUCTS}}">{{getPhrase('products')}}</a> </li>
              <li>{{$product_details->name}} {{getPhrase('details')}}</li>
                         
            </ol>
          </div>
        </div>
</section>


 @if(Auth::user()->role_id == VENDOR_ROLE_ID)
  
  
  <!--SECTION cart DASHBOARD-2-->
    <section class="dashboard2">
        <div class="container">
            <h2>{{ getPhrase('my_dashboard') }}</h2>
      @include('productvendor.menu', array('sub_active' => $sub_active, 'tab' => 'products'))
      <div class="box-header">
      <a href="{{URL_PRODUCTS_ADD}}" class="btn btn-primary pull-right">{{ getPhrase('Add') }}</a>
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
                {{$categories_count}}</span>
            </h4>

                <p class="card-text">{{ getPhrase('categories')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_PRODUCT_CATEGORIES.$product_id}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-blue text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
           
                <i class="fa fa-credit-card" aria-hidden="true"></i><span><br/>
          <?php $sales_count = App\Payment_Items::where('item_id',$product_id)->get()->count();?>
               {{$sales_count}}</span>


            </h4>

                <p class="card-text">{{ getPhrase('sales')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_PRODUCTS_SALES.$product_id}}">
                {{ getPhrase('view_all')}}
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
                {{$final_amount}}</span>

            </h4>

                <p class="card-text">{{ getPhrase('amount')}}</p>
              </div>
                <a class="card-footer text-muted" 
                   href="{{URL_PRODUCTS_SALES.$product_id}}">
                    {{ getPhrase('view_all')}}
                </a>
             
            </div>
          </div>

      </div> 
   </div>
    </section>
      </div>
    </div>
  </section>
  @else
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
                {{$categories_count}}</span>
            </h4>

                <p class="card-text">{{ getPhrase('categories')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_PRODUCT_CATEGORIES.$product_id}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-blue text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
          
          <i class="fa fa-credit-card" aria-hidden="true"></i><span><br/>
          <?php $sales_count = App\Payment_Items::where('item_id',$product_id)->get()->count();?>
               {{$sales_count}}</span>


            </h4>

                <p class="card-text">{{ getPhrase('sales')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_PRODUCTS_SALES.$product_id}}">
                {{ getPhrase('view_all')}}
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
                {{currency($final_amount)}}</span>

            </h4>

                <p class="card-text">{{ getPhrase('amount')}}</p>
              </div>
                <a class="card-footer text-muted" 
                   href="{{URL_PRODUCTS_SALES.$product_id}}">
                    {{ getPhrase('view_all')}}
                </a>
              
            </div>
          </div>

      </div> 
   </div>
    </section>

    @endif
    <!-- /.content -->
@stop

@section('footer_scripts')

 @include('common.chart', array($chart_data,'ids' => array('myChart1')));

@stop
