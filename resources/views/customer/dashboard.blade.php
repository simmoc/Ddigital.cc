@extends($layout)
@section('header_scripts')
<link rel="stylesheet" href="{{CSS}}select2.css">
@stop

@section('content')
    <!--Inner Banner-->
    <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
            </div>
        </div>
    </section>
    <!--/Inner Banner-->
	
	<!--SECTION cart DASHBOARD-2-->
    <section class="dashboard2">
        <div class="container">
            <h2>{{ getPhrase('my_dashboard') }}</h2>
           
            @include('customer.menu', array('sub_active' => $sub_active, 'tab' => $tab))

            <div class="tab-content  animated fadeInDown">
                <div id="dashboard" class="tab-pane fade <?php if( $tab == 'dashboard' ) echo 'in active';?>">
                   
            <div class="dashboard-layout">
                <div class="row">

                    <div class="col-md-3">
                        <div class="card card-green">
                        <?php $coupons = App\Coupon::where('status','=',1);?>
                            <div class="card-title">{{$coupons->count()}}</div>
                            <p class="card-text"><i class="fa fa-hashtag"></i> {{getPhrase('coupons')}} </p>
                            
                            <div class="card-button">
                                <div><a href="{{URL_COUPONS}}" class="btn btn-primary">{{getPhrase('view_details')}}</a></div>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-3">
                        <div class="card card-yellow">
                        <?php $purchase_items = App\Payment::where('user_id',Auth::user()->id)->get()->count();
                                    if(!count($purchase_items)){
                                      $purchase_items = 0;
                                    }
                     ?>
                            <div class="card-title">{{$purchase_items}}</div>
                            <p class="card-text"><i class="fa fa-shopping-cart"></i> {{getPhrase('purchases')}} </p>
                            
                            <div class="card-button">
                                <div><a href="{{URL_USERS_DASHBOARD.'/purchases'}}" class="btn btn-primary">{{getPhrase('view_details')}}</a></div>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="card card-blue">
                        <?php $total_amount = App\Payment::join('payments_items','payments_items.payment_id','=','payments.id')
                          ->where('payments.user_id','=',Auth::user()->id)
                          ->select('payments_items.final_amount')->get();

                           $final_amount =0;
                             foreach ($total_amount as $amount) {
                                $final_amount += $amount->final_amount;
                             }

                               
                     ?>
                            <div class="card-title">{{currency($final_amount)}}</div>
                            <p class="card-text"><i class="fa fa-money"></i> {{getPhrase('amount')}} </p>
                            
                            <div class="card-button">
                                <div><a href="#" class="btn btn-primary">{{getPhrase('view_details')}}</a></div>
                            </div>
                        </div>
                    </div>

						
			</div>
                </div>		
                </div>
				
				<div id="history" class="tab-pane fade <?php if( $tab == 'purchases' ) echo 'in active';?>">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                               <th>{{ getPhrase('user_name')}}</th>
                            <th>{{ getPhrase('paid_amount')}}</th>
                            <th>{{ getPhrase('payment_gateway')}}</th>
                            <th>{{ getPhrase('updated_at')}}</th>
                            <th>{{ getPhrase('payment_status')}}</th>
                            <th>{{ getPhrase('product_details')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('customer.purchases', array('purchases' => $purchases, 'tab' => $tab))							
                        </tbody>
                    </table>
                </div>

                <div id="setting" class="tab-pane fade tab-setting <?php if( $tab == 'setting' ) echo 'in active';?>">
                    <?php
					$user = getUserRecord();
					?>
					@include('errors.errors')				
					{{ Form::model($user, array('url' => URL_USERS_DASHBOARD.'/'.$tab, 		'method'=>'post','name'=>'formName', 'files'=>'true' )) }}
					<div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4>{{ getPhrase('Edit Account Information') }}</h4>                          
                                <div class="form-group">
                                    {{ Form::label('first_name', getPhrase( 'First Name' ) ) }}
									<span class="text-red">*</span>
									{{ Form::text('first_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'First Name' ), 
									'title' => getPhrase('First Name' ),
									'ng-model'=>'first_name',
									'required'=> 'true',
									'ng-class'=>'{"has-error": formName.first_name.$touched && formName.first_name.$invalid}',
									)) }}
									<div class="validation-error" ng-messages="formName.first_name.$error" >
										{!! getValidationMessage()!!}
									</div>
                                </div>
                                <div class="form-group">
									{{ Form::label('last_name', getPhrase( 'last_name' ) ) }}
                               
									{{ Form::text('last_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'last_name' ), 
									'title' => getPhrase('Last Name' )
									
									)) }}                                
									
                                </div>
								
								<div class="form-group">
            {{ Form::label('image', getphrase('image')) }}
            <div class="form-group row">
              <div class="col-md-6">        

          {!! Form::file('image', array('id'=>'image_input', 'accept'=>'.png,.jpg,.jpeg')) !!}
              </div>

              <?php if(isset($record) && $record) { 
                  if($record->image!='') {
                ?>
              <div class="col-md-6">
                <img src="{{getProfilePath($record->image) }}" width="30%" height="30%" />
              </div>
              <?php } 
              } ?>

            </div>

          </div>
								
								
								
								
								
                                <div class="form-group">
                               {{ Form::label('email', getPhrase( 'email_address' ) ) }}
                                    <span class="text-red">*</span>
                                    {{ Form::text('email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'email_address' ), 
									'title' => getPhrase('Email address' ),
									'ng-model'=>'email',
									'required'=> 'true',
									'disabled' => true,
									'ng-class'=>'{"has-error": formName.email.$touched && formName.email.$invalid}',
									)) }}
                                </div>
                                
                                <div class="form-group">
{{ Form::label('password', getPhrase( 'password' ) ) }}
                                    <input type="password" class="form-control" name="password" id="password" placeholder="{{ getPhrase( 'password' ) }}">

                                </div>
                                <div class="form-group">
{{ Form::label('confirm_password', getPhrase( 're-enter_password' ) ) }}
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="{{ getPhrase( 're-enter_password' ) }}">

                                </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h4>{{ getPhrase('Edit Billing Address') }}</h4>                           

                                <div class="form-group">
{{ Form::label('billing_address1', getPhrase( 'address_line1' ) ) }}
                                    {{ Form::text('billing_address1', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'address_line1' ), 
									'title' => getPhrase('Address Line1' ),
									'ng-model'=>'billing_address1',
									'ng-class'=>'{"has-error": formName.billing_address1.$touched && formName.billing_address1.$invalid}',
									)) }}									
                                </div>
                                <div class="form-group">
{{ Form::label('billing_address2', getPhrase( 'address_line2' ) ) }}
                                    {{ Form::text('billing_address2', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'address_line2' ), 
									'title' => getPhrase('Address Line2' ),
									'ng-model'=>'billing_address2',
									'ng-class'=>'{"has-error": formName.billing_address2.$touched && formName.billing_address2.$invalid}',
									)) }}									
                                </div>
                                <div class="form-group">
{{ Form::label('first_name', getPhrase( 'city' ) ) }}
                                    {{ Form::text('billing_city', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'city' ), 
									'title' => getPhrase('City' ),
									'ng-model'=>'billing_city',
									'ng-class'=>'{"has-error": formName.billing_city.$touched && formName.billing_city.$invalid}',
									)) }}
                                </div>
                                <div class="form-group">
{{ Form::label('first_name', getPhrase( 'zip_code' ) ) }}
                                    {{ Form::text('billing_zip', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'zip_code' ), 
									'title' => getPhrase('Zip Code' ),
									'ng-model'=>'billing_zip',
									'ng-class'=>'{"has-error": formName.billing_zip.$touched && formName.billing_zip.$invalid}',
									)) }}
                                </div>
                                <div class="form-group">
{{ Form::label('first_name', getPhrase( 'state_/_province' ) ) }}
									{{ Form::text('billing_state', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'State/Province' ), 
									'title' => getPhrase('State/Province' ),
									'ng-model'=>'billing_state',
									'ng-class'=>'{"has-error": formName.billing_state.$touched && formName.billing_state.$invalid}',
									)) }}

                                </div>
                                <div class="form-group">
{{ Form::label('first_name', getPhrase( 'country' ) ) }}
                                    <?php
									$countries = array_pluck( App\Countries::where('status', '=', 'Active')->get(), 'name', 'name' );
									?>
									{{Form::select('billing_country', $countries, null, ['class'=>'form-control select2', "id"=>"billing_country"])}}									
                                </div>

                        </div>
                     
                     <div class="col-md-12 col-sm-12 col-xs-12 save">
                            <button type="submit" class="btn btn-primary digi-save">{{getPhrase("save_changes")}}</button>
                        </div>   
                    
                    </div>
					
                </div>

                <div id="key" class="tab-pane fade">
                    <h4></h4>
                </div>
                <div id="logout" class="tab-pane fade">
                    <h4></h4>

                </div>
            </div>
        </div>
    </section>
    <!--/SECTION cart checkout-->
@endsection

@section('footer_scripts')	
	@include('common.validations')
	@include('common.alertify')

	@include('common.select2')
	<script>
	var file = document.getElementById('image_input');
	file.onchange = function(e){
	var ext = this.value.match(/\.([^\.]+)$/)[1];
	switch(ext)
	{
	case 'jpg':
	case 'jpeg':
	case 'png':
	break;
	default:
	alertify.error("{{getPhrase('file_type_not_allowed')}}");
	this.value='';
	}
	};
	</script>
@stop