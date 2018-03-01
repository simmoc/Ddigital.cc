@extends($layout)

@section('content')
 <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
</section>
     <!-- Main content -->
    <section class="content">

    <div id="page-wrapper">
      <div class="container-fluid">
      <div class="col-md-3">
            <div class="card card-green text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
              <h4 class="card-title">
              <i class="fa fa-list" aria-hidden="true"></i>

            </h4>

                <p class="card-text">{{ getPhrase('list')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_PAGES}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-blue text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
              <h4 class="card-title">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>


            </h4>

                <p class="card-text">{{ getPhrase('add')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_PAGES_ADD}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

           

      </div> 
   </div>
    </section>
    <!-- /.content -->
@endsection