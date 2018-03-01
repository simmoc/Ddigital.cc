@extends('layouts.layout-site')

@section('content')
     <!-- 404 -->
    <div class="section cs-nopad">
        <div class="container">
            <!-- Tabs -->
            <div class="row cs-row center">
                <h1 class="not-found-heading">404</h1>
                <h2 class="not-found-title">The page you were looking for doesn’t exist</h2>
                <h3 class="not-found-subtitle">You may have mistyped address or the page may have moved.</h3>
                <p style="text-align: center"><a href="{{PREFIX}}" class="btn btn-primary btn-link">Go to Home page</a></p>
            </div>
        </div>
    </div>
    <!-- 404 -->
@stop
@section('footer_scripts')

@stop