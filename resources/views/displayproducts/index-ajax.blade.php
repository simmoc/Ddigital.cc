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
	
	@include('displayproducts.products-view', array('products' => $products))
	
	<!--SECTION-5 SIGN UP-->
    @include('common.subscrption-form')
    <!--/SECTION-5 SIGN UP-->
@endsection
@section('footer_scripts')
	<script>
    /*
	$(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getProducts(page);
            }
        }
    });
	*/
	/*
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getProducts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
    function getProducts(page, param) {
        $.ajax({
            url : '?page=' + page + '&param=' + param,
            dataType: 'html',
        }).done(function (data) {
            $('#products').html(data);			
			//window.location.hash = '?page=' + page + '&param=' + param;
			//location.hash = page;
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
    }
	*/
    </script>
@endsection