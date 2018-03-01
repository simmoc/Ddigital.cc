<div class="box-body">
	<div class="col-md-6">                
		<div class="form-group">
			{{ Form::label('title', getPhrase( 'Title of the Menu Item' ) ) }} {!! required_field(); !!}
			{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Title of the Menu Item' ),
			'ng-model' => 'title',
			'required' => true,
			'ng-class'=>'{"has-error": formName.title.$touched && formName.title.$invalid}',
			)) }}
			<div class="validation-error" ng-messages="formName.title.$error" >
			{!! getValidationMessage()!!}
			</div>
		</div>		
	</div>
	
	<div class="col-md-6">                
		<div class="form-group">
			{{ Form::label('url', getPhrase( 'url', 'upper' ) ) }} {!! required_field(); !!}
			{{ Form::text('url', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'url', 'upper' ),
			'ng-model' => 'url',
			'required' => true,
			'ng-class'=>'{"has-error": formName.url.$touched && formName.url.$invalid}',
			)) }}
			<div class="validation-error" ng-messages="formName.url.$error" >
			{!! getValidationMessage()!!}
			</div>
		</div>		
	</div>
	
	<div class="col-md-6">                
		<?php 
		$target['_self'] = getPhrase('Same Page');
		$target['_blank'] = getPhrase( 'Other Page' );
		$target['sameplace'] = getPhrase('Print in Same Place');
		?>
		<div class="form-group">
		{{ Form::label('target', getPhrase( 'Open in' ) ) }}
		{{Form::select('target', $target, null, ['class'=>'form-control', "id"=>"target"])}}
		</div>
	</div>
	<div class="col-md-6">                
		<div class="form-group">
			{{ Form::label('menu_order', getPhrase( 'order' ) ) }} {!! required_field(); !!}
			{{ Form::number('menu_order', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'order' ),
			'ng-model' => 'menu_order',
			'required' => true,
			'ng-class'=>'{"has-error": formName.menu_order.$touched && formName.menu_order.$invalid}',
			)) }}
			<div class="validation-error" ng-messages="formName.menu_order.$error" >
			{!! getValidationMessage()!!}
			</div>
		</div>		
	</div>

	<div class="col-md-6">                
		<div class="form-group">
			{{ Form::label('menu_active_title', getPhrase( 'menu_active_title', 'upper' ) ) }} {!! required_field(); !!}
			{{ Form::text('menu_active_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'menu_active_title', 'upper' ),
			'ng-model' => 'menu_active_title',
			'required' => true,
			'ng-class'=>'{"has-error": formName.menu_active_title.$touched && formName.menu_active_title.$invalid}',
			)) }}
			<div class="validation-error" ng-messages="formName.menu_active_title.$error" >
			{!! getValidationMessage()!!}
			</div>
		</div>			
	</div>
	@if($record && $record->slug=='pages-18')
	<div class="col-md-6">                
		<?php 
		$pages = array( 'Options' => array( '0' => getPhrase('URL Content'), 'description' => getPhrase('Use Description'), 'pages' => getPhrase('Display Pages') ) )+array('Pages' => array_pluck(App\Pages::where('status', '=', 'Active')->get(), 'title', 'id'));
		?>
		<div class="form-group">
		{{ Form::label('page_id', getPhrase( 'Display' ) ) }}
		{{Form::select('page_id', $pages, null, ['class'=>'form-control', "id"=>"page_id"])}}
		</div>		
	</div>
	
	<div class="col-md-6">                
		<?php 
		$pages = array_pluck(App\Pages::where('status', '=', 'Active')->get(), 'title', 'id');
		?>
		<div class="form-group">
		{{ Form::label('pages[]', getPhrase( 'Display_items' ) ) }}
		{{Form::select('pages[]', $pages, null, ['class'=>'form-control select2', "id"=>"pages", 'multiple' => 'multiple'])}}
		</div>		
	</div>

@endif


	
	<div class="col-md-6">                
		<?php 
		$status['active'] = 'Active';
		$status['inactive'] = 'Inactive';
		?>
		<div class="form-group">
		{{ Form::label('status', getPhrase( 'status' ) ) }}
		{{Form::select('status', $status, null, ['class'=>'form-control', "id"=>"status"])}}
		</div>		
	</div>

	
	<div class="col-md-12">                
		<div class="form-group">
		{{ Form::label('description', getPhrase( 'Description' ) ) }}               
		{{ Form::textarea('description', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Enter decription' ), 'rows'=>'4')) }}
		</div>
	</div>
</div>   
<!-- /.box-body -->

<div class="box-footer">
    <div class="btn-center">
	<button type="submit" class="btn btn-primary">{{$button_name}}</button>
	</div>
	<input type="hidden" name="menu_id" id="menu_id" value="{{ $menu_id }}">
	<input type="hidden" name="menu_slug" id="menu_slug" value="{{ $menu_slug }}">
</div>