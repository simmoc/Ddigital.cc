@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="col-lg-12">
            <ol class="breadcrumb">
               <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
               <li><a href="{{URL_PAYMENTS_DASHBOARD}}"> {{getPhrase('payments_dashboard')}}</a> </li>
              <li>{{ $title}}</li>
            </ol>
          </div>

</section>
	<!-- Main content -->
    <section class="content">
     
      <div class="row">
          <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
          <th>{{ getPhrase('s_no') }}</th>
					<th>{{ getPhrase('name') }}</th>
					<th>{{ getPhrase('email') }}</th>
					<th>{{ getPhrase('product_name') }}</th>
					<th>{{ getPhrase('product_owner') }}</th>
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
@include('common.datatables',array('route'=>URL_FREEBIES_REPORT_LIST,'route_as_url'=>TRUE)) 
@stop
