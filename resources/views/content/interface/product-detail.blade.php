@extends('layouts/blankLayout')
@section('title', 'Находки с WILDBERRIES | Озон | Скидки| Кешбек')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/interface/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/interface/style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"> --}}
@endsection

@section('page-script')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/interface/main.js') }}"></script>

@endsection

@section('content')

    <body>

        <!-- Spinner Start -->
        <div id="spinner"
            class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-info" role="status"></div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar start -->
        @include('content/interface/include/header')
        <!-- Navbar End -->


        <!-- Single Page Header start -->
        {{-- <div class="container-fluid page-header py-5"> </div> --}}
        <img src="{{ asset('assets/img/interface/bannerCashback.png') }}" class="img-fluid banner-img"
            alt="Cashback header photo">

        <!-- Single Page Header End -->

        <!-- Single Product Start -->
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    {{-- Carusel --}}
                                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            @foreach ($product->images as $index => $image)
                                                <button type="button" data-bs-target="#carouselExample"
                                                    data-bs-slide-to="{{ $index }}"
                                                    class="{{ $index == 0 ? 'active' : '' }}"
                                                    aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                                    aria-label="Slide {{ $index + 1 }}"></button>
                                            @endforeach
                                        </div>
                                        <div class="carousel-inner">
                                            @if ($product->videos->count())
                                                <video class="d-block w-100" controls>
                                                    <source
                                                        src="{{ route('get-file', ['path' => $product->videos[0]->path]) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                @foreach ($product->images as $index => $image)
                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                        <img class="d-block w-100"
                                                            src="{{ route('get-file', ['path' => $image->path]) }}"
                                                            alt="Slide {{ $index + 1 }}" />
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExample" role="button"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExample" role="button"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>

                                    {{-- End Carusel --}}

                                    {{-- @dd($product) --}}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3">{{ json_decode($product->product_details)->title }}</h4>
                                <p class="mb-3">Категория: {{ $product->category->name }}</p>
                                <h5 class="fw-bold mb-3">Цена:
                                    {{ json_decode($product->product_details)->price_in_store }}₽</h5>
                                <h5 class="fw-bold mb-3">Кешбек: {{ json_decode($product->product_details)->cashback }}%
                                </h5>
                                <h5 class="fw-bold mb-3">Согласовать выкуп с: <a style="color: #ac51b5;"
                                        href="https://t.me/{{ json_decode($product->product_details)->owner }}"
                                        target="_blank">{{ json_decode($product->product_details)->owner }}</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Product End -->

        @include('content/interface/include/footer')

    </body>
@endsection
