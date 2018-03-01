@extends('layouts.layout-site')

@section('content')

<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>FAQs</h2>
			</div>
		</div>
	</div>
</section>
<!--/SECTION BANNER-->

<!--section-FAQ-->
<section class="faq">
	<div class="container">

		<div class="row  animated fadeInDown">
			@if($faqs->count() > 0)
			<div class="col-md-6">
				<div class="panel-group" id="accordation">
					@foreach( $faqs as $faq )
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5 class="panel-title">
					  <a data-toggle="collapse" data-parent="#accordation" href="#collapse{{$faq->id}}"><span class="fa {{ $faq->icon }}"></span>{{ $faq->title }}</a>
					  </h5>
						</div>
						<div id="collapse{{$faq->id}}" class="panel-collapse collapse ">
							<div class="panel-body">
								<h6> {{ $faq->description }}</h6>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			@endif

		</div>
	</div>
</section>
<!--/section-FAQ-->
@endsection