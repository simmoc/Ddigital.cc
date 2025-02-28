@extends($layout)

@section('header_scripts')
<link rel="stylesheet" type="text/css" href="/css/select2.css">
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
							
							<li><a href="{{URL_SETTINGS_LIST}}"> {{ getPhrase('settings')}}</a> </li>
							@if($record->slug=='payu'||$record->slug=='paypal'||$record->slug=='offline-payment')
							<li><a href="{{URL_SETTINGS_VIEW."payment-gateways"}}"> {{ getPhrase('payment_gateways')}}</a> </li>
							@endif
							<li class="active"> {{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
				</section>
					@include('errors.errors')
				<!-- /.row -->
				
			 <div class="panel panel-custom col-lg-8 col-lg-offset-2">
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							<a href="{{URL_SETTINGS_LIST}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
						</div>
					<h3 class="box-title">{{$title}}</h3>
					</div>
					<div class="panel-body" ng-controller="angTopicsController">
					<?php $button_name = getPhrase('create'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('update'); ?>
						{{ Form::model($record, 
						array('url' => URL_SETTINGS_EDIT.$record->slug, 
						'method'=>'patch', 'name'=>'formQuiz ', 'novalidate'=>'', 'files'=>'true')) }}
					@else
						{!! Form::open(array('url' => URL_SETTINGS_ADD, 'method' => 'POST', 
						'name'=>'formQuiz ', 'novalidate'=>'', 'files'=>'true')) !!}
					@endif

					 @include('mastersettings.settings.form_elements', 
					 array('button_name'=> $button_name))
					 
					{!! Form::close() !!}
					 

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')
	{{-- @include('mastersettings.topics.scripts.js-scripts'); --}}
 @include('common.validations')
	
@stop
 