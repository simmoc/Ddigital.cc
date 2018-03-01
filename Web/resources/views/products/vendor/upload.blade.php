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
      <li><a  href="{{URL_USERS_VENDOR_DETAILS.$record->slug}}">{{$record->name}} {{ getPhrase('details')}}</a></li>         
      <li class="active">{{isset($title) ? $title : ''}}</li>
    </ol>
  </div>
</div>


    </section>

    @if(Auth::user()->role_id == VENDOR_ROLE_ID)
	
	
	<!--SECTION cart DASHBOARD-2-->
    <section class="dashboard2">
        <div class="container">
            <div class="col-lg-12 head-title">
                <h3>{{$record->name}} {{getPhrase('products')}}</h3>
            </div>
            <h2>{{ getPhrase('my_dashboard') }}</h2>
			@include('productvendor.menu', array('sub_active' => $sub_active, 'tab' => 'products'))
			<div class="box-header">
			<a href="{{URL_PRODUCTS_ADD}}" class="btn btn-primary pull-right">{{ getPhrase('Add') }}</a>
            </div>
			<div id="history" class="tab-pane fade in active">
				
				<table id="example2" class="table table-bordered table-hover datatable">
					<thead>
					<tr>
						<!-- <th>{{ getPhrase('S.No') }}</th> -->
						<th>{{ getPhrase('Title') }}</th>
						<th>{{ getPhrase('Price') }}</th>
						<th>{{ getPhrase('Image') }}</th>
						<th>{{ getPhrase('Status') }}</th>
					</tr>
					</thead>
					<tbody>
					
					</tbody>
					
				  </table>
			</div>
		</div>
	</section>
	@else
	<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            {{-- <div class="box-header">
			<a href="{{URL_PRODUCTS_ADD}}" class="btn btn-primary pull-right">{{ getPhrase('Add') }}</a>
            </div> --}}
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
					<!-- <th>{{ getPhrase('S.No') }}</th> -->
          <th>{{ getPhrase('Title') }}</th>
					<th>{{ getPhrase('Price') }}</th>
					<th>{{ getPhrase('Image') }}</th>
					<th>{{ getPhrase('Status') }}</th>
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
	@endif

 @endsection
 
@section('footer_scripts')
@include('common.datatables',array('route'=>URL_VENDOR_UPLOAD_PRODUCTS_LIST.$record->slug,'route_as_url'=>TRUE)) 
@stop
