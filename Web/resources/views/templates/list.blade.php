@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <ol class="breadcrumb">
        <li><a href="{{ URL_DASHBOARD }}"><i class="fa fa-home"></i> {{ getPhrase('Home') }}</a></li>
        
        <li class="active">{{ getPhrase('Templates') }}</li>
        
      </ol>
        </div>
    </section>
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
               <div class="panel-heading">
                    
                        <div class="pull-right messages-buttons">
                            <a href="{{URL_TEMPLATES_ADD}}" class="btn btn-primary pull-right">{{ getPhrase('Add') }}</a>
                             
                        </div>
                        <h2>{{ $title }}</h2>
                    </div>
		
		
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
					<th>{{ getPhrase('Title') }}</th>
					<th>{{ getPhrase('Type') }}</th>
					@if(isset($parent) && $parent == '')
					<th>{{ getPhrase('Template Type') }}</th>
					@endif
					<th>{{ getPhrase('Subject') }}</th>
					<th>{{ getPhrase('From Email') }}</th>
					<th>{{ getPhrase('From Name') }}</th>
					<th>{{ getPhrase('Action') }}</th>
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
 @if($parent == '')
	@include('common.datatables',array('route'=>URL_TEMPLATES_LIST,'route_as_url'=>TRUE, 'params' => array('parent' => $parent)))
 @else
	 @include('common.datatables',array('route'=>URL_TEMPLATES_LIST . '/' . $parent,'route_as_url'=>TRUE, 'params' => array('parent' => $parent)))
 @endif
 
 @include('common.deletescript', array('route'=>URL_TEMPLATES_DELETE))
@stop
