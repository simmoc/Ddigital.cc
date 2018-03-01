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
      <li><a  href="{{URL_CATEGORIES_DASHBOARD}}">{{ getPhrase('categories_dashboard')}}</a></li>         
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

             <div class="panel-heading">
                    
                        <div class="pull-right messages-buttons">
			@if(isset($parent) && $parent != '')
			<a href="{{URL_CATEGORIES}}" class="btn btn-primary pull-right">{{ getPhrase('List') }}</a>
			@endif
			<span>&nbsp;&nbsp;</span><a href="{{URL_CATEGORIES_ADD}}" class="btn btn-primary pull-right">{{ getPhrase('Add') }}</a>
			<span>&nbsp;&nbsp;</span><a href="{{URL_IMPORT . 'category'}}" class="btn btn-primary pull-right">{{ getPhrase('Import') }}</a>
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
					
					@if(isset($parent) && $parent == '')
					<th>{{ getPhrase('Sub-Cats') }}</th>
					@endif
					
					<th>{{ getPhrase('Status') }}</th>
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
	@include('common.datatables',array('route'=>URL_CATEGORIES_LIST,'route_as_url'=>TRUE, 'params' => array('parent' => $parent)))
 @else
	 @include('common.datatables',array('route'=>URL_CATEGORIES_LIST . '/' . $parent,'route_as_url'=>TRUE, 'params' => array('parent' => $parent)))
 @endif
 
 @include('common.deletescript', array('route'=>URL_CATEGORIES_DELETE))
@stop
