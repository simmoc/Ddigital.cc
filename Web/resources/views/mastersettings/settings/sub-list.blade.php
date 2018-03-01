@extends($layout)
@section('header_scripts')

@stop
@section('content')

<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<section class="content-header">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
							<li><a href="{{URL_SETTINGS_LIST}}"> {{ getPhrase('settings')}}</a>  </li>
							@if($record->slug=='payu'||$record->slug=='paypal'||$record->slug=='offline-payment')
							<li><a href="{{URL_SETTINGS_VIEW."payment-gateways"}}"> {{ getPhrase('payment_gateways')}}</a> </li>
							@endif
							<li>{{ $title }}</li>
						</ol>
					</div>
				</div>
				</section>
								
				<!-- /.row -->
				<div class="panel panel-custom col-lg-10 col-lg-offset-1">
					<div class="panel-heading">
						
						<div class="pull-right messages-buttons">
							
							 
						</div>
						<h1>{{ $title }}

						</h1>

					</div>
					<div class="panel-body packages">
					<div class="row">
						@if($record->image)
						<img src="{{IMAGE_PATH_SETTINGS.$record->image}}" width="100" height="100">
						@endif
					</div>
					
					@if( $sub_list->count() > 0 )
					<div > 
					<table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>{{ getPhrase('module')}}</th>
								<th>{{ getPhrase('key')}}</th>
								<th>{{ getPhrase('description')}}</th>
								<th>{{ getPhrase('action')}}</th>
							</tr>
							@foreach( $sub_list->get() as $records )
							<tr role="row" class="odd">
								<td class="sorting_1">
								<a href="{{ URL_SETTINGS_VIEW . $records->slug }}">{{ucwords($records->title)}}</a></td>
								<td>{{ $records->key }}</td>
								<td></td>
								<td><a href="{{URL_SETTINGS_EDIT . $records->slug}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>&nbsp; &nbsp;<a href="{{ URL_SETTINGS_VIEW.$records->slug }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
							</tr>
							@endforeach
						</thead>
						 
					</table>
					</div>
					@else
					{!! Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'PATCH', 
						'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')) !!}
						<div class="row"> 
						<ul class="list-group">
						@if(count($settings_data))

						@foreach($settings_data as $key=>$value)
						<?php 
							$type_name = 'text';

							if($value->type == 'number' || $value->type == 'email' || $value->type=='password')
								$type_name = 'text';
							else
								$type_name = $value->type;
						?>
						@include(
									'mastersettings.settings.sub-list-views.'.$type_name.'-type', 
									array('key'=>$key, 'value'=>$value)
								)
						  @endforeach

						  @else
							  <li class="list-group-item">{{ getPhrase('no_settings_available')}}</li>
						  @endif
						</ul>

						</div>

						 

						@if(count($settings_data))
						<div class="buttons text-center clearfix">
							<button class="btn btn-lg btn-primary button" ng-disabled='!formTopics.$valid'
							>{{ getPhrase('update') }}</button>
						</div>
						@endif
							{!! Form::close() !!}
							{{-- @if($record->slug=='id-card-settings')
							
							@include('mastersettings.settings.id-card-templates')
							@elseif($record->slug=='site-settings')
							@include('mastersettings.settings.theme-layouts')
							@endif --}}
						@endif

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
@endsection
 

@section('footer_scripts')
  <script src="{{JS}}bootstrap-toggle.min.js"></script>
@stop
