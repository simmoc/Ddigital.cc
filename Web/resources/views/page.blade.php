@extends('layouts.layout-site')

@section('content')

<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>{{ $record->title }}</h2>
			</div>
		</div>
	</div>
</section>
<!--/SECTION BANNER-->
<!--section-4 Maintenance-->

<section class="maintenance">
	<div class="container">
		<h2 class="heading heading-center"> {{ $record->title }}</h2>

		<div class="row  animated fadeInDown">
			{!! $record->content !!}
		</div>
	</div>
</section>

<!--/SECTION-4 Maintenance -->
@endsection