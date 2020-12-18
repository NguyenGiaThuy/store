@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-container"></div>
    <div class="product">
        <div class="product-container">
            <div class="left-menu-nav">
                <h3>Catalog</h3>

                <ul class="kind">
                    <li class="name">Catalog</li>
                    <li><a href="">New Products</a></li>
                    <li><a href="">Wireless Headsets</a></li>
                    <li><a href="">Wired Headset</a></li>
                </ul>

                <ul class="brand">
                    <li class="name">Brand
                        <ul class="dropdown">
                            <li><a href="">Anker</a></li>
                            <li><a href="">ROG</a></li>
                            <li><a href="">Azus</a></li>
                            <li><a href="">Apple</a></li>
                            <li><a href="">Sony</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-product">
                <div class="container">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
