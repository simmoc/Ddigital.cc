@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
<div class="container">
@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <div class="row">
  <div class="col-lg-12">
    <ol class="breadcrumb">
      <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{ getPhrase('Home') }}</a> </li>
      <li><a  href="{{URL_ADMIN_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard')}}</a></li>         
      <li><a  href="{{URL_USERS_CUSTOMER_DETAILS.$record->slug}}">{{$record->name}} {{ getPhrase('details')}}</a></li>         
      <li class="active">{{isset($title) ? $title : ''}}</li>
    </ol>
  </div>
</div>
      
    </section>
    
  
      <!-- Main content -->

      @if(Auth::user()->role_id == VENDOR_ROLE_ID)
  
  
  <!--SECTION cart DASHBOARD-2-->
    <section class="dashboard2">
        <div class="container">
            <div class="col-lg-12 head-title">
                <h3>{{$record->name}} {{getPhrase('purchases')}}</h3>
            </div>
            <h2>{{ getPhrase('my_dashboard') }}</h2>
      @include('productvendor.menu', array('sub_active' => $sub_active, 'tab' => 'products'))
      <div class="box-header">
      <a href="{{URL_PRODUCTS_ADD}}" class="btn btn-primary pull-right">{{ getPhrase('Add') }}</a>
            </div>
      <div id="history" class="tab-pane fade in active">
        
        <table id="example2" class="table table-bordered table-hover datatable">
          <thead>
                <tr>
         <th>{{ getPhrase('user_name')}}</th>
        <th>{{ getPhrase('paid_amount')}}</th>
        <th>{{ getPhrase('payment_details')}}</th>
        <th>{{ getPhrase('updated_at')}}</th>
        <th>{{ getPhrase('payment_status')}}</th>
        <th>{{ getPhrase('product_details')}}</th>
          
                </tr>
                </thead>
                <tbody>
                
                </tbody>
          
          </table>
      </div>
    </div>
  </section>
  @else
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
      
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
        <th>{{ getPhrase('user_name')}}</th>
        <th>{{ getPhrase('paid_amount')}}</th>
        <th>{{ getPhrase('payment_details')}}</th>
        <th>{{ getPhrase('updated_at')}}</th>
        <th>{{ getPhrase('payment_status')}}</th>
        <th>{{ getPhrase('product_details')}}</th>
          
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
 
           
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
          <!-- /.box -->
        </div>
        <!-- /.col -->
     
      <!-- /.row -->
    </section>

    @endif
    <!-- /.content -->

 @endsection
</div>
@section('footer_scripts')
@include('common.datatables',array('route'=>URL_VENDOR_PURCHASES_LIST.$user_slug,'route_as_url'=>TRUE)) 
<script>
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
