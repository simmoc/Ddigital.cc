   
   	   	<div class="edd-mains">
   	<div class="box-body  clearfix">
		<div class="row">
		<div class="col-md-12">                
			<div class="form-group">			
			 {{ Form::label('name', getPhrase( 'name' ) ) }} {!! required_field(); !!}
			 
			 {{ Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('product_name'),

							'ng-model'=>'name',
							
							'ng-pattern' => getRegexPattern('name'),

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formName.name.$touched && formName.name.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength'
							 => '120',

							)) }}
			<div class="validation-error" ng-messages="formName.name.$error" >
				{!! getValidationMessage()!!}
				{!! getValidationMessage('pattern')!!}
				{!! getValidationMessage('minlength')!!}
				{!! getValidationMessage('maxlength')!!}
			</div>
			</div>
		</div>
		
		<!-- <div class="col-md-6">                
			<div class="form-group">			
			 {{ Form::label('product_format', getPhrase( 'format' ) ) }} {!! required_field(); !!}
			 
			 {{ Form::text('product_format', $value = null , $attributes = array('class'=>'form-control', 'placeholder' =>getPhrase('product_format'),

							'ng-model'=>'product_format',
							
							'ng-pattern' => getRegexPattern('name'),

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formName.product_format.$touched && formName.product_format.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '120',

							)) }}
			<div class="validation-error" ng-messages="formName.product_format.$error" >
				{!! getValidationMessage()!!}
				{!! getValidationMessage('pattern')!!}
				{!! getValidationMessage('minlength')!!}
				{!! getValidationMessage('maxlength')!!}
			</div>
			</div>
		</div> -->
        </div>
        
        <div class="row">
		<div class="col-md-6">							
			<?php 
			$status = array();
			$status['Active'] = getPhrase( 'Active' );
			$status['Inactive'] = getPhrase('Inactive');
			?>
			<div class="form-group">
			{{ Form::label('status', getPhrase( 'status' ) ) }}
			{{Form::select('status', $status, null, ['class'=>'form-control', "id"=>"status", 'data-toggle' => 'tooltip'])}}
			</div>	   
		</div>
		
		<div class="col-md-6">							
			<?php 
			$status = array();
			$status['no'] = getPhrase('No');
			$status['yes'] = getPhrase( 'Yes' );			
			?>
			<div class="form-group">
			{{ Form::label('is_featured', getPhrase( 'is_featured' ) ) }}
			{{Form::select('is_featured', $status, null, ['class'=>'form-control', "id"=>"is_featured", 'data-toggle' => 'tooltip'])}}
			</div>	   
		</div>
        </div>
        
        <div class="row">
		<div class="col-md-6">
            <h3><b>{{ getPhrase('categories') }}</b><span class="text-red">*</span></h3>
            
			<div class="form-group">			
			<?php $count = 0;
			$selected_cats = array();
			if( $record ) {
				$selected_cats = (array) json_decode($record->categories);
			}
			?>			
			{{Form::select('categories[]', $categories, $selected_cats, ['data-toggle' => 'tooltip', 'title' => getPhrase('please_select_categorie(s)'), 'class' => 'form-control select2', 'multiple' => 'multiple',])}}
			</div>
		</div>
		
		<div class="col-md-6">
            <h3><b>{{ getPhrase('licences') }}</b> <span class="text-red">*</span></h3>
            
			<div class="form-group">			
			<?php $count = 0;
			$selected_cats = array();
			if( $record ) {
				$selected_cats = (array) json_decode($record->licences);
			}
			$licences = array_pluck(App\Licence::where('status', '=', 'Active')->get(), 'title', 'id');
			?>			
			{{Form::select('licences[]', $licences, $selected_cats, ['data-toggle' => 'tooltip', 'title' => getPhrase('please_select_licences(s)'), 'class' => 'form-control select2', 'multiple' => 'multiple', 'placeholder' => ''])}}
			</div>
		</div>
        </div>

        
        <div class="row">   
            
		<div class="col-md-6">							
            <h3><b>{{ getPhrase('price_settings') }}</b></h3>
			<?php 
			$price_types = array(
				'default' => getPhrase( 'Default' ),
				'variable' => getPhrase('Variable'),
			);
			?>
			<div class="form-group">
			{{ Form::label('price_type', getPhrase( 'price_type' ) ) }}
			{{Form::select('price_type',$price_types, null, ['class'=>'form-control', 'id' => 'price_type', 'data-toggle' => 'tooltip', 'required' => 'true'])}}
			</div>
			<div class="validation-error" ng-messages="formName.price_type.$error" >
				{!! getValidationMessage()!!}
			</div>
		</div>
		<div class="col-md-6" id="fixedprice_options_div">
			<h3> &nbsp;</h3>
			<div class="form-group">
			 {{ Form::label('price', getPhrase( 'price' ) ) }} {!! required_field(); !!}
			 {{ Form::number('price', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: 2' ), 'required' => true, 'title' => getPhrase('Price'), 'data-toggle' => 'tooltip')) }}
			</div>
		</div>
        </div>
        
		<div class="col-md-6" id="price_display_type_div">
			
			<div class="form-group">
			 {{ Form::label('price_display_type', getPhrase( 'price_display_type' ) ) }} {!! required_field(); !!}
			 {{ Form::select('price_display_type', array('checkbox' => getPhrase('Checkbox'), 'radio' => getPhrase('radio'), 'dropdown' => getPhrase('drop_down') ), null, ['class'=>'form-control', 'id' => 'price_type', 'data-toggle' => 'tooltip', 'required' => 'true']) }}
			</div>
		</div>
		<div class="col-md-12" id="variableprice_options_div" style="display:none;">
			<div id="digi_price_fields" class="edd_meta_table_wrap">
				<table class="widefat digi_repeatable_table" width="100%" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th style="width: 50px"></th>
							<th>{{ getPhrase('option_name') }}</th>
							<th>{{ getPhrase('price') }}</th>
							<th>{{ getPhrase('default') }}</th>
							<th>{{ getPhrase('ID') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>					
						<?php
						$prices_options = array('All');
						if( $record ) {
							$old_prices = json_decode( $record->price_variations );
							if( ! empty( $old_prices ) ) {
								foreach( $old_prices as $key => $value ) {
									$value = ( array ) $value;
									$name   = isset( $value['name'] )   ? $value['name']   : '';
									$amount = isset( $value['amount'] ) ? $value['amount'] : '';
									$index  = isset( $value['index'] )  ? $value['index']  : $key;
									$isdefault = isset( $value['isdefault'] ) ? $value['isdefault'] : false;
									?>
									<tr class="digi_variable_prices_wrapper digi_repeatable_row" data-key="1">
										@include('products.price_row', array('index' => $index, 'key' => $key, 'name' => $name, 'amount' => $amount, 'isdefault' => $isdefault, 'record' => $record))
									</tr>
									<?php
									$prices_options[] = $name;
								}
							}
						} else {
						?>
						<tr class="digi_variable_prices_wrapper digi_repeatable_row" data-key="1">
							@include('products.price_row', array('index' => 1, 'key' => 1, 'name' => '', 'amount' => '', 'isdefault' => false, 'record' => $record))
						</tr>
						<?php } ?>
						<tr>
							<td class="submit" colspan="4" style="float: none; clear:both; background:#fff;">
								<button class="button-secondary digi_add_repeatable" style="margin: 6px 0;">{{ getPhrase('add_new_price') }}</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="col-md-12">
            <h3><b>{{ getPhrase('Download Files') }}</b></h3>
		</div>
		
		<div class="col-md-12" id="downloadfiles_options_div">
			<div id="digi_file_fields" class="digi_meta_table_wrap">
				<table class="widefat digi_repeatable_table" width="100%" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th style="width: 20%">{{ getPhrase('file_name') }}</th>
							<th>{{ getPhrase('Type') }}</th>
							<th>{{ getPhrase('File URL') }}</th>
							<th class="pricing" style="width: 20%;">{{ getPhrase('price_assignment') }}
							</th>
							<th style="width: 70px">{{ getPhrase('ID') }}</th>
							<th></th>
							
						</tr>
					</thead>
					<tbody>						
						<?php	
						
						if( $record ) {
							$old_files = json_decode( $record->download_files );
//dd($old_files);
							if( ! empty( $old_files ) ) {
								foreach( $old_files as $key => $value ) {
									$value = ( array ) $value;

									$name   = isset( $value['name'] )   ? $value['name']   : '';
									$type   = isset( $value['type'] )   ? $value['type']   : 'file';
									$file_name = isset( $value['file_name'] ) ? $value['file_name'] : '';
									$index  = isset( $value['index'] )  ? $value['index']  : $key;
									$option = isset( $value['option'] ) ? $value['option'] : 'All';
									?>
									<tr class="digi_repeatable_upload_wrapper digi_repeatable_row" data-key="1">
										@include('products.downloadfile', array('key' => $key, 'index' => $index, 'prices' => $prices_options, 'name' => $name, 'type' => $type, 'file_name' => $file_name, 'option' => $option, 'record' => $record))
									</tr>
									<?php
								}
							} 
							else {
								?>
								<tr class="digi_repeatable_upload_wrapper digi_repeatable_row" data-key="1">
							@include('products.downloadfile', array('key' => 1, 'index' => 0, 'prices' => $prices_options, 'name' => '', 'type' => 'file','file_name' => '', 'option' => 'All', 'record' => $record))
						</tr>
								<?php
							}
						} 
						else {
						?>
						<tr class="digi_repeatable_upload_wrapper digi_repeatable_row" data-key="1">
							@include('products.downloadfile', array('key' => 1, 'index' => 0, 'prices' => $prices_options, 'name' => '', 'type' => 'file','file_name' => '', 'option' => 'All', 'record' => $record))
						</tr>
						<?php } 
						
						?>
						<tr>
							<td class="submit" colspan="4" style="float: none; clear:both; background: #fff;">
								 <button class="button-secondary digi_add_repeatable" style="margin: 6px 0 10px;">{{ getPhrase('add_new_file') }}</button> 
							
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		@if($record && !empty($record->download_files))
		 <?php $data = json_decode($record->download_files);
		 foreach ($data as $key => $value) {
		 	$file = isset( $value->file_name ) ? $value->file_name : '';
			if( $file == '' )
				$file = $value->name;
		 	$file_type  = $value->type;
		 	if($file_type=='url'){
		 		$title = getPhrase('clear_u_r_l');
		 	}
		 	else{
		 		$title = getPhrase('clear_file');
		 	}
		 }
		 ?>
		<span><a class="btn btn-primary" href="#" onclick="deleteProductFile('<?php echo $file;?>','<?php echo $record->id;?>')" >{{$title}}</a></span>
		@endif
		
		<div class="col-md-12">                
			<div class="form-group">
			 {{ Form::label('download_limits', getPhrase( 'download_limits' ) ) }}
			 {{ Form::number('download_limits',null, $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Leave blank for global setting or 0 for unlimited' ), 'data-toggle' => 'tooltip')) }}
			</div>
		</div>
		<div class="col-md-12">							
			<?php $product_belongs = array(
              '1'=>getPhrase('self_upload'),
              '0'=>getPhrase('Thrid_party')

			);?>
			<div class="form-group">
			{{ Form::label('product_belongsto', getPhrase( 'product_belongsto' ) ) }}
			{{Form::select('product_belongsto', $product_belongs, null, ['class'=>'form-control', "id"=>"product_belongsto", 'data-toggle' => 'tooltip'])}}
			</div>	   
		</div>
		
		<div class="col-md-6">                
			<div class="form-group">
			 {{ Form::label('demo_link', getPhrase( 'demo_link' ) ) }}
			 {{ Form::text('demo_link', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('demo_link Eg: http://site.com'), 'data-toggle' => 'tooltip')) }}
			</div>
		</div>
		<div class="col-md-6">                
			<div class="form-group">
			 {{ Form::label('image', getPhrase('preview_image') ) }}
			 {{ Form::file('image', $value = null , $attributes = array('class'=>'form-control', 'data-toggle' => 'tooltip')) }}
			 <?php
			 if( $record && $record->image!='' ) {

				 echo '<img src="'.UPLOAD_URL_PRODUCTS_THUMBNAIL.$record->image.'" height="60" width="70" alt="'.$record->name.'" title="'.$record->name.'">';

			 }
			 if($record && $record->image==''){
			 	 echo '<img src="'.DEFAULT_PRODUCT_IMAGE_THUMBNAIL.'" height="60" width="70">';
			 }
			 ?>
			</div>
		</div>
			
		<div class="col-md-12">
			<div class="form-group">
				{{ Form::label('licence_of_use', getPhrase( 'licence_of_use' ) ) }}               
				{{ Form::textarea('licence_of_use', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'licence_of_use for the product' ), 'rows'=>'4', 'data-toggle' => 'tooltip', 'title' => getPhrase('licence_of_use_for_the_product'))) }}
			</div>
			<div class="form-group">
				{{ Form::label('technical_info', getPhrase( 'technical_info' ) ) }}               
				{{ Form::textarea('technical_info', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'technical_info for the product' ), 'rows'=>'4', 'data-toggle' => 'tooltip', 'title' => getPhrase('technical_info_for_the_product'))) }}
			</div>
			<div class="form-group">
				{{ Form::label('description', getPhrase( 'description' ) ) }}  
				<span class="text-red">*</span>             
				{{ Form::textarea('description', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Description for the product' ), 'rows'=>'4', 'data-toggle' => 'tooltip', 'title' => getPhrase('description_for_the_product'))) }}
			</div>
			<div class="form-group">
				{{ Form::label('download_notes', getPhrase( 'download_notes' ) ) }}               
				{{ Form::textarea('download_notes', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Download notes for the product' ), 'rows'=>'4', 'data-toggle' => 'tooltip', 'title' => getPhrase('download_notes_for_the_product'))) }}
			</div>
			<h2>{{getPhrase('seo_settings')}}</h2>
			<div class="form-group">
			 {{ Form::label('meta_tag_title', getPhrase( 'title_meta_tag' ) ) }}
			 {{ Form::text('meta_tag_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'title_meta_tag' ), 'data-toggle' => 'tooltip', 'title' => getPhrase('product_seo_title'))) }}
			</div>
		</div>
			
			<div class="col-md-6">
				<div class="form-group">
				{{ Form::label('meta_tag_description', getPhrase( 'description_meta_tag' ) ) }}               
				{{ Form::textarea('meta_tag_description', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'description_meta_tag' ), 'rows'=>'4', 'data-toggle' => 'tooltip')) }}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				{{ Form::label('meta_tag_keywords', getPhrase( 'kewords_meta_tag' ) ) }}               
				{{ Form::textarea('meta_tag_keywords', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'kewords_meta_tags_separated_with_comma(,)' ), 'rows'=>'4', 'data-toggle' => 'tooltip')) }}
				</div>
			</div>
			
     
			
        </div>   
              <!-- /.box-body -->
              <div class="box-footer">
&nbsp;

<div class="btn-center">
    <button type="submit" class="btn btn-primary" >{{getPhrase($button_name)}}</button>
</div>
</div>
</div>
              
     


