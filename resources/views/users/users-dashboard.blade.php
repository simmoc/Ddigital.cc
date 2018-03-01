@extends($layout)

@section('content')
 <section class="content-header">
    <div class="row">
      <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
        <li class="active">{{$title}}</li>
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
                <?php $adminObject =  App\User::where('role_id','=',1)->get()->count();
                               
               ?>
               {{$adminObject}}
            </h4>

                <p class="card-text">{{ getPhrase('owners')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_USERS.'owner'}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-red text-xs-center">
              <div class="card-block">
        
              <h4 class="card-title">
                <?php $adminObject =  App\User::where('role_id','=',2)->get()->count();
                               
               ?>
               {{$adminObject}}
            </h4>

                <p class="card-text">{{ getPhrase('admins')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_USERS.'admin'}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-blue text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
          
                <?php $adminObject =  App\User::where('role_id','=',3)->get()->count();
                               
               ?>
               {{$adminObject}}
            </h4>

                <p class="card-text">{{ getPhrase('executives')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_USERS.'executive'}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-black text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
          
                <?php $adminObject =  App\User::where('role_id','=',4)->get()->count();
                               
               ?>
               {{$adminObject}}
            </h4>

                <p class="card-text">{{ getPhrase('vendors')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_USERS.'vendor'}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-yellow text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
        
                <?php $adminObject =  App\User::where('role_id','=',5)->get()->count();
                               
               ?>
               {{$adminObject}}
            </h4>

                <p class="card-text">{{ getPhrase('customers')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_USERS.'user'}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

           <div class="col-md-3 ">
            <div class="card card-blue text-xs-center">
              <div class="card-block">
            <h4 class="card-title">
         
                <?php $adminObject =  App\User::get()->count();
                               
               ?>
               {{$adminObject}}
            </h4>

                <p class="card-text">{{ getPhrase('all_users')}}</p>
              </div>
              <a class="card-footer text-muted" 
              href="{{URL_USERS.'all'}}">
                {{ getPhrase('view_all')}}
              </a>
            </div>
          </div>

          <div class="col-md-3 ">
            <div class="card card-green text-xs-center helper_step10">
              <div class="card-block">
              <h4 class="card-title">
                             <i class="fa fa-user-plus" aria-hidden="true"></i>
                             {{ getPhrase('create_user')}}                                  
                             </h4>
              

              </div>
            <a class="card-footer text-muted" 
              href="{{URL_USERS_ADD}}">
                {{ getPhrase('create')}}
              </a>
              
            </div>
          </div>
      </div> 
   </div>
    </section>
    <!-- /.content -->
@endsection