@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{ getPhrase('Home') }}</a> </li>
            <li class="active">{{isset($title) ? $title : ''}}</li>
        </ol>
    </div>
</div>
</section>
@if(Auth::user()->role_id == USER_ROLE_ID || Auth::user()->role_id == VENDOR_ROLE_ID)
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
            @if(Auth::user()->role_id == USER_ROLE_ID)
            @include('customer.menu', array('sub_active' => $sub_active, 'tab' => 'dashboard'))
            @elseif(Auth::user()->role_id == VENDOR_ROLE_ID)
            @include('productvendor.menu', array('sub_active' => $sub_active, 'tab' => 'dashboard'))
            @endif
            <div class="alert alert-success">{{ getPhrase('admin_commission : ') }} {{ getSetting('admin_commission_for_a_vendor_product', 'site_settings')}} %</div>
            
           
            <div id="history" class="tab-pane fade in active">
                
                <table id="example2" class="table table-bordered table-hover datatable digi-table">
                    <thead>
                    <th>{{ getPhrase('Title') }}</th>
                    <th>{{ getPhrase('code') }}</th>
                    <th>{{ getPhrase('discount_type') }}</th>
                    <th>{{ getPhrase('value') }}</th>
                    <th>{{ getPhrase('start_date') }}</th>
                    <th>{{ getPhrase('end_date') }}</th>
                    <th>{{ getPhrase('Status') }}</th>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    
                  </table>
            </div>
        </div>
    </section>
<!-- Main content -->
@else
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                     
                        
                     <div class="panel-heading">
                    
                        <div class="pull-right messages-buttons">
                            <a href="{{URL_COUPONS_ADD}}" class="btn btn-primary pull-right">{{ getPhrase('Add') }}</a>
                             
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
                                <th>{{ getPhrase('code') }}</th>
                                <th>{{ getPhrase('discount_type') }}</th>
                                <th>{{ getPhrase('value') }}</th>
                                <th>{{ getPhrase('start_date') }}</th>
                                <th>{{ getPhrase('end_date') }}</th>
                                <th>{{ getPhrase('Status') }}</th>
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
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endif
<!-- /.content -->

@endsection

@section('footer_scripts')
@include('common.datatables',array('route' => URL_COUPONS_LIST,'route_as_url'=>TRUE)) 
@include('common.deletescript', array('route'=>URL_COUPONS_DELETE))
@stop
