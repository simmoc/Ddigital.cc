 @extends($layout)
 @section('header_scripts')

@stop
@section('content')
 
 @if(checkRole(getUserGrade(7)))
 <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2>{{ Auth::user()->name }}</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{URL_USERS_DASHBOARD}}">{{ getPhrase('dashboard') }}</a></li>
                        <li>{{ getPhrase('profile') }}</li>
                        
                  </ol>
                </div>
            </div>
        </div>
    </section>
 @endif


<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->

				@if(checkRole(getUserGrade(2)))
				<div>
				    <section class="content-header">
                     <div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
						<li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
						<li><a href="{{URL_ADMIN_USERS_DASHBOARD}}">{{getPhrase('users_dashboard')}}</a></li>
						<li><a href="{{URL_USERS.'user'}}">{{getPhrase('customers')}}</a></li>
							<li>{{ $title }} </li>
						</ol>
					</div>
				
				</div>
				</section>
				</div>
				@endif
                    @if(checkRole(getUserGrade(7)))
                  <section class="dashboard2">
                   <div class="container">
                  <h2>{{ getPhrase('my_dashboard') }}</h2>
			          @include('customer.menu', array('sub_active' => $sub_active, 'tab' => 'dashborad'))
			       @endif
                     <div class="panel panel-custom">
				 	<div class="panel-heading">						
				 	<h1>{{ getPhrase('details_of').' '.$record->name }}</h1>	
				 </div>
					<div class="panel-body">
						<div class="profile-details text-center">
							<div class="profile-img"><img src="{{ getProfilePath($record->image,'profile')}}" alt="" width="100" height="100"></div>
							<div class="aouther-school">
								<h2>{{ $record->name}}</h2>
								<p><span>{{$record->email}}</span></p>
								
							</div>

						</div>
						<hr>
						<h3 class="profile-details-title">{{ getPhrase('details')}}</h3>
				<div class="row">
				<?php $login_user = Auth::user();
					?>
					@if($login_user->role_id!=5)
						<div class="col-lg-4 col-md-4 col-xs-12">
						<div class="card card-blue text-xs-center">
						<div class="card-block">
							<h4 class="card-title">{{$purchase_items}}</h4>
							<p class="card-text"><i class="fa fa-upload" aria-hidden="true"></i> {{ getPhrase('purchases')}}</p>
						</div>
							<a class="card-footer text-muted" href="{{URL_CUSTOMER_PURCHASES_LIST.$record->slug}}">{{ getPhrase('view_details')}}</a>
						</div>
					</div>
					@endif

					<div class="col-lg-4 col-md-4 col-xs-12">
						<div class="card card-red text-xs-center">
							<div class="card-block">
							
								<h4 class="card-title"></h4>

								<h4 class="card-title">{{$customer_downloads}}</h4>
								<p class="card-text"><i class="fa fa-flag"></i> {{ getPhrase('downloads')}}</p>
							</div>
								<a class="card-footer text-muted" href="{{URL_CUSTOMER_DOWLOADED_PRODUCTS.$record->slug}}">{{ getPhrase('view_details')}}</a>
						</div>
					</div>

					
						<div class="col-lg-4 col-md-4 col-xs-12">
					<div class="card card-green text-xs-center">
							<div class="card-block">
							<?php $final_amount =0;
                 foreach ($total_amount as $amount) {
                    $final_amount += $amount->paid_amount;
                  }
                ?>
                  
                                 <h4 class="card-title">{{$final_amount}}</h4>
								<p class="card-text"><i class="fa fa-money" aria-hidden="true"></i> {{ getPhrase('amount')}}</p>
							</div>
							@if($login_user->role_id==5)
                               <a class="card-footer text-muted" href="{{URL_USERS_DASHBOARD.'/purchases'}}">{{ getPhrase('view_details')}}</a>
                            @else
                            <a class="card-footer text-muted" href="{{URL_CUSTOMER_PURCHASES_LIST.$record->slug}}">{{ getPhrase('view_details')}}</a>
                            @endif   
                               
						</div>
						</div>
                     </div>
						 
						</div>
						 
 
					</div>
				</div>
				</section>
			<!-- /.container-fluid -->
</div>
@endsection
 

@section('footer_scripts')
 

@stop
