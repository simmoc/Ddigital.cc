@extends($layout)

@section('content')

<div id="page-wrapper" class="edd-vcategory">
			<div class="container-fluid">
				<!-- Page Heading -->
		@if(Auth::user()->role_id == OWNER_ROLE_ID || Auth::user()->role_id == ADMIN_ROLE_ID || Auth::user()->role_id == EXECUTIVE_ROLE_ID)		
				<section class="content-header">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
						 <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"> {{getPhrase('home')}}</i></a> </li>
              <li><a href="{{URL_PRODUCTS_DASHBOARD}}"> {{getPhrase('products_dashboard')}}</a> </li>
              <li><a href="{{URL_PRODUCTS}}">{{getPhrase('products')}}</a> </li>
              <li><a href="{{URL_PRODUCT_DETAILS.$product_details->id}}">{{$product_details->name}} {{getPhrase('dashboard')}}</a> </li>
              <li>{{$product_details->name}} {{getPhrase('categories')}}</li>
						</ol>
					</div>
				</div>
				</section>

	    @endif			
								
				<!-- /.row -->
				

						@if(Auth::user()->role_id == VENDOR_ROLE_ID)
	
	
	<!--SECTION cart DASHBOARD-2-->
    <section class="dashboard2">
        <div class="container edd-wrappers">
            <h2>{{ getPhrase('my_dashboard') }}</h2>
			@include('productvendor.menu', array('sub_active' => $sub_active, 'tab' => 'products'))
			<div class="box-header">
			<a href="{{URL_PRODUCTS_ADD}}" class="btn btn-primary pull-right">{{ getPhrase('Add') }}</a>
            </div>
			<div id="history" class="tab-pane fade in active">
				
				<table id="example2" class="table table-bordered table-hover datatable">
					<thead>
								<tr>
									<th>{{ getPhrase('sno')}}</th>
									<th>{{ getPhrase('product_name')}}</th>
									<th>{{ getPhrase('category')}}</th>
									{{-- <th>{{ getPhrase('image')}}</th> --}}
									<th>{{ getPhrase('status')}}</th>
									
								</tr>
							</thead>
							<?php $sno = 1; ?>
							@foreach($categories as $category)
							 <?php $category_details  = App\Category::where('id','=',$category->category_id)
							                                          ->get()->first();

                              ?>
							<tr>
								<td>{{$sno++}}</td>
								<td>{{$product_details->name}}</td>
								<td>{{$category_details->title}}</td>
								<td>{{$category_details->status}}</td>
								
							</tr>
							@endforeach
					
				  </table>
			</div>
		</div>
	</section>
	@else 

	                <div class="panel panel-custom">
					<div class="panel-heading">
					<div>
						
						<h2>{{$product_details->name}}-{{getPhrase('categories_list')}}</h2>

						</div>
					
					<div class="panel-body packages" id="myForm">
						<div> 
						<table class="table table-striped table-bordered student-attendance-table datatable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ getPhrase('s.no', 'upper')}}</th>
									<th>{{ getPhrase('product_name')}}</th>
									<th>{{ getPhrase('category')}}</th>
									{{-- <th>{{ getPhrase('image')}}</th> --}}
									<th>{{ getPhrase('status')}}</th>
									
								</tr>
							</thead>
							<?php $sno = 1; ?>
							@foreach($categories as $category)
							 <?php $category_details  = App\Category::where('id','=',$category->category_id)
							                                          ->get()->first();

                              ?>
							<tr>
								<td>{{$sno++}}</td>
								<td>{{$product_details->name}}</td>
								<td>{{$category_details->title}}</td>
								<td>{{$category_details->status}}</td>
								
							</tr>
							@endforeach
						</table>

						@endif
						</div>
						
					</div>
				</div>

			</div>
		</div>
</div>
@endsection
@section('footer_scripts')
  
@stop
