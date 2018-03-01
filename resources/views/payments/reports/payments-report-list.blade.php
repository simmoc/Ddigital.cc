@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

<div id="page-wrapper" ng-controller="payments_report">
            <div class="container-fluid">
                <!-- Page Heading -->
                <section class="content-header">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
                            @if($payment_mode=='online')
                            <li><a href="{{URL_ONLINE_PAYMENT_REPORTS}}">{{$payments_mode}}</a> </li>
                            @else
                            <li><a href="{{URL_OFFLINE_PAYMENT_REPORTS}}">{{$payments_mode}}</a> </li>
                            @endif
                           
                            <li>{{ $title }}</li>
                        </ol>
                    </div>
                </div>
                </section>
                                
                <!-- /.row -->
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="panel-body packages">
                        <div> 
                        <table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ getPhrase('image')}}</th>
                                    <th>{{ getPhrase('user_name')}}</th>
                                    <th>{{ getPhrase('paid_amount')}}</th>
                                    <th>{{ getPhrase('payment_details')}}</th>
                                    <th>{{ getPhrase('updated_at')}}</th>
                                    <th>{{ getPhrase('payment_status')}}</th>
                                    <th>{{ getPhrase('product_details')}}</th>
                                    
                                </tr>
                            </thead>
                             
                        </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
{!! Form::open(array('url' => URL_PAYMENT_APPROVE_OFFLINE_PAYMENT, 'method' => 'POST', 'name'=>'formQuiz ',  )) !!}
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{getPhrase('offline_payment_details')}}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-8 col-md-offset-2" id="details">
              
           </div>
        </div>
      </div>
      <div class="modal-footer">
      <button class="btn btn-lg btn-success button" name="submit" value="approve" >{{ getPhrase('approve') }}</button>
      <button class="btn btn-lg btn-danger button" name="submit" value="reject" >{{ getPhrase('reject') }}</button>
        <button type="button" class="btn btn-lg btn-default button" data-dismiss="modal">{{ getPhrase('close')}}</button>
      </div>
    </div>
{!! Form::close() !!}
  </div>
</div>

 <div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{getPhrase('product_details')}}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-8 col-md-offset-2" id="product_details">
              
           </div>
        </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-lg btn-default button" data-dismiss="modal">{{ getPhrase('ok')}}</button>
      </div>
    </div>

  </div>
</div>


        </div>

       
@endsection

 
@section('footer_scripts')
  
 @include('common.datatables', array('route'=>$ajax_url, 'route_as_url' => TRUE))
 {{-- @include('payments.scripts.js-scripts'); --}}
<script>
function viewDetails(record_id)
{    

  
	$.ajax({
		url : '{{URL_GET_PAYMENT_RECORD}}',
		method:'post',
		data:{
			_token:'{{ Session::token() }}',
			record_id:record_id
		},
		dataType: 'html',
	}).done(function (data) {
		
	$('#details').html(data);
	    $('#myModal').modal('show');
	}).fail(function () {
		alert('Posts could not be loaded.');
	});
	
}

function viewProductDetails(record_id)
{    
  
    $.ajax({
        url : '{{URL_GET_PAYMENT_PRODUCT_DETAILS}}',
        method:'post',
        data:{
            _token:'{{ Session::token() }}',
            record_id:record_id
        },
        dataType: 'html',
    }).done(function (data) {
        
    $('#product_details').html(data);
        $('#myModal1').modal('show');
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
    
}
</script>
@stop
