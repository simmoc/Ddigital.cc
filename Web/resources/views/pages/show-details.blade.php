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
        <li><a href="{{ URL_DASHBOARD }}"><i class="fa fa-home"></i> {{ getPhrase('Home') }}</a></li>
          <li><a href="{{ URL_PAGES_DASHBOARD }}">{{ getPhrase('Pages Dashboard') }}</a></li>
          <li><a href="{{ URL_PAGES }}">{{ getPhrase('Pages') }}</a></li>
       <li class="active">{{ $title }}</li>
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
              <a href="{{URL_PAGES}}" class="btn btn-primary pull-right">{{ getPhrase('List') }}</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12 col-xs-12 edd-cupons">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"><strong>Title</strong> <span class="pull-right">{{$record->title}}</span></a></li>
				
				<li><a href="#"><strong>Slug</strong> <span class="pull-right">{{$record->slug}}</span></a></li>			
                
                <li><a href="#"><strong>Content </strong><span class="pull-right">{{$record->description}}</span></a></li>
				
                <li><a href="#"><strong>Meta Tag Title</strong><span class="pull-right">{{ $record->meta_tag_title }}</span></a></li>
				
                <li><a href="#"><strong>Meta Tag Description</strong><span class="pull-right">{{ $record->meta_tag_description }}</span></a></li>
				
				<li><a href="#"><strong>Meta Tag Keywords</strong><span class="pull-right">{{ $record->meta_tag_keywords }}</span></a></li>
				
				<li><a href="#"><strong>Status</strong><span class="pull-right">{{ $record->status }}</span></a></li>
				
				<li><a href="#"><strong>Show in menu?</strong><span class="pull-right">{{ ucfirst($record->show_in_menu) }}</span></a></li>
              
                <li><a href="#"><strong>Created At </strong><span class="pull-right">{{$record->created_at}}</span></a></li>
				
                <li><a href="#"><strong>Updated At</strong><span class="pull-right">{{$record->updated_at}}</span></a></li>
				<?php $updater = getUserRecord($record->record_updated_by);
				if ($updater != null) {
				?>
                <li><a href="#"><strong>Last updated by</strong><span class="pull-right">{{ $updater->name }}</span></a></li>
				<?php } ?>
                               
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
