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
           
            @include('productvendor.menu', array('sub_active' => $sub_active, 'tab' => $tab))

            <div class="tab-content  animated fadeInDown">
                <div id="dashboard" class="tab-pane fade <?php if( $tab == 'dashboard' ) echo 'in active';?>">
                    
						<div><a>purchases</a></div>
						<div><a>Edit</a></div>
						<div><a>Profile</a></div>
					
                </div>
				
				<div id="history" class="tab-pane fade <?php if( $tab == 'purchases' ) echo 'in active';?>">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>License</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('customer.purchases', array('purchases' => $purchases, 'tab' => $tab))							
                        </tbody>
                    </table>
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