@extends($layout)
@section('header_scripts')
<link rel="stylesheet" href="{{ASSETS}}plugins/datepicker/datepicker3.css">
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
        <!-- left column -->
        <div class="col-md-10 col-md-offset-1">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$title}}</h3>
            </div>

            @include('errors.errors') 
            <!-- /.box-header -->
      
            <?php $button_name = getPhrase('create'); ?>
@if ($record)
<?php $button_name = getPhrase('update'); ?>
{{ Form::model($record, 
array('url' => URL_LICENCES_EDIT.$record->slug, 
'method'=>'patch','name'=>'formName ', 'files'=>'true' )) }}
@else
{!! Form::open(array('url' => URL_LICENCES_ADD, 'method' => 'POST', 'name'=>'formName ', 'files'=>'true')) !!}
@endif

@include('licences.form_elements', array('button_name'=> $button_name, 'record' => $record ))

{!! Form::close() !!}
          
           
          </div>
          <!-- /.box -->
 

        </div>
        <!--/.col (left) -->
      
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@stop

@section('footer_scripts')	
	@include('common.validations')
@endsection
 