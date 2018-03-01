@extends('layouts.layout-admin')
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')


<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
                <section class="content-header">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i>{{getPhrase('home')}}</a> </li>
							
							<li>{{ $title }}</li>
						</ol>
					</div>
				</div>
                </section>	
				<!-- /.row -->
				<div class="panel panel-custom">
					<div class="panel-heading">
						
						<div class="pull-right messages-buttons">
							
						</div>
						<h1>{{ $title }}</h1>
					</div>
					<div class="panel-body packages">
						<div > 
						<table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ getPhrase('module')}}</th>
									<th>{{ getPhrase('key')}}</th>
									<th>{{ getPhrase('description')}}</th>
									<th>{{ getPhrase('action')}}</th>
								</tr>
							</thead>
							 
						</table>
						</div>

					</div>
				</div>
			
			<!-- /.container-fluid -->
		</div>
</div>
@endsection
 

@section('footer_scripts')

 @include('common.datatables', array('route'=>'mastersettings.dataTable'))
 @include('common.deletescript', array('route'=>'/mastersettings/topics/delete/'))

@stop
 