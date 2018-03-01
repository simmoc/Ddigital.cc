@extends($layout)

@section('header_scripts')

@stop

@section('content')
<div id="page-wrapper" >
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li><a  href="{{URL_SETTINGS_DASHBOARD}}">{{ getPhrase('master_settings')}}</a></li>
							<li><a href="{{URL_MODULEHELPERS_LIST}}">{{ getPhrase('modules_helper')}}</a> </li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
					@include('errors.errors')
				<!-- /.row -->
				
			 <div class="panel panel-custom col-lg-12">
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							<a href="{{URL_MODULEHELPERS_LIST}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>
						</div>

					<h1>{{ $title }}  </h1>
					</div>

					<div class="panel-body" ng-controller="angTopicsController">
					<?php $button_name = getPhrase('create'); ?>
					@if($record)
					
					 <?php $button_name = getPhrase('update'); ?>
						{{ Form::model($record, 
						array('url' => URL_MODULEHELPERS_EDIT.$record->slug, 
						'method'=>'patch', 'name'=>'formQuiz ', 'novalidate'=>'', 'files'=>'true')) }}
					@else
						{!! Form::open(array('url' => URL_MODULEHELPERS_ADD, 'method' => 'POST', 
						'name'=>'formQuiz ', 'novalidate'=>'', 'files'=>'true')) !!}
					@endif
					
					 @include('mastersettings.module-helper.form_elements', 
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
  <script src="{{JS}}bootstrap-toggle.min.js"></script>

 @include('common.validations')
	
@stop
 