@extends($layout)
 @section('content')
<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{ getPhrase('home') }}</a> </li>
                 <li class="active">{{isset($title) ? $title : ''}}</li>
            </ol>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="col-md-3">
                <div class="card card-green text-xs-center">
                    <div class="card-block">
                        <h4 class="card-title">
             
                <i class="fa fa-file"></i>
            </h4>
                        <p class="card-text">{{ getPhrase('online_payments')}}</p>
                    </div> <a class="card-footer text-muted" href="{{URL_ONLINE_PAYMENT_REPORTS}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-red text-xs-center">
                    <div class="card-block">
                        <h4 class="card-title">
             
               <i class="fa fa-files-o" aria-hidden="true"></i>

            </h4>
                        <p class="card-text">{{ getPhrase('offline_payment')}}</p>
                    </div> <a class="card-footer text-muted" href="{{URL_OFFLINE_PAYMENT_REPORTS}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-blue text-xs-center">
                    <div class="card-block">
                        <h4 class="card-title">
             
              <i class="fa fa-file-text-o" aria-hidden="true"></i>
            </h4>
                        <p class="card-text">{{ getPhrase('exports')}}</p>
                    </div> <a class="card-footer text-muted" href="{{URL_PAYMENT_REPORT_EXPORT}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
            <div class="col-md-3 ">
                <div class="card card-yellow text-xs-center">
                    <div class="card-block">
                        <h4 class="card-title">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>

            </h4>
                        <p class="card-text">{{ getPhrase('free_bies')}}</p>
                    </div> <a class="card-footer text-muted" href="{{URL_FREEBIES_REPORTS}}">
                {{ getPhrase('view_all')}}
              </a> </div>
            </div>
            
    </div>
</section>
<@stop

