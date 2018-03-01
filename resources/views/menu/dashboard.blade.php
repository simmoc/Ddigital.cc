@extends($layout)

@section('content')
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
     <!-- Main content -->
    <section class="content">

    <div id="page-wrapper">
      <div class="container-fluid">
      <div class="col-md-3">
            <div class="card card-green text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
             
              <i class="fa fa-list" aria-hidden="true"></i>

            </h4>

                <p class="card-text">{{ getPhrase('list')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_LICENCES}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-red text-xs-center">
              <div class="card-block">
           
              <h4 class="card-title">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>


            </h4>

                <p class="card-text">{{ getPhrase('add')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_LICENCES_ADD}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

      </div> 
   </div>
    </section>
    <!-- /.content -->
@endsection