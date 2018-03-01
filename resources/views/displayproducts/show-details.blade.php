@extends('layouts.layout-site')

@section('content')
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>{{ $product->name }}</h3>
				<ol class="breadcrumb">
					<li><a href="{{ PREFIX }}">{{ getPhrase('home') }}</a></li>
					<li><a href="{{ URL_DISPLAY_PRODUCTS }}">{{ getPhrase('products') }}</a></li>
					<li class="active">{{ $product->name }}</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<!--/SECTION BANNER-->

<?php
$user = getUserRecord($product->user_created);
?>
<!--SECTION THEMES-->
<section class="theme">
	<div class="container">
		<div class="row">
			
			<div class="col-md-9 col-sm-12">
				@include('errors.errors') 
				<!--for 1st container -left side section-->
				<div class="kingma">
					<?php
					$product_image = DEFAULT_PRODUCT_IMAGE;
					$price = $product->price;
					
					if( $product->image != '' && File::exists(UPLOAD_PATH_PRODUCTS.$product->image ) ) {
						$product_image = UPLOAD_URL_PRODUCTS.$product->image;
					}
					?>
					<img src="{{ $product_image }}" alt="" class="img-responsive">
					<form action="{{ URL_DISPLAY_PRODUCTS_CART }}" method="POST" class="side-by-side" name="frmItem">
						{!! csrf_field() !!}
						
                        <div class="row">
						<div class="col-md-12 col-sm-12 kingma-buttons digi-checked clearfix">
							@if($product->demo_link != '')
								<a class="btn btn-primary" href="{{ $product->demo_link}}" target="_blank">{{ getPhrase('LIVE DEMO') }}</a>&nbsp;
							@endif
							<input type="hidden" name="id" value="{{ $product->id }}">
							<input type="hidden" name="name" value="{{ $product->name }}">
							@if( $product->price_type == 'default' )
							  @if(isset($offer_price))
							 <input type="hidden" name="offer_price" class="price" value="{{ $offer_price }}">
					        <input type="hidden" name="price_class" class="price_class" value="{{ $offer_price }}">
							  @else							
							<input type="hidden" name="price" class="price" value="{{ $product->price }}">
					        <input type="hidden" name="price_class" class="price_class" value="{{ $product->price }}">
					          @endif
							@else
								<?php
							$price = 0;
								$price_variations = json_decode( $product->price_variations );
								if( ! empty( $price_variations ) ) {
									 $id_cnt=0;
									foreach( $price_variations as $key => $item ) {
										$checked = '';
										if( isset( $item->isdefault ) && $item->isdefault == 'on' ) {
											$checked = ' checked';
											$price += $item->amount;
										}
										if( $product->price_display_type == 'radio' ) {
											echo '<input type="radio" name="price[]" value="'.$item->index.'" '.$checked.'>&nbsp;' . $item->name . ' ' . currency( $item->amount ) . '<br>';
											echo '<input type="hidden" name="price_class" class="price_class" value="'.$item->amount.'">';
										} elseif( $product->price_display_type == 'dropdown' ) {
											
											$options = array();
											$default_price = 0;
											foreach( $price_variations as $p )
											{
												$itm = array('name' => $p->name . ' ('.currency( $p->amount ).')',
												'isdefault' => 'no');
												if( isset( $p->isdefault ) && $p->isdefault == 'on' ) {
													$itm['isdefault'] = 'yes';
													$default_price = $p->price;
												}
												$options[$p->index] = $itm;
											}
											$price = $default_price;
											echo '<select name="price[]">';
											foreach($options as $option_key => $option_val )
											{
												if( $option_val['isdefault'] == 'yes') {
													echo '<option value="'.$option_key.'" selected>'.$option_val['name'].'</option>';
												} else {
												echo '<option value="'.$option_key.'">'.$option_val['name'].'</option>';
												}
											}
											echo '</select>';
											echo '<input type="hidden" name="price_class" class="price_class" value="'.$default_price.'">';
											break; // We are displaying all products in dropdown, so no need to repeat this loop!!
										} else {
										echo '<input type="checkbox" name="price[]" value="'.$item->index.'" '.$checked.'>&nbsp;' . $item->name . ' ' . currency( $item->amount ) . '&nbsp;&nbsp;&nbsp;';
										// echo '<input type="hidden" name="price_class" class="price_class" value="'.$item->amount.'">';
										}
									}

									echo '<input type="hidden" name="price_class" class="price_class" value="'.$price.'">';
								}
								?>
								
							@endif
						</div>
						</div>
						<input type="hidden" name="price_type" value="{{ $product->price_type }}">
						<input type="hidden" name="licence" id="licence" value="0">
						@if(!Auth::guest())
						  <?php 
						  $user_id = Auth::user()->id;
						  ?>
                      @endif
                      @if(Auth::guest())
                        @if($product->price!=0.00)
							<button type="submit" class="btn btn-default" name="addtocart">{{ getPhrase('add_to_cart') }} </button>
						
						<button type="submit" class="btn btn-default" name="buynow">{{ getPhrase('buy_now') }} 
						<span class="price_lable">
						@if( $product->price_type == 'default' )
						 @if(isset($offer_price))
						  {{ currency( $offer_price) }} 
						 @else 
						{{ currency( $product->price) }}
						  @endif
						 @endif
						 </span>
						 </button>
						@endif
					@endif
					@if(!Auth::guest())
								<?php $product_owner_id  = $product->user_created;?>
				      @if($product->price!=0.00)				
					    @if($user_id!= $product_owner_id)
						<button type="submit" class="btn btn-default" name="addtocart">{{ getPhrase('add_to_cart') }} </button>
						
						<button type="submit" class="btn btn-default" name="buynow">{{ getPhrase('buy_now') }} 
						<span class="price_lable">
						@if( $product->price_type == 'default' ) 
						 @if(isset($offer_price))
						  {{ currency( $offer_price) }} 
						 @else 
						{{ currency( $product->price) }}
						  @endif
						@endif
						</span>
						</button>
					   @endif
					 @endif
                    @endif
					</form>
				</div>
				
				<div class="share-icons">
					<?php
					$product_url = URL_DISPLAY_PRODUCTS_DETAILS.$product->slug;
					$product_title = $product->name;
					$social_logins = json_decode($user->social_links);
					
					if( $social_logins && $social_logins->facebook == '' && $social_logins->twitter != '' && $social_logins->pinterest != '' && $social_logins->dribbble ) {
					?>
					<ul>
						<li><a href="#">{{ getPhrase('share:') }}</a></li>
						@if($social_logins->facebook!="")
						<li><a href="{{$social_logins->facebook}}" target="_blank"><span class="fa fa-facebook"></span></a></li>
						@endif
                 		@if($social_logins->twitter!="")
						<li><a href="{{$social_logins->twitter}}" target="_blank"><span class="fa fa-twitter"></span></a></li>
						@endif
						@if($social_logins->pinterest!="")
						<li><a href="{{$social_logins->pinterest}}" target="_blank"><span class="fa fa-pinterest"></span></a></li>
						@endif
						@if($social_logins->dribbble!="")
						<li><a href="{{$social_logins->dribbble}}" target="_blank"><span class="fa fa-dribbble"></span></a></li>
						@endif
					</ul>
					<?php } ?>
				</div>
				<!--for 2nd container -left side-->
				<div class="kingma-details">
					<h6 class="widget-title">{!! $product->name !!} {{ getPhrase('details') }}</h6>
					<p class="kingma-para">{!! $product->description !!}</p>
				</div>

			</div>
              
			<div class="col-md-3 col-sm-12 ">
			@if($product->price!=0.00)
				<!--for right side section-->
				<div class="add-cart">


					@if($product->licences != '')
					<div class="input-group ">
						<div class="radio">
							{{-- <div>
							<input type="radio"  value="0" name="licence" onclick="addLicence(0, 0,0)">
								<label>
									<span class="radio-content">
										<span class="item-content">{{ getPhrase('regular_licence') }}</span>
									<i aria-hidden="true" class="fa uncheck fa-circle-thin"></i>
									<i aria-hidden="true" class="fa check fa-dot-circle-o"></i>
									</span>
								</label>
							</div> --}}
							<?php
							$licences = (array) json_decode($product->licences );
							if( ! empty( $licences ) )
							{
								foreach( $licences as $licence) {
									$details = App\Licence::where('id', '=', $licence)->first();
							?>
							<div>
								<label>

								      
									<input type="radio" value="{{ $details->id }}" name="licence" onclick="addLicence(<?php echo $details->price;?>, {{ $details->id }},{{$details->duration}})">
									<span class="radio-content">
										<span class="item-content" data-toggle="tooltip" data-placement="bottom" title="{{$details->description}}">{{ $details->title . '( '.currency( $details->price ) .' )' }}</span>
										<p>{{getPhrase('duration')}} <strong>{{$details->duration}} {{$details->duration_type}}</strong></p>


									<i aria-hidden="true" class="fa uncheck fa-circle-thin"></i>
									<i aria-hidden="true" class="fa check fa-dot-circle-o"></i>
									</span>
									
								</label>
							</div>
								<?php } ?>							
							<?php } ?>
						</div>
					</div>

                    @if(isset($offer_price))
                    <h1 class="price_lable">{{ currency( $offer_price ) }}</h1>
                    @else
					<h1 class="price_lable">{{ currency( $price ) }}</h1>
					@endif
					

					<form>
						<div class="addcart-buttons">
							<!--<button type="button" class="btn btn-primary">ADD TO CART</button> &nbsp;-->
						@if(Auth::guest())	
						<button type="button" class="btn btn-default" onclick="javascript:document.frmItem.submit();">{{ getPhrase('buy') }} <span class="price_lable">
						@if(isset($offer_price))
						({{ currency( $offer_price ) }})
						@else
						({{ currency( $price ) }})
						@endif
						</span>
						</button>
						@endif
						@if(!Auth::guest())
						 <?php $product_owner_id  = $product->user_created;?>
					@if($user_id!= $product_owner_id)
						<button type="button" class="btn btn-default" onclick="javascript:document.frmItem.submit();">{{ getPhrase('buy') }} <span class="price_lable">
						@if(isset($offer_price))
						({{ currency( $offer_price ) }})
						@else
						({{ currency( $price ) }})
						@endif
						</span>
						</button>
						@endif	
						@endif	
						</div>
					</form>
				</div>
				@endif
			@else
                
                <div class="add-cart">
            {!!Form::open(array('url'=> URL_FREEDOWNLOAD_PRODUCT_FORM,'method'=>'POST','name'=>'contactus'))!!} 
                   <fieldset class="form-group">
                    {{ Form::label('user_name', getphrase('name')) }}

                        <span class="text-red">*</span>

                        {{ Form::text('user_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getphrase('Jack'),'required'=>'true'

                          )) }}

                    </fieldset>

                     <fieldset class="form-group">

                        {{ Form::label('email', getphrase('email')) }}

                        <span class="text-red">*</span>

                        {{ Form::email('email', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getphrase('jack@jarvis.com'),'required'=>'true'

                           )) }}

                    </fieldset>
                    <input type="hidden" name="product_slug" value="{{$product->slug}}">
                     <button type="submit" class="btn btn-info"><i class="fa fa-download"></i>{{getPhrase('download')}}</button>
                    {!!Form::close()!!}
            </div>

			@endif	

				
				<div class="author">
					<h5 class="widget-title-center">{{ getPhrase('about_author') }}</h5>
					
					<img src="{{getProfilePath($user->image)}}" alt="{{ $user->name }}" width="45" height="45">
					<h6>{{ $user->name }}</h6>
					<p class="auth-para"><strong>{{ getPhrase('products : ') }}</strong> {{ App\Product::where('user_created', '=', $user->id)->where('status', '=', 'Active')->count() }}</p>
					<a class="btn btn-default" href="{{ URL_DISPLAYPRODUCTS_VENDORDETAILS . $user->slug }}">{{ getPhrase('view_details') }}</a>
					
					<!--<button type="button" class="btn btn-default">SEND MESSAGE</button>-->
				</div>
				@if( $product->licence_of_use != '')
				<div class="license">
					<h5>{{ getPhrase('licence_of_use') }}</h5>
					<hr>
					{!! $product->licence_of_use !!}
				</div>
				@endif
				<div class="product-info">
					<h5 class="widget-title">{{ getPhrase('product_info') }}</h5>
					<ul>
						{{-- <li><a href="javascript:void(0);">{{ getPhrase('Date') }}<span >{{ displayDate( $product->created_at ) }}</span></a></li> --}}
						<?php
						$payment = App\Payment::join('payments_items', 'payments.id', '=', 'payments_items.payment_id')->where('payments_items.item_id', '=', $product->id);
						?>
						<li><strong>{{ getPhrase('Downloads') }}</strong><span>{{ $payment->count() }}</span></li> 
						
						<?php
						$rating = $payment->join('product_items_ratings', 'product_items_ratings.item_id', '=', 'payments_items.item_id');
						?>
						@if($rating->count() > 0)
						<li><a href="javascript:void(0);">{{ getPhrase('ratings') }}<span>
						{{ round($rating->sum('rating') / $rating->count()) }} / 5
						</span></a></li>
						@endif
						@if( $product->product_format != '')
						<li><a href="#">{{ getPhrase('Format') }}<span>{{ $product->product_format }}</span></a></li>
						@endif
					</ul>
					

				</div>
				
				@if( $product->technical_info != '')
				<div class="technical-info">
					<h5 class="widget-title">{{ getPhrase('technical_info') }}</h5>
						{!! $product->technical_info !!}					
				</div>
				@endif

			</div>
		</div>
		<!--SECTION THEME-->
	</div>
</section>

<!--section 3-PRODUCTS-->
<?php
$categories = json_decode( $product->categories );
if( $categories ) {
	$related_products = App\Product::getProducts( array( 'category' =>  $categories) )->paginate( 3 );
} else {
	$related_products = App\Product::getProducts( array( 'category' =>  'name:' . $product->name) )->paginate( 3 );
}
?>
@if($related_products->count() > 0 )
<div class="products">
	<div class="container">
		<div class="row cs-row">
			<div class="col-md-12">
				<h2 class="heading ">{{ getPhrase('related_products') }}</h2>
			</div>
			@include('displayproducts.products', array('products' => $related_products, 'nopagelinks' => true, 'type' => 'related'))			
			@if( $related_products->count() > 3 )
			<div class="col-lg-12">
				<div class="products-button">
					<a href="{{ URL_DISPLAY_PRODUCTS }}" class="btn btn-primary">{{ getPhrase('see_all_products') }}</a>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
<!--/section 3-PRODUCTS-->
@endif
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
function addLicence(price,id,duration,duration_type='')
{
	var item_price = $('.price_class').val();
	/*
	var item_price = 0;
	$('.price_class').each(function(index){		
		console.log($(this));
		console.log($(this).is(':checked'));
		if( $(this).is(':checked') ) {
			
			item_price += Number($(this).val());
		}
	});
	*/
	
	var currency = "{{ getSetting('currency_symbol', 'cart_settings') }}";
	var currency_position = "{{ getSetting('currency_position', 'cart_settings') }}";
	console.log(item_price);
	var final_price = Number( item_price ) + Number( price );
	var displaytext = "<h4>Duration :"+duration+"</h4>";
	if( currency_position == 'before' ) {
		final_price = currency + final_price;
	} else if( currency_position == 'beforewithspace' ) {
		final_price = currency + ' ' + final_price;
	} else if( currency_position == 'after' ) {
		final_price =  final_price + currency;
	} else if( currency_position == 'afterwithspace' ) {
		final_price = final_price + ' ' + currency;
	}
	$('#licence').val( id );
	$('.price_lable').html( final_price );
	$('.duration_lable').html( displaytext );
	
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@endsection