<?php $__env->startSection('content'); ?>
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3><?php echo e($product->name); ?></h3>
				<ol class="breadcrumb">
					<li><a href="<?php echo e(PREFIX); ?>"><?php echo e(getPhrase('home')); ?></a></li>
					<li><a href="<?php echo e(URL_DISPLAY_PRODUCTS); ?>"><?php echo e(getPhrase('products')); ?></a></li>
					<li class="active"><?php echo e($product->name); ?></li>
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
				<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
				<!--for 1st container -left side section-->
				<div class="kingma">
					<?php
					$product_image = DEFAULT_PRODUCT_IMAGE;
					$price = $product->price;
					
					if( $product->image != '' && File::exists(UPLOAD_PATH_PRODUCTS.$product->image ) ) {
						$product_image = UPLOAD_URL_PRODUCTS.$product->image;
					}
					?>
					<img src="<?php echo e($product_image); ?>" alt="" class="img-responsive">
					<form action="<?php echo e(URL_DISPLAY_PRODUCTS_CART); ?>" method="POST" class="side-by-side" name="frmItem">
						<?php echo csrf_field(); ?>

						
                        <div class="row">
						<div class="col-md-12 col-sm-12 kingma-buttons digi-checked clearfix">
							<?php if($product->demo_link != ''): ?>
								<a class="btn btn-primary" href="<?php echo e($product->demo_link); ?>" target="_blank"><?php echo e(getPhrase('LIVE DEMO')); ?></a>&nbsp;
							<?php endif; ?>
							<input type="hidden" name="id" value="<?php echo e($product->id); ?>">
							<input type="hidden" name="name" value="<?php echo e($product->name); ?>">
							<?php if( $product->price_type == 'default' ): ?>
							  <?php if(isset($offer_price)): ?>
							 <input type="hidden" name="offer_price" class="price" value="<?php echo e($offer_price); ?>">
					        <input type="hidden" name="price_class" class="price_class" value="<?php echo e($offer_price); ?>">
							  <?php else: ?>							
							<input type="hidden" name="price" class="price" value="<?php echo e($product->price); ?>">
					        <input type="hidden" name="price_class" class="price_class" value="<?php echo e($product->price); ?>">
					          <?php endif; ?>
							<?php else: ?>
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
								
							<?php endif; ?>
						</div>
						</div>
						<input type="hidden" name="price_type" value="<?php echo e($product->price_type); ?>">
						<input type="hidden" name="licence" id="licence" value="0">
						<?php if(!Auth::guest()): ?>
						  <?php 
						  $user_id = Auth::user()->id;
						  ?>
                      <?php endif; ?>
                      <?php if(Auth::guest()): ?>
                        <?php if($product->price!=0.00): ?>
							<button type="submit" class="btn btn-default" name="addtocart"><?php echo e(getPhrase('add_to_cart')); ?> </button>
						
						<button type="submit" class="btn btn-default" name="buynow"><?php echo e(getPhrase('buy_now')); ?> 
						<span class="price_lable">
						<?php if( $product->price_type == 'default' ): ?>
						 <?php if(isset($offer_price)): ?>
						  <?php echo e(currency( $offer_price)); ?> 
						 <?php else: ?> 
						<?php echo e(currency( $product->price)); ?>

						  <?php endif; ?>
						 <?php endif; ?>
						 </span>
						 </button>
						<?php endif; ?>
					<?php endif; ?>
					<?php if(!Auth::guest()): ?>
								<?php $product_owner_id  = $product->user_created;?>
				      <?php if($product->price!=0.00): ?>				
					    <?php if($user_id!= $product_owner_id): ?>
						<button type="submit" class="btn btn-default" name="addtocart"><?php echo e(getPhrase('add_to_cart')); ?> </button>
						
						<button type="submit" class="btn btn-default" name="buynow"><?php echo e(getPhrase('buy_now')); ?> 
						<span class="price_lable">
						<?php if( $product->price_type == 'default' ): ?> 
						 <?php if(isset($offer_price)): ?>
						  <?php echo e(currency( $offer_price)); ?> 
						 <?php else: ?> 
						<?php echo e(currency( $product->price)); ?>

						  <?php endif; ?>
						<?php endif; ?>
						</span>
						</button>
					   <?php endif; ?>
					 <?php endif; ?>
                    <?php endif; ?>
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
						<li><a href="#"><?php echo e(getPhrase('share:')); ?></a></li>
						<?php if($social_logins->facebook!=""): ?>
						<li><a href="<?php echo e($social_logins->facebook); ?>" target="_blank"><span class="fa fa-facebook"></span></a></li>
						<?php endif; ?>
                 		<?php if($social_logins->twitter!=""): ?>
						<li><a href="<?php echo e($social_logins->twitter); ?>" target="_blank"><span class="fa fa-twitter"></span></a></li>
						<?php endif; ?>
						<?php if($social_logins->pinterest!=""): ?>
						<li><a href="<?php echo e($social_logins->pinterest); ?>" target="_blank"><span class="fa fa-pinterest"></span></a></li>
						<?php endif; ?>
						<?php if($social_logins->dribbble!=""): ?>
						<li><a href="<?php echo e($social_logins->dribbble); ?>" target="_blank"><span class="fa fa-dribbble"></span></a></li>
						<?php endif; ?>
					</ul>
					<?php } ?>
				</div>
				<!--for 2nd container -left side-->
				<div class="kingma-details">
					<h6 class="widget-title"><?php echo $product->name; ?> <?php echo e(getPhrase('details')); ?></h6>
					<p class="kingma-para"><?php echo $product->description; ?></p>
				</div>

			</div>
              
			<div class="col-md-3 col-sm-12 ">
			<?php if($product->price!=0.00): ?>
				<!--for right side section-->
				<div class="add-cart">


					<?php if($product->licences != ''): ?>
					<div class="input-group ">
						<div class="radio">
							
							<?php
							$licences = (array) json_decode($product->licences );
							if( ! empty( $licences ) )
							{
								foreach( $licences as $licence) {
									$details = App\Licence::where('id', '=', $licence)->first();
							?>
							<div>
								<label>

								      
									<input type="radio" value="<?php echo e($details->id); ?>" name="licence" onclick="addLicence(<?php echo $details->price;?>, <?php echo e($details->id); ?>,<?php echo e($details->duration); ?>)">
									<span class="radio-content">
										<span class="item-content" data-toggle="tooltip" data-placement="bottom" title="<?php echo e($details->description); ?>"><?php echo e($details->title . '( '.currency( $details->price ) .' )'); ?></span>
										<p><?php echo e(getPhrase('duration')); ?> <strong><?php echo e($details->duration); ?> <?php echo e($details->duration_type); ?></strong></p>


									<i aria-hidden="true" class="fa uncheck fa-circle-thin"></i>
									<i aria-hidden="true" class="fa check fa-dot-circle-o"></i>
									</span>
									
								</label>
							</div>
								<?php } ?>							
							<?php } ?>
						</div>
					</div>

                    <?php if(isset($offer_price)): ?>
                    <h1 class="price_lable"><?php echo e(currency( $offer_price )); ?></h1>
                    <?php else: ?>
					<h1 class="price_lable"><?php echo e(currency( $price )); ?></h1>
					<?php endif; ?>
					

					<form>
						<div class="addcart-buttons">
							<!--<button type="button" class="btn btn-primary">ADD TO CART</button> &nbsp;-->
						<?php if(Auth::guest()): ?>	
						<button type="button" class="btn btn-default" onclick="javascript:document.frmItem.submit();"><?php echo e(getPhrase('buy')); ?> <span class="price_lable">
						<?php if(isset($offer_price)): ?>
						(<?php echo e(currency( $offer_price )); ?>)
						<?php else: ?>
						(<?php echo e(currency( $price )); ?>)
						<?php endif; ?>
						</span>
						</button>
						<?php endif; ?>
						<?php if(!Auth::guest()): ?>
						 <?php $product_owner_id  = $product->user_created;?>
					<?php if($user_id!= $product_owner_id): ?>
						<button type="button" class="btn btn-default" onclick="javascript:document.frmItem.submit();"><?php echo e(getPhrase('buy')); ?> <span class="price_lable">
						<?php if(isset($offer_price)): ?>
						(<?php echo e(currency( $offer_price )); ?>)
						<?php else: ?>
						(<?php echo e(currency( $price )); ?>)
						<?php endif; ?>
						</span>
						</button>
						<?php endif; ?>	
						<?php endif; ?>	
						</div>
					</form>
				</div>
				<?php endif; ?>
			<?php else: ?>
                
                <div class="add-cart">
            <?php echo Form::open(array('url'=> URL_FREEDOWNLOAD_PRODUCT_FORM,'method'=>'POST','name'=>'contactus')); ?> 
                   <fieldset class="form-group">
                    <?php echo e(Form::label('user_name', getphrase('name'))); ?>


                        <span class="text-red">*</span>

                        <?php echo e(Form::text('user_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getphrase('Jack'),'required'=>'true'

                          ))); ?>


                    </fieldset>

                     <fieldset class="form-group">

                        <?php echo e(Form::label('email', getphrase('email'))); ?>


                        <span class="text-red">*</span>

                        <?php echo e(Form::email('email', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getphrase('jack@jarvis.com'),'required'=>'true'

                           ))); ?>


                    </fieldset>
                    <input type="hidden" name="product_slug" value="<?php echo e($product->slug); ?>">
                     <button type="submit" class="btn btn-info"><i class="fa fa-download"></i><?php echo e(getPhrase('download')); ?></button>
                    <?php echo Form::close(); ?>

            </div>

			<?php endif; ?>	

				
				<div class="author">
					<h5 class="widget-title-center"><?php echo e(getPhrase('about_author')); ?></h5>
					
					<img src="<?php echo e(getProfilePath($user->image)); ?>" alt="<?php echo e($user->name); ?>" width="45" height="45">
					<h6><?php echo e($user->name); ?></h6>
					<p class="auth-para"><strong><?php echo e(getPhrase('products : ')); ?></strong> <?php echo e(App\Product::where('user_created', '=', $user->id)->where('status', '=', 'Active')->count()); ?></p>
					<a class="btn btn-default" href="<?php echo e(URL_DISPLAYPRODUCTS_VENDORDETAILS . $user->slug); ?>"><?php echo e(getPhrase('view_details')); ?></a>
					
					<!--<button type="button" class="btn btn-default">SEND MESSAGE</button>-->
				</div>
				<?php if( $product->licence_of_use != ''): ?>
				<div class="license">
					<h5><?php echo e(getPhrase('licence_of_use')); ?></h5>
					<hr>
					<?php echo $product->licence_of_use; ?>

				</div>
				<?php endif; ?>
				<div class="product-info">
					<h5 class="widget-title"><?php echo e(getPhrase('product_info')); ?></h5>
					<ul>
						
						<?php
						$payment = App\Payment::join('payments_items', 'payments.id', '=', 'payments_items.payment_id')->where('payments_items.item_id', '=', $product->id);
						?>
						<li><strong><?php echo e(getPhrase('Downloads')); ?></strong><span><?php echo e($payment->count()); ?></span></li> 
						
						<?php
						$rating = $payment->join('product_items_ratings', 'product_items_ratings.item_id', '=', 'payments_items.item_id');
						?>
						<?php if($rating->count() > 0): ?>
						<li><a href="javascript:void(0);"><?php echo e(getPhrase('ratings')); ?><span>
						<?php echo e(round($rating->sum('rating') / $rating->count())); ?> / 5
						</span></a></li>
						<?php endif; ?>
						<?php if( $product->product_format != ''): ?>
						<li><a href="#"><?php echo e(getPhrase('Format')); ?><span><?php echo e($product->product_format); ?></span></a></li>
						<?php endif; ?>
					</ul>
					

				</div>
				
				<?php if( $product->technical_info != ''): ?>
				<div class="technical-info">
					<h5 class="widget-title"><?php echo e(getPhrase('technical_info')); ?></h5>
						<?php echo $product->technical_info; ?>					
				</div>
				<?php endif; ?>

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
<?php if($related_products->count() > 0 ): ?>
<div class="products">
	<div class="container">
		<div class="row cs-row">
			<div class="col-md-12">
				<h2 class="heading "><?php echo e(getPhrase('related_products')); ?></h2>
			</div>
			<?php echo $__env->make('displayproducts.products', array('products' => $related_products, 'nopagelinks' => true, 'type' => 'related'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>			
			<?php if( $related_products->count() > 3 ): ?>
			<div class="col-lg-12">
				<div class="products-button">
					<a href="<?php echo e(URL_DISPLAY_PRODUCTS); ?>" class="btn btn-primary"><?php echo e(getPhrase('see_all_products')); ?></a>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<!--/section 3-PRODUCTS-->
<?php endif; ?>
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
	
	var currency = "<?php echo e(getSetting('currency_symbol', 'cart_settings')); ?>";
	var currency_position = "<?php echo e(getSetting('currency_position', 'cart_settings')); ?>";
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>