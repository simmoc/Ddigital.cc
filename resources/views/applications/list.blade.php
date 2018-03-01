@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Tour Applications
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Applications</li>
      </ol>
    </section>
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="{{URL_APPLICATIONS_ADD}}" class="btn btn-primary pull-right">Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
                <th>Tour Title</th>
          <th>Name</th>
					<th>Email</th>
					<th>Role</th>
          <th>Status</th>
          <th>Slug</th>
					<th>Action</th>
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
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

 @endsection
 
@section('footer_scripts')
 @include('common.datatables',array('route'=>URL_APPLICATIONS_LIST,'route_as_url'=>TRUE))
 {{-- @include('common.deletescript', array('route'=>URL_USERS_DELETE)) --}}
@stop
