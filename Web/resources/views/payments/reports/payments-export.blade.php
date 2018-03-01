@extends($layout)

@section('content')
<div id="page-wrapper" ng-controller="payments_report" ng-init="initAngData()">
			<div class="container-fluid">
				<!-- Page Heading -->
				<section class="content-header">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
							<li><a href="{{URL_PAYMENTS_DASHBOARD}}"> {{getPhrase('payments_dashboard')}}</a> </li>
						 
							<li class="active">{{getPhrase('export_payment_records')}}</li>
						</ol>
					</div>
				</div>
				</section>
					@include('errors.errors')
				<!-- /.row -->
				
 <div class="panel panel-custom col-lg-8 col-lg-offset-2">
 <div class="panel-heading">
 <h1>{{ $title }} </h1>
					</div>
					<div class="panel-body" >
					<?php $button_name = getPhrase('download_excel'); 

					?>
			 
					{!! Form::open(array('url' => URL_PAYMENT_REPORT_EXPORT, 'method' => 'POST', 'name'=>'formQuiz ',  )) !!}
					
					<div class="row">
					<fieldset class='form-group'>
						{{ Form::label('all_records', getphrase('all_records')) }}
						<div class="form-group row">
						<div class="col-md-3">
							{{ Form::radio('all_records', 1, true, array('id'=>'paid', 'name'=>'all_records', 'ng-model'=>'all_records')) }}
								<label for="paid"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> -->{{getPhrase('Yes')}} </label>
							</div>
							
							
						</div>
					</fieldset>

					
 					
					</div>

					<div class="row">
					 <fieldset class='form-group'>
						{{ Form::label('payment_type', getphrase('payment_type')) }}
						<div class="form-group row">
							<div class="col-md-2">
							{{ Form::radio('payment_type', 'all', true, array('id'=>'free1', 'name'=>'payment_type')) }}
								
								<label for="free1"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span>--> {{getPhrase('all')}}</label> 
							</div>
							<div class="col-md-2">
							{{ Form::radio('payment_type', 'online', false, array('id'=>'paid1', 'name'=>'payment_type')) }}
								<label for="paid1"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span>--> {{getPhrase('online')}} </label>
							</div>
							<div class="col-md-2">
							{{ Form::radio('payment_type', 'offline', false, array('id'=>'offline', 'name'=>'payment_type')) }}
								<label for="offline"><!-- <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span>--> {{getPhrase('offline')}} </label>
							</div>
						</div>
					</fieldset>
					</div>

					<div class="row">
					 <fieldset class='form-group'>
						{{ Form::label('payment_status', getphrase('payment_status')) }}
						<div class="form-group row">
							<div class="col-md-2">
							{{ Form::radio('payment_status', 'all', true, array('id'=>'payment_status_all', 'name'=>'payment_status')) }}
								
								<label for="payment_status_all"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> -->{{getPhrase('all')}}</label> 
							</div>
							<div class="col-md-2">
							{{ Form::radio('payment_status', 'success', false, array('id'=>'payment_status_success', 'name'=>'payment_status')) }}
								<label for="payment_status_success"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span>--> {{getPhrase('success')}} </label>
							</div>
							<div class="col-md-2">
							{{ Form::radio('payment_status', 'pending', false, array('id'=>'payment_status_pending', 'name'=>'payment_status')) }}
								<label for="payment_status_pending"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> -->{{getPhrase('pending')}} </label>
							</div>
							<div class="col-md-2">
							{{ Form::radio('payment_status', 'cancelled', false, array('id'=>'payment_status_cancelled', 'name'=>'payment_status')) }}
								<label for="payment_status_cancelled"><!-- <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> -->{{getPhrase('cancelled')}} </label>
							</div>
						</div>
					</fieldset>
					</div>
					
						<div class="buttons text-center">
							<button class="btn btn-lg btn-success button"
							 >{{ $button_name }}</button>
						</div>
					{!! Form::close() !!}
					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')
 @include('payments.scripts.js-scripts')

  <script src="{{JS}}bootstrap-datepicker.min.js"></script>
 <script src="{{JS}}bootstrap-toggle.min.js"></script>   
    
@stop
 
 