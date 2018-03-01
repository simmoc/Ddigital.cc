@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Tour Details  by {{ucfirst($applied_user->name)}}
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Applications</li>
      </ol>
    </section>
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="box">
            <div class="box-header">
              <a href="{{URL_APPLICATIONS}}" class="btn btn-primary pull-right">List</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="{{ASSETS}}/dist/img/user7-128x128.jpg" alt="User Avatar">
              </div>
              <?php $role = getRoleData($user->role_id);
              
              ?>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">{{$applied_user->name}}</h3>
              <h5 class="widget-user-desc">{{ucfirst(getRoleData($applied_user->role_id))}}</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"><strong>Title</strong> <span class="pull-right">{{$record->title}}</span></a></li>
                <li><a href="#"><strong>Purpose </strong><span class="pull-right">{{$record->description}}<p>&nbsp;&nbsp;</p></span></a></li>
                
                <li><a href="#"><strong>Start date of travel</strong> <span class="pull-right">{{$record->start_date}}</span></a></li>
                <li><a href="#"><strong>End date of travel </strong><span class="pull-right">{{$record->end_date}}</span></a></li>
                <li><a href="#"><strong>Mode of travel </strong><span class="pull-right">{{$record->travel_mode}}</span></a></li>
                <li><a href="#"><strong>Ticket Cost </strong><span class="pull-right">{{$record->ticket_cost}}</span></a></li>
                <li><a href="#"><strong>Cost of Airport Cab at home city </strong><span class="pull-right">{{$record->cab_cost_home}}</span></a></li>
                <li><a href="#"><strong>Cost of Airport Cab at destination city </strong><span class="pull-right">{{$record->cab_cost_destination}}</span></a></li>
                <li><a href="#"><strong>Hotel Cost </strong><span class="pull-right">{{$record->hotel_cost}}</span></a></li>
                <li><a href="#"><strong>Selected Manager </strong><span class="pull-right">{{ucfirst($manager->name)}}</span></a></li>
                <li><a href="#"><strong>Application Status </strong><span class="pull-right">{{ucfirst($record->status)}}</span></a></li>
                <li><a href="#"><strong>Updated at </strong><span class="pull-right">{{$record->updated_at}}</span></a></li>

               
              </ul>
              
            </div>

          </div>
          <?php $status = $record->status; ?>
          <div class="pull-right">
               {!! Form::open(array('url' => URL_APPLICATION_UPDATE_STATUS.$record->slug, 'method' => 'PATCH', 'files'=>'true')) !!}
                  <input type="hidden" name="application_id" value="{{$record->id}}">
                  @if($role =='employee')
                    @if($status=='draft')
                      <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    @else
                    <input type="submit" name="submit" disabled="true" value="Submitted" class="btn btn-primary">
                    @endif
                  @endif
                 
                  @if($role =='manager')
                  @if($status=='submitted')
                  <input type="submit" name="submit" value="Reject" class="btn btn-danger">
                  <input type="submit" name="submit" value="Foreword to Finance" class="btn btn-success">
                  @else
                    <input type="submit" name="submit" disabled="true" value="{{ucfirst($status)}}" class="btn btn-primary">
                    @endif
                  @endif

                  @if($role =='finance_manager')
                  @if($status=='moved_to_finance_manager')
                  <input type="submit" name="submit" value="Reject" class="btn btn-danger">
                  <input type="submit" name="submit" value="Approve" class="btn btn-success">
                  @else
                    <input type="submit" name="submit" disabled="true" value="{{ucfirst($status)}}" class="btn btn-primary">
                    @endif
                  @endif

                {!! Form::close() !!}
              </div>
          <!-- /.widget-user -->
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
