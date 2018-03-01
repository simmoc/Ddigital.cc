@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

 <!-- Content Header (Page header) -->
    
	 <!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="row">
	  <div class="col-lg-12">
		<ol class="breadcrumb">
		  <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{ getPhrase('Home') }}</a> </li> 
		<li><a  href="{{URL_OFFERS}}">{{ getPhrase('offers')}}</a></li>  		  
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
              <a href="{{URL_OFFERS}}" class="btn btn-primary pull-right">{{ getPhrase('List') }}</a>
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
                
                <li><a href="#"><strong>{!! getPhrase('Description') !!} </strong><span class="pull-right">{{$record->description}}</span></a></li>
				
				<li><a href="#"><strong>{{ getPhrase('Image') }}</strong><span class="pull-right">{{ $record->image }}</span></a></li>
				
				<?php
				$product = App\Product::where('id', '=',$record->product_id )->first();
				?>
                <li><a href="#"><strong>{{ getPhrase('Product') }}</strong><span class="pull-right">{{ $product->name }}</span></a></li>
				
                <li><a href="#"><strong>{{ getPhrase('use_product_title') }}</strong><span class="pull-right">{{ ucfirst( $record->use_product_title ) }}</span></a></li>
				
				<li><a href="#"><strong>{{ getPhrase('use_product_description') }}</strong><span class="pull-right">{{ ucfirst( $record->use_product_description ) }}</span></a></li>
				
				<li><a href="#"><strong>{{ getPhrase('use_product_image') }}</strong><span class="pull-right">{{ ucfirst( $record->use_product_image ) }}</span></a></li>
				
				<li><a href="#"><strong>{{ getPhrase('start_date_time') }}</strong><span class="pull-right">{{ $record->start_date_time }}</span></a></li>
				<li><a href="#"><strong>{{ getPhrase('end_date_time') }}</strong><span class="pull-right">{{ $record->end_date_time }}</span></a></li>				
				<li><a href="#"><strong>Status</strong><span class="pull-right">{{ ucfirst( $record->status ) }}</span></a></li>              
                <li><a href="#"><strong>Created At </strong><span class="pull-right">{{$record->created_at}}</span></a></li>				
                <li><a href="#"><strong>Updated At</strong><span class="pull-right">{{$record->updated_at}}</span></a></li>				
                               
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
