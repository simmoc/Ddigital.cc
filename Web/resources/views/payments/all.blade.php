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
		  <li class="active">{{isset($title) ? $title : ''}}</li>
		</ol>
	  </div>
	</div>
	</section>
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
          <th>{{ getPhrase('product') }}</th>         
          <th>{{ getPhrase('price') }}</th>         
          <th>{{ getPhrase('owner_name') }}</th>         
          <th>{{ getPhrase('coupon_code') }}</th>
          <th>{{ getPhrase('discount') }}</th>
          <th>{{ getPhrase('licence_name') }}</th>
          <th>{{ getPhrase('licence_amount') }}</th>         
          <th>{{ getPhrase('paid_amount') }}</th>
          <th>{{ getPhrase('payment_gateway') }}</th>
          <th>{{ getPhrase('date') }}</th>
					<th>{{ getPhrase('customer_email') }}</th>
					
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
    <!-- /.content -->

 @endsection
 
@section('footer_scripts')
@include('common.datatables',array('route'=>URL_TOTAL_SALES_GETLIST,'route_as_url'=>TRUE)) 
@stop
