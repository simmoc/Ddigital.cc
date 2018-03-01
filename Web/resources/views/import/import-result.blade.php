@extends($layout)

@section('content')

<!-- Content Header (Page header) -->
 <section class="content-header">

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{ getPhrase('home') }}</a> </li>
			@if( $model == 'category' )
				<li><a  href="{{URL_CATEGORIES_DASHBOARD}}">{{ getPhrase('categories_dashboard')}}</a></li>
				<li><a  href="{{URL_CATEGORIES}}">{{ getPhrase( $prev_title )}}</a></li>
			@elseif( $model == 'product' )
				<li><a  href="{{URL_PRODUCTS_DASHBOARD}}">{{ getPhrase('products_dashboard')}}</a></li>
				<li><a  href="{{URL_PRODUCTS}}">{{ getPhrase( $prev_title )}}</a></li>
			@elseif( $model == 'user' )
				<li><a  href="{{URL_ADMIN_USERS_DASHBOARD}}">{{ getPhrase('users_dashboard')}}</a></li>
				<li><a  href="{{URL_USERS.'all'}}">{{ getPhrase( $prev_title )}}</a></li>
			@endif
			<li class="active">{{isset($title) ? $title : ''}}</li>
		</ol>
	</div>
</div>
</section>

<?php /*?>
<div id="page-wrapper">
			<div class="container-fluid">			
								

				<!-- /.row -->
				<div class="panel panel-custom">
					
					<div class="panel-body packages">



<ul class="nav nav-tabs add-studentlist-tabs">

  <li class="active"><a data-toggle="tab" href="#home">{{getPhrase('success')}} <span class="badge badge-success">{{count($success_list)}}</span></a>

  </li>

  <li><a data-toggle="tab" href="#menu1">{{getPhrase('failed')}}<span class="badge badge-error">{{count($failed_list)}}</span></a></li>

</ul>



<div class="tab-content">

  <div id="home" class="tab-pane fade in active">

     <h3>Success</h3>

    

    <div class="table-responsive"> 

						<table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">

							<thead>

								<tr>

								 	<th>{{ getPhrase('name')}}</th>

									<th>{{ getPhrase('email')}}</th>

									<th>{{ getPhrase('phone')}}</th>

									<th>{{ getPhrase('address')}}</th>

									<th>{{ getPhrase('status')}}</th>

								</tr>

							</thead>

							 <tbody>

							<?php foreach($success_list as $list) {

								$list = (object) $list;

								?>

							 	<tr>

							 		<td>{{$list->name}}</td>

							 		<td>{{$list->email}}</td>

							 		<td>{{$list->phone}}</td>

							 		<td>{{$list->address}}</td>

							 		<td class="text-success">Success</td>

							 	</tr>

							<?php } ?>

							  

							 </tbody>

						</table>

						</div>

  </div>

  <div id="menu1" class="tab-pane fade">

    <h3>Failed</h3>

    

    <div class="table-responsive"> 

						<table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">

							<thead>

								<tr>

								 	<th>{{ getPhrase('name')}}</th>

									<th>{{ getPhrase('email')}}</th>

									<th>{{ getPhrase('phone')}}</th>

									<th>{{ getPhrase('address')}}</th>

									<th>{{ getPhrase('status')}}</th>

								</tr>

							</thead>

							 <tbody>

							<?php foreach($failed_list as $list) {

								$list = (object) $list;

								?>

							 	<tr>

							 		<td>{{$list->record->name}}</td>

							 		<td>{{$list->record->email}}</td>

							 		<td>{{$list->record->phone}}</td>

							 		<td>{{$list->record->address}}</td>

							 		<td class="text-danger">{{$list->type}}</td>

							 	</tr>

							<?php } ?>

							  

							 </tbody>

						</table>

						</div>

  </div>

  </div>

  

</div>

						<div class="table-responsive"> 

						 

						</div>

						 



					</div>



				</div>

			</div>
<?php */?>
<!-- /.container-fluid -->
@endsection

