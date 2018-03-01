@if(count($errors) > 0 )
 <div class="alert alert-danger alert-dismissible">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<ul class="list-unstyled">
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
</div>
@endif

@if (Session::has('flash_message'))
<?php
$type = 'danger';
if(Session::get('flash_message.type') == 'success')
	$type = 'success';
?> 
<div class="alert alert-<?php echo $type;?> alert-dismissible">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<ul class="list-unstyled">		
		<li>{{{ Session::get('flash_message.text') }}}</li>
	</ul>
</div>
@endif
 
 