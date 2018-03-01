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
      <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{ getPhrase('Home') }}</a> </li>
      <li><a  href="{{URL_ADMIN_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard')}}</a></li>         
      <li><a  href="{{URL_USERS_CUSTOMER_DETAILS.$record->slug}}">{{$record->name}} {{ getPhrase('details')}}</a></li>         
      <li class="active">{{isset($title) ? $title : ''}}</li>
    </ol>
  </div>
</div>
    </section>

@if(Auth::user()->role_id == USER_ROLE_ID)
  
   <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2>{{ Auth::user()->name }}</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{URL_VENDOR_DASHBOARD}}">{{ getPhrase('dashboard') }}</a></li>
                        <li><a href="{{ URL_USERS_CUSTOMER_DETAILS.Auth::user()->slug }}">{{ getPhrase('profile') }}</a></li>
                        <li><a href="#" >{{ getPhrase('sales_list') }}</a></li>
                  </ol>
                </div>
            </div>
        </div>
    </section>
@endif

<div class="container pad">
  <div class="col-lg-12">
  <h3>{{$record->name}} {{getPhrase('downloads')}}</h3>
</div>
      <!-- Main content -->
<section class="content">
    
      <div class="row">
        <div class="col-md-12 col-xs-12 edd-download">
          <div class="box">
      
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
          <th>{{getPhrase('s.no')}}</th>
					<th>{{getPhrase('product_name')}}</th>
					{{-- <th>{{getPhrase('image')}}</th> --}}
				  <th>{{getPhrase('date')}}</th>
										
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
</div>
    <!-- /.content -->

 @endsection
 
@section('footer_scripts')
@include('common.datatables',array('route'=>URL_CUSTOMERS_DOWNLOADED_PRODUCTS_LIST.$user_slug,'route_as_url'=>TRUE)) 
{{-- @include('common.deletescript', array('route' => URL_PRODUCTS_DELETE)) --}}
@stop
