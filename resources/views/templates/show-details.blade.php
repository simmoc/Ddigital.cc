@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ $record->title }}</h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL_DASHBOARD }}"><i class="fa fa-dashboard"></i> {{ getPhrase('Home') }}</a></li>
        
        <li class="active">{{ $title }}</li>
      </ol>
    </section>
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="{{URL_TEMPLATES}}" class="btn btn-primary pull-right">{{ getPhrase('List') }}</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"><strong>Title</strong> <span class="pull-right">{{$record->title}}</span></a></li>
				<li><a href="#"><strong>Slug</strong> <span class="pull-right">{{$record->slug}}</span></a></li>
				
                <li><a href="#"><strong>Type </strong><span class="pull-right">{{$record->type}}<p>&nbsp;&nbsp;</p></span></a></li>
                
                <li><a href="#"><strong>Subject</strong> <span class="pull-right">{{$record->subject}}</span></a></li>
                <li><a href="#"><strong>Content </strong><span class="pull-right">{{$record->content}}</span></a></li>
                <li><a href="#"><strong>From Email </strong><span class="pull-right">{{$record->from_email}}</span></a></li>
                <li><a href="#"><strong>From Name</strong><span class="pull-right">{{ ucfirst($record->from_name) }}</span></a></li>
              
                <li><a href="#"><strong>Created At </strong><span class="pull-right">{{$record->created_at}}</span></a></li>
                <li><a href="#"><strong>Updated At</strong><span class="pull-right">{{$record->updated_at}}</span></a></li>
				<?php $updater = getUserRecord($record->record_updated_by);
				if ($updater != null) {
				?>
                <li><a href="#"><strong>Last updated by</strong><span class="pull-right">{{ $updater->name }}</span></a></li>
				<?php } ?>
                <li><a href="#"><strong>Updated at </strong><span class="pull-right">{{$record->updated_at}}</span></a></li>

               
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
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

 @endsection
 
@section('footer_scripts')
 
@stop
