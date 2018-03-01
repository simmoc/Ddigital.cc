@extends('layouts.layout-site')

@section('content')
	<!--Inner Banner-->
    <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2>{{ $title }}</h2>
                </div>
            </div>
        </div>
    </section>
    <!--/Inner Banner-->


	<!--section-4 CATEGORIES-->
    <div class="categories ">
        <div class="container">
            <div class="row cs-row">
                <div class="col-sm-12">
                    <div class="tabs1">
                        <ul class="list-inline">
                            <li><a href="#">Most Popular</a></li>
                            <li><a href="#">Featured</a></li>
                            <li><a href="#">Latest</a></li>
                            <li><a href="#">Freebies</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <!--for left side columns-->
                    <div class="panel panel-default">
                        <div class="panel-heading">CATEGORIES</div>
                        <div class="panel-body">
                            <?php
							$categories = App\Category::where('status', '=', 'Active');
							?>
							@if( $categories->count() > 0 )
							<ul class="nav nav-pills nav-stacked">
								@foreach( $categories->get() as $category)
									<li class="{{ isActive($selected_categpry, $category->slug) }}">
									@if( $category->parent_id == 0 )
									<a href="{{ URL_DISPLAY_PRODUCTS .'/' . $category->slug}}">{{ $category->title}}<span class="number">({{ App\Products_Categories::where('category_id', '=', $category->id)->count() }})</span></a>
									<?php
									$subcats = App\Category::where('status', '=', 'Active')->where('parent_id', '=', $category->id);
									?>
									@if( $subcats->count() > 0 )
										<ul class="dropdown-menu">
										@foreach( $subcats->get() as $subcat)
											<li><a href="{{ URL_DISPLAY_PRODUCTS .'/' . $category->slug . '/' . $subcat->slug}}"> {{ $subcat->title }}</a> </li>
										@endforeach
										</ul>
									@endif
									@endif
									</li>
								@endforeach                                
                            </ul>
							@endif

                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <!--for right side columns-->
                   
					<div class="row">
                        @if( $products->count() > 0 )
							@foreach( $products as $product )
							<div class="col-md-4 col-sm-6">
								<!-- Product -->
								<div class="product">
									<div class="portfolio-item">
										<img src="images/1.png" class="img-responsive" alt="">
										<!-- portfolio item hover -->
										<div class="portfolio-hover">
											<div class="portfolio-hover-content font-reg">
												<ul class="pair-btns">
													<li><a href="#" class="btn btn-buy">Buy Now</a></li>
													<li><a href="#" class="btn btn-view">Details</a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product-content">
										<span class="product-price">{{ $product->price }}</span>
										<a href="#" class="product-title"> {{ $product->name }} </a>
										<a href="#">
											<div class="product-author ">
												<div class="media-left">
													<img src="images/author.png" alt="user-avatar" class=" img-circle">
												</div>
												<div class="media-body">
													<p>Yaswin Satya </p>
												</div>
											</div>
										</a>
									</div>
								</div>
								<!-- /Product -->
							</div>
							@endforeach
							
						@endif

                    </div>
					
					{{ $products->links() }}
					<?php /*?>
                    <!--for pagination-->
                    <ul class="pagination pull-right">

                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><span> . </span></li>
                        <li><span> . </span></li>
                        <li><span> . </span></li>
                        <li><span> . </span></li>
                        <li><span> . </span></li>
                        <li><span> . </span></li>


                        <li><a href="#">14</a></li>

                    </ul>
					<?php */?>
                </div>
            </div>
        </div>
    </div>
    <!--/section-4 CATEGORIES-->
	
	<!--SECTION-5 SIGN UP-->
    <section class="signup">
        <div class="container">
            <h3>Nullam quis ante.Etiam sit amet orci eget eros faucibus tincidunt</h3>
            <div class="sign">
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Email Address">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary">SIGN UP</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/SECTION-5 SIGN UP-->
@endsection