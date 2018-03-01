@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

 <!-- Content Header (Page header) -->
 @if(checkRole(getUserGrade(2)))
    <section class="content-header">
    <div class="row">
  <div class="col-md-12">
    <ol class="breadcrumb">
      <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{ getPhrase('Home') }}</a> </li>
      <li><a  href="{{URL_PRODUCTS_DASHBOARD}}">{{ getPhrase('products_dashboard')}}</a></li>         
      <li class="active">{{isset($title) ? $title : ''}}</li>
    </ol>
  </div>
</div>

</section>
@endif
    @if(Auth::user()->role_id == VENDOR_ROLE_ID)
   <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
            </div>
        </div>
    </section>
  
  
  <!--SECTION cart DASHBOARD-2-->
    <section class="dashboard2">
  <div class="container">
  
    <h2>{{ getPhrase('my_dashboard') }}</h2>
    @include('productvendor.menu', array('sub_active' => '$sub_active', 'tab' => 'products'))
    
    <div class="alert alert-success">{{ getPhrase('admin_commission : ') }} {{ getSetting('admin_commission_for_a_vendor_product', 'site_settings')}} %</div>
    
    <div class="box-header pull-right">
         <a href="{{URL_PRODUCTS_ADD}}" class="btn btn-primary ">{{ getPhrase('Add') }}</a>
         <a href="{{URL_IMPORT.'product'}}" class="btn btn-primary">{{ getPhrase('import') }}</a>
        </div>
     
    <div id="history" class="tab-pane fade in active">
    <div class="row">
    <div class="col-md-12 col-md-12 col-xs-12">
    <div class="table-responsive">
    <table id="example2" class="table table-responsive table-bordered table-hover datatable">
      <thead>
      <tr>
    <th>{{ getPhrase('Title') }}</th>
        <th>{{ getPhrase('product_owner') }}</th>
    <th>{{ getPhrase('Price') }}</th>
        <th>{{ getPhrase('Image') }}</th>
        <th>{{ getPhrase('Status') }}</th>
    <th>{{ getPhrase('approve_status') }}</th>
        <th>{{ getPhrase('Action') }}</th>
      </tr>
      </thead>
      <tbody>
      
      </tbody>
      
      </table>
    </div>
    </div>
    </div>
       </div>
    </div>
  
  </section>
  @else
  <!-- Main content -->
    <section class="content">
     
      <div class="row">
          <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             <div class="panel-heading">
                    
                        <div class="pull-right messages-buttons">
                            <a href="{{URL_PRODUCTS_ADD}}" class="btn btn-primary pull-right">{{ getPhrase('Add') }}</a>
                             
                        </div>
                        <h2>{{ $title }}</h2>
                    </div>
    
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
          <th>{{ getPhrase('Title') }}</th>
          <th>{{ getPhrase('product_owner') }}</th>
          <th>{{ getPhrase('Price') }}</th>
          <th>{{ getPhrase('Image') }}</th>
          <th>{{ getPhrase('Status') }}</th>
          <th>{{ getPhrase('approve_status') }}</th>
          <th>{{ getPhrase('Action') }}</th>
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
          <!-- /.box -->
        </div>
        <!-- /.col -->
     
      <!-- /.row -->
    </section>

 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;">{{getPhrase('product_approve_status')}}</h4>
      </div>
      <div class="modal-body">
      {!!Form::open(array('url'=> URL_PRODUCT_ADMIN_APPROVE,'method'=>'POST','name'=>'userstatus'))!!} 

      <span><h4 id="message" style="text-align: center; color: #3c8dbc;"></h4></span>

        <input type="hidden" name="product_id" id="product_id" >
      
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary" >Yes</button>
      </div>
      {!!Form::close()!!}
    </div>

  </div>
</div>


    <!-- /.content -->
  @endif

 @endsection
 
@section('footer_scripts')
@include('common.datatables',array('route'=>URL_PRODUCTS_LIST,'route_as_url'=>TRUE)) 
<script >
   
    function approveProduct(productid)
    {
      $('#product_id').val(productid);
      
      message = '{{ getPhrase('are_you_sure_to_make_approve_this_product')}}?'; 
      
      $('#message').html(message);

      $('#myModal').modal('show');
    }

   
  
 </script>
@include('common.deletescript', array('route' => URL_PRODUCTS_DELETE))
@stop
