     <div class="box-body">
     <div class="row">
			<div class="col-md-6">                
				<div class="form-group">
                 <?php echo e(Form::label('title', getPhrase( 'Title' ) )); ?> <?php echo required_field();; ?>

                 <?php echo e(Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('offer_name'),))); ?>

                </div>
            </div>
			
			<div class="col-md-6">                
				<div class="form-group">
                 <?php echo e(Form::label('start_date_time', getPhrase( 'start_date' ) )); ?> <?php echo required_field();; ?>

                 <?php echo e(Form::text('start_date_time', $value = null , $attributes = array('class'=>'form-control datetimerange', 'placeholder' => getPhrase( 'Start Date' ),))); ?>

                </div>
            </div>
         </div>
         <div class="row">
			<div class="col-md-6">                
				<div class="form-group">
                 <?php echo e(Form::label('end_date_time', getPhrase( 'end_date' ) )); ?> <?php echo required_field();; ?>

                 <?php echo e(Form::text('end_date_time', $value = null , $attributes = array('class'=>'form-control datetimerange', 'placeholder' => getPhrase( 'end_date' ),))); ?>

                </div>
            </div>

            <div class="col-md-6">								
				<?php 
				$status = array();
				$status['active'] = getPhrase( 'Active' );
				$status['inactive'] = getPhrase('Inactive');
				?>
				<div class="form-group">
				<?php echo e(Form::label('status', getPhrase( 'Status' ) )); ?>

				<?php echo e(Form::select('status', $status, null, ['class'=>'form-control', "id"=>"status"])); ?>

				</div>           
			</div>		
         </div>
         <div class="row">
			<div class="col-md-6">
				<div class="form-group">
				<?php echo e(Form::label('image', getPhrase( 'image' ) )); ?>               
				<?php echo e(Form::file('image', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'image' ), 'accept'=>'.png,.jpg,.jpeg'))); ?>

				<?php if(isset($record) && $record) { 
                  if($record->image!='') {
                ?>
			  <div class="col-md-6">
				<img class="pad-top" src="<?php echo e(UPLOAD_URL_OFFERS_THUMBNAIL . $record->image); ?>" width="50" height="50"/>
			  </div>
			  <?php } } ?>
				</div>
			</div>
         
         
			<div class="col-md-6">								
				<?php 
				$products = ['' => getPhrase('Please select product') ] + array_pluck( App\Product::where('status', '=', 'Active')->get(), 'name', 'id' );
				?>
				<div class="form-group">
				<?php echo e(Form::label('product_id', getPhrase( 'product' ) )); ?>

				<?php echo e(Form::select('product_id', $products, null, ['class'=>'form-control select2', "id"=>"product_id"])); ?>

				</div>           
			</div>
         </div>
			<div class="row">
			<div class="col-md-6">								
				<?php 
				$status = array();
				$status['no'] = getPhrase( 'No' );
				$status['yes'] = getPhrase('Yes');
				?>
				<div class="form-group">
				<?php echo e(Form::label('use_product_title', getPhrase( 'use_product_title' ) )); ?>

				<?php echo e(Form::select('use_product_title', $status, null, ['class'=>'form-control', "id"=>"use_product_title"])); ?>

				</div>           
			</div>
        
        
			<div class="col-md-6">								
				<?php 
				$status = array();
				$status['no'] = getPhrase( 'No' );
				$status['yes'] = getPhrase('Yes');
				?>
				<div class="form-group">
				<?php echo e(Form::label('use_product_description', getPhrase( 'use_product_description' ) )); ?>

				<?php echo e(Form::select('use_product_description', $status, null, ['class'=>'form-control', "id"=>"use_product_description"])); ?>

				</div>           
			</div>
         </div>
         <div class="row">
			<div class="col-md-6">								
				<?php 
				$status = array();
				$status['no'] = getPhrase( 'No' );
				$status['yes'] = getPhrase('Yes');
				?>
				<div class="form-group">
				<?php echo e(Form::label('use_product_image', getPhrase( 'use_product_image' ) )); ?>

				<?php echo e(Form::select('use_product_image', $status, null, ['class'=>'form-control', "id"=>"use_product_image"])); ?>

				</div>           
			</div>
			<div class="col-md-6">                
				<div class="form-group">
                 <?php echo e(Form::label('offer_price', getPhrase( 'offer_price' ) )); ?> <?php echo required_field();; ?>

                 <?php echo e(Form::number('offer_price', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '$100','min'=>1))); ?>

                </div>
            </div>
		</div>
        
			<div class="col-md-12">
				<div class="form-group">
					<?php echo e(Form::label('description', getPhrase( 'Description' ) )); ?>               
					<?php echo e(Form::textarea('description', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'description for the offer' ), 'rows'=>'4'))); ?>

				</div>
				
				
			</div>
			
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
                  <div class="btn-center"><button type="submit" class="btn btn-primary" ng-disabled='!formUsers.$valid'><?php echo e($button_name); ?></button></div>
              </div>