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
                 <li><a href="{{URL_VENDOR_DASHBOARD}}">{{ getPhrase('dashboard') }}</a></li>
                 <li>{{ getPhrase('profile') }}</a></li>
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
				<section class="content-header">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
						<li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
						<li><a href="{{URL_ADMIN_USERS_DASHBOARD}}">{{getPhrase('users_dashboard')}}</a></li>
						<li><a href="{{URL_USERS.'vendor'}}">{{getPhrase('vendors')}}</a></li>
							<li>{{ $title }} </li>
						</ol>
					</div>
				
				</div>
				</section>
				@endif
                 @if(checkRole(getUserGrade(7)))
                  <section class="dashboard2">
                   <div class="container">
                  <h2>{{ getPhrase('my_dashboard') }}</h2>
			        @include('productvendor.menu', array('sub_active' => $sub_active, 'tab' => 'dashboard'))

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
					@if($login_user->role_id!=4)
					{{-- {{dd($vendor_uploads)}} --}}
						<div class="col-lg-3 col-md-6">
						<div class="card card-blue text-xs-center">
						<div class="card-block">
							<h4 class="card-title">{{$vendor_uploads}}</h4>
							<p class="card-text"><i class="fa fa-upload" aria-hidden="true"></i> {{ getPhrase('uploads')}}</p>
						</div>
							<a class="card-footer text-muted" href="{{URL_VENDOR_UPLOAD_PRODUCTS.$record->slug}}">{{ getPhrase('view_details')}}</a>
						</div>
					</div>
					@endif


					<div class="col-lg-3 col-md-6">
						<div class="card card-yellow text-xs-center">
							<div class="card-block">
							@if(count($total_uploads))

							<?php
							   $count = 0; 
							   
							  foreach ($total_uploads as $items) {
							$total_available = [];  	
							$total_available = App\Payment_Items::where('item_id',$items->id)->get();
							$count += count($total_available);
                            }
                             

                            ?>
								<h4 class="card-title">{{$count}}</h4>

								@else
								<h4 class="card-title">0</h4>
                             @endif
								<p class="card-text"><i class="fa fa-flag"></i> {{ getPhrase('product_sales')}}</p>
							</div>
								<a class="card-footer text-muted" href="{{URL_VENDOR_UPLOAD_PRODUCT_SALES.$record->slug}}">{{ getPhrase('view_details')}}</a>
						</div>
					</div>
                  @if($login_user->role_id!=4)
					<div class="col-lg-3 col-md-6">
					<div class="card card-red text-xs-center">
							<div class="card-block">
								<h4 class="card-title">{{$purchase_items}}</h4>
								<p class="card-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ getPhrase('purchases')}}</p>
							</div>
								<a class="card-footer text-muted" href="{{URL_VENDOR_PRODUCTS_PURCHASES.$record->slug}}">{{ getPhrase('view_details')}}</a>
						</div>
						</div>
						@endif

						<div class="col-lg-3 col-md-6">
					<div class="card card-black text-xs-center">
							<div class="card-block">
                                 
                                 <?php $count = 0;

                                    foreach ($vendor_got_amount as $amount) {
                                    	
                                    	$count +=$amount->final_amount; 
                                    }

                                  ?>

								<h4 class="card-title">{{currency($count)}}</h4>
								<p class="card-text"><i class="fa fa-credit-card" aria-hidden="true"></i> {{ getPhrase('amount')}}</p>
							</div>
                             <a class="card-footer text-muted" href="{{URL_VENDOR_UPLOAD_PRODUCT_SALES.$record->slug}}">{{ getPhrase('view_details')}}</a>
						</div>
						</div>
                     </div>
						 
						</div>
						 
 
					</div>
				</div>
			@if(checkRole(getUserGrade(7)))
			</section>
			@endif
				</div>
			<!-- /.container-fluid -->
</div>
@endsection
 

@section('footer_scripts')
 

@stop
