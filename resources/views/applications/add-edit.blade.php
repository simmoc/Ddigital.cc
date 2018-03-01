@extends($layout)
@section('header_scripts')
<link rel="stylesheet" href="{{ASSETS}}plugins/datepicker/datepicker3.css">
@stop
@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tour Management
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{PREFIX}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{URL_APPLICATIONS}}"> Tours</a></li>
        <li class="active">{{$title}}</li>
      </ol>

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

            <?php $button_name = 'Create'; ?>
@if ($record)
<?php $button_name = 'Update'; ?>
{{ Form::model($record, 
array('url' => URL_APPLICATIONS_EDIT.$record->slug, 
'method'=>'patch','name'=>'formUsers ', 'files'=>'true' )) }}
@else
{!! Form::open(array('url' => URL_APPLICATIONS_ADD, 'method' => 'POST', 'name'=>'formUsers ', 'files'=>'true')) !!}
@endif

@include('applications.form_elements', array('button_name'=> $button_name, 'record' => $record, 'roles'=>$managers ))

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
 
<script src="{{ASSETS}}plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
  //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
</script>
@stop