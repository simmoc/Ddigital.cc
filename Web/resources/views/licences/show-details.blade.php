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
      <li><a  href="{{URL_LICENCES_DASHBOARD}}">{{ getPhrase('licences_dashboard')}}</a></li>
       <li><a  href="{{URL_LICENCES}}">{{ getPhrase('licences_list')}}</a></li>          
      <li class="active">{{isset($title) ? $title : ''}}</li>
    </ol>
  </div>
</div>
</section>

      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="{{URL_LICENCES}}" class="btn btn-primary pull-right">{{ getPhrase('List') }}</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12 col-xs-12 edd-cupons">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"><strong>{{ getPhrase('Title') }}</strong> <span class="pull-right">{{$record->title}}</span></a></li>
				<li><a href="#"><strong>{{ getPhrase('Slug') }}</strong> <span class="pull-right">{{$record->slug}}</span></a></li>
				
                <li><a href="#"><strong>{{ getPhrase('Description') }} </strong><span class="pull-right">{{$record->description}}<p>&nbsp;&nbsp;</p></span></a></li>
                
                
				<li><a href="#"><strong>{{ getPhrase('Status') }} </strong><span class="pull-right">{{$record->status}}</span></a></li>
				
                <li><a href="#"><strong>{{ getPhrase('Created At') }} </strong><span class="pull-right">{{$record->created_at}}</span></a></li>
                <li><a href="#"><strong>{{ getPhrase('Updated At') }}</strong><span class="pull-right">{{$record->updated_at}}</span></a></li>

               
              </ul>
              
            </div>

          </div>
          
        </div>
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
 
@stop
