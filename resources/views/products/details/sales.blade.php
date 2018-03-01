@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
          <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"> {{getPhrase('home')}}</i></a> </li>
              <li><a href="{{URL_PRODUCTS_DASHBOARD}}"> {{getPhrase('products_dashboard')}}</a> </li>
              <li><a href="{{URL_PRODUCTS}}">{{getPhrase('products')}}</a> </li>
              <li><a href="{{URL_PRODUCT_DETAILS.$product_details->id}}">{{$product_details->name}} {{getPhrase('dashboard')}}</a> </li>
              <li>{{$product_details->name}} {{getPhrase('sales')}}</li>
                         
            </ol>
          </div>
        </div>
    </section>
      <!-- Main content -->

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
        
        <table id="example2" class="table table-bordered table-hover datatable">
          <thead>
                <tr>
          <th>{{ getPhrase('product') }}</th>         
          <th>{{ getPhrase('product_owner') }}</th>         
          <th>{{ getPhrase('price') }}</th>         
          <th>{{ getPhrase('coupon_code') }}</th>
          <th>{{ getPhrase('discount') }}</th>
          <th>{{ getPhrase('payment_gateway') }}</th>
          <th>{{ getPhrase('date') }}</th>
          <th>{{ getPhrase('customer_name') }}</th>
          <th>{{ getPhrase('customer_email') }}</th>
                </tr>
          
                </tr>
                </thead>
                <tbody>
                
                </tbody>
          
          </table>
      </div>
    </div>
  </section>
  @else
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
      
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
           <th>{{ getPhrase('product') }}</th>         
					 <th>{{ getPhrase('product_owner') }}</th>         
          <th>{{ getPhrase('price') }}</th>         
          <th>{{ getPhrase('coupon_code') }}</th>
          <th>{{ getPhrase('discount') }}</th>
          <th>{{ getPhrase('paid_amount') }}</th>
          <th>{{ getPhrase('payment_gateway') }}</th>
          <th>{{ getPhrase('date') }}</th>
          <th>{{ getPhrase('customer_name') }}</th>
          <th>{{ getPhrase('customer_email') }}</th>
                </tr>
					
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
 
           
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
      <!-- /.row -->
    </section>

    @endif
    <!-- /.content -->

 @endsection
 
@section('footer_scripts')
@include('common.datatables',array('route'=>URL_PRODUCT_SALES_DETAILS_LIST.$product_id,'route_as_url'=>TRUE)) 
@include('common.deletescript', array('route' => URL_PRODUCTS_DELETE))
@stop
