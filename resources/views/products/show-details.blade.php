@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

 <!-- Content Header (Page header) -->
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><a href="{{PREFIX}}"><i class="fa fa-dashboard"></i> {{ getPhrase('Home') }}</a> </li>
			<li><a  href="{{URL_PRODUCTS}}">{{ getPhrase('Products')}}</a></li>					
			<li class="active">{{isset($title) ? $title : ''}}</li>
		</ol>
	</div>
</div>
      <!-- Main content -->
    <section class="content">
     <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="box">
            <div class="box-header">
              <a href="{{URL_PRODUCTS}}" class="btn btn-primary pull-right">{{ getPhrase('List') }}</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"><strong>Title</strong> <span class="pull-right">{{$record->name}}</span></a></li>
				
				@if($record->price_type == 'default')
				<li><a href="#"><strong>Price</strong> <span class="pull-right">{{$record->price}}</span></a></li>
				@else
				
				@endif
                
                @if($record->description != '')
				<li><a href="#"><strong>Content </strong><span class="pull-right">{!! $record->description !!}</span></a></li>
				@endif
				
                @if($record->meta_tag_title != '')
				<li><a href="#"><strong>Meta Tag Title</strong><span class="pull-right">{!! $record->meta_tag_title !!}</span></a></li>
				@endif
				
				@if($record->meta_tag_description != '')
                <li><a href="#"><strong>Meta Tag Description</strong><span class="pull-right">{!! $record->meta_tag_description !!}</span></a></li>
				@endif
				
				@if($record->meta_tag_keywords != '')
				<li><a href="#"><strong>Meta Tag Keywords</strong><span class="pull-right">{!! $record->meta_tag_keywords !!}</span></a></li>
				@endif
				
				<li><a href="#"><strong>Status</strong><span class="pull-right">{{ $record->status }}</span></a></li>				
				
                <li><a href="#"><strong>Created At </strong><span class="pull-right">{{$record->created_at}}</span></a></li>
				
                <li><a href="#"><strong>Updated At</strong><span class="pull-right">{{$record->updated_at}}</span></a></li>
				<?php $updater = getUserRecord($record->user_created);
				if ($updater != null) {
				?>
                <li><a href="#"><strong>Created By</strong><span class="pull-right">{{ $updater->name }}</span></a></li>
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
