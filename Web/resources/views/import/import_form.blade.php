@extends($layout)

@section('content')

  @if(checkRole(getUserGrade(2)))

 <!-- Content Header (Page header) -->
  <section class="content-header">

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{ getPhrase('home') }}</a> </li>
			@if( $model == 'category' )
				<li><a  href="{{URL_CATEGORIES_DASHBOARD}}">{{ getPhrase('categories_dashboard')}}</a></li>
				<li><a  href="{{URL_CATEGORIES}}">{{ getPhrase( $prev_title )}}</a></li>
			@elseif( $model == 'product' )
				<li><a  href="{{URL_PRODUCTS_DASHBOARD}}">{{ getPhrase('products_dashboard')}}</a></li>
				<li><a  href="{{URL_PRODUCTS}}">{{ getPhrase( $prev_title )}}</a></li>
			@elseif( $model == 'user' )
				<li><a  href="{{URL_ADMIN_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard')}}</a></li>
				<li><a  href="{{URL_USERS."all"}}">{{ getPhrase( $prev_title )}}</a></li>
			@endif
			<li class="active">{{isset($title) ? $title : ''}}</li>
		</ol>
	</div>
</div>
</section>

@endif

 <!-- Main content -->
  @if(checkRole(getUserGrade(2)))

<section class="content">
  <div class="row">
	<!-- left column -->
	<div class="col-md-10 col-md-offset-1">
	  <!-- general form elements -->
	  <div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title">{{$title}}</h3>
		</div>

		@include('errors.errors') 
		<!-- /.box-header -->
		{!! Form::open(array('url' => URL_IMPORT_READEXCEL . $model, 'method' => 'POST', 'name'=>'formName', 'files'=>'true')) !!}
		
		     <div class="box-body">
			 
			 <div class="col-md-12">
			 <?php
			 $link_title = getPhrase('Download template here');
			 ?>
				@if( $model == 'category' )
					<a href="{{ UPLOADS_EXCEL_TEMPLATES_CATEGORIES_TEMPLATE }}">{{ $link_title }}</a>
				@elseif( $model == 'product' )
					<a href="{{ UPLOADS_EXCEL_TEMPLATES_PRODUCTS_TEMPLATE }}">{{ $link_title }}</a>
				@elseif( $model == 'user' )
					<a href="{{ UPLOADS_EXCEL_TEMPLATES_USERS_TEMPLATE }}">{{ $link_title }}</a>
				@endif
			 </div>
		<div class="col-md-12">
			<div class="form-group">
				{{ Form::label('excel', getPhrase( 'excel' ) ) }} {!! required_field(); !!}
				{{ Form::file('excel', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Introduction Offer' ),'accept'=>'.xls,.xlsx', 
				'data-toggle' => 'tooltip',
				'ng-model'=>'excel',
				'required'=> 'true',
				'ng-class'=>'{"has-error": formName.excel.$touched && formName.excel.$invalid}',
				)) }}
				<div class="validation-error" ng-messages="formName.excel.$error" >
					{!! getValidationMessage()!!}
				</div>
			</div>
		</div>		
		
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary">{{ getPhrase('Import') }}
                   </button></div>
              </div>
		
		{!! Form::close() !!}
	  
	   
	  </div>
	  <!-- /.box -->


	</div>
	<!--/.col (left) -->
  
  </div>
  <!-- /.row -->
</section>

@else
<section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
            </div>
        </div>
    </section>


     <section class="dashboard2">
        <div class="container">
        
            <h2>{{ getPhrase('my_dashboard') }}</h2>
			@include('productvendor.menu', array('sub_active' => '$sub_active', 'tab' => 'products'))
			
			<div class="alert alert-success">{{ getPhrase('admin_commission : ') }} {{ getSetting('admin_commission_for_a_vendor_product', 'site_settings')}} %</div>
			
			<div class="row">
	<!-- left column -->
	<div class="col-md-12 edd-import">
	  <!-- general form elements -->
	  <div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title">{{$title}}</h3>
		</div>

		@include('errors.errors') 
		<!-- /.box-header -->
		{!! Form::open(array('url' => URL_IMPORT_READEXCEL . $model, 'method' => 'POST', 'name'=>'formName', 'files'=>'true')) !!}
		
		     <div class="box-body">
			 
			 <div class="col-md-12">
			 <?php
			 $link_title = getPhrase('Download template here');
			 ?>
				@if( $model == 'category' )
					<a href="{{ UPLOADS_EXCEL_TEMPLATES_CATEGORIES_TEMPLATE }}">{{ $link_title }}</a>
				@elseif( $model == 'product' )
					<a href="{{ UPLOADS_EXCEL_TEMPLATES_PRODUCTS_TEMPLATE }}">{{ $link_title }}</a>
				@elseif( $model == 'user' )
					<a href="{{ UPLOADS_EXCEL_TEMPLATES_USERS_TEMPLATE }}">{{ $link_title }}</a>
				@endif
			 </div>
		<div class="col-md-12">
			<div class="form-group">
				{{ Form::label('excel', getPhrase( 'excel' ) ) }} {!! required_field(); !!}
				{{ Form::file('excel', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Introduction Offer' ),'accept'=>'.xls,.xlsx', 
				'data-toggle' => 'tooltip',
				'ng-model'=>'excel',
				'required'=> 'true',
				'ng-class'=>'{"has-error": formName.excel.$touched && formName.excel.$invalid}',
				)) }}
				<div class="validation-error" ng-messages="formName.excel.$error" >
					{!! getValidationMessage()!!}
				</div>
			</div>
		</div>		
		
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary">{{ getPhrase('Import') }}
                   </button></div>
              </div>
		
		{!! Form::close() !!}
	  
	   
	  </div>
	  <!-- /.box -->


	</div>
	<!--/.col (left) -->
  
  </div>
           
			
      
            </div>
		
	</section>


	@endif

  
    <!-- /.content -->
@stop
 