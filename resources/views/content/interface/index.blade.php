@extends('layouts/blankLayout')
@section('title', 'Находки с WILDBERRIES | Озон | Скидки| Кешбек')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/interface/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/interface/style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('page-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>

    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/interface/main.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/interface/filter.js') }}"></script>

@endsection

@section('content')

    <body>

        <!-- Spinner Start -->
        <div id="spinner"
            class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-info" role="status"></div>
        </div>
        <!-- Spinner End -->
        @include('content/interface/include/header')

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords"
                                aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

        <!-- Single Page Header start -->
        {{-- <div class="container-fluid page-header py-6"> </div> --}}
        <img src="{{ asset('assets/img/interface/bannerCashback.png') }}" class="img-fluid banner-img"
            alt="Cashback header photo">

        <!-- Single Page Header End -->

        <!-- Product Shop Start-->
        <div class="container-fluid fruite">
            <div class="container py-4">
                <h1 class="mb-4">На Сайте Nver.am можно найти товар со 100%  кэшбеком.</h1>
                <h5 class="mb-4">Для начало выберите товар из представленного ассортимента, и свяжитесь с продавцем для уточнения деталей получения кешбека.</h5>
                <div class="col-lg-12 col-md-12 resp-video">
                    <h4 class="mb-2">Инфо блог</h4>
                    <video style="height: 500px; width: 100%;" class="video" controls>
                        <source
                            src="{{asset('assets/img/interface/video/education.mp4')}}"
                            type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <p>Вам 18 лет или более? </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="year-btn-yes" class="btn yes-btn-modal"
                                    data-dismiss="modal">Да</button>
                                <button type="button" id="year-btn-no" class="btn no-btn-modal"
                                    data-dismiss="modal">Нет</button>
                            </div>
                        </div>
                        <input type="hidden" id="year-value" value="false">
                    </div>
                </div>
                <div class="modal fade" id="myModalFilter" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>В поиске товаров есть предметы, предназначенные для категории 18+. Вам есть 18 лет?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="year-filter-btn-yes" class="btn yes-btn-modal"
                                    data-dismiss="modal">Да</button>
                                <button type="button" id="year-filter-btn-no" class="btn no-btn-modal"
                                    data-dismiss="modal">Нет</button>
                            </div>
                        </div>
                        <input type="hidden" id="last-clicked-value" value="false">
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <div class="input-group mx-auto d-flex">
                                    {{-- <div class="d-flex search-input-interface">
                                        <input type="text" id="title-search" class="form-control p-3" name="title"
                                            placeholder="поиск..." value="{{ request('title') }}">
                                        <button type="submit" id="title-search-submit" class="input-group-text p-3 "><i
                                                class="fa fa-search"></i></button>
                                    </div> --}}
                                    <div class="input-group search-input-interface">
                                        <input type="text" id="title-search" class="form-control p-3" name="title"
                                            placeholder="поиск..." value="{{ request('title') }}">
                                        <div class="input-group-append">
                                            <button type="submit" id="title-search-submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Сортировка:</label>
                                    <select id="select-submit" name="fruitlist"
                                        class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                        <option value="">Новые</option>
                                        <option value="min">По возрастанию</option>
                                        <option value="max">По убыванию</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Категории</h4>
                                            <ul class="list-unstyled categorie-list">
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <button type="submit" class="category-button" name='category'
                                                            value='{{ $category->id }}'>{{ $category->name }}</button>
                                                    </li>
                                                    {{-- <div class="d-flex justify-content-between fruite-name">
                                                    <a href="#" name="category"><i
                                                            class="fas fa-apple-alt me-2"></i>{{ $category->name }}</a>
                                                </div> --}}
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" id="last-adult" value="">
                                    {{-- <input type="hidden" id="adult-agree" value=""> --}}
                                    <img class="cashback-100-procent" id="cahsback100" src="{{ asset('assets/img/interface/cashBackButton.png') }}"
                                            alt="100% Cashback">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4 class="mb-2">Процент кешбека</h4>
                                            <input type="range" class="custom-form-range w-100" id="procent-submit"
                                                name="procent" min="0" max="100" value="0"
                                                oninput="document.getElementById('procent').value = this.value">
                                            <output id="procent" name="procent" min-velue="0" max-value="100"
                                                for="procent">0</output>%
                                        </div>
                                    </div>
                                            
                                    {{-- Start education video --}}
                                    <div class="col-lg-12 resp-video-orginal">
                                        <h4 class="mb-2">Инфо блог</h4>
                                        <video height="500" class="video" controls>
                                            <source
                                                src="{{asset('assets/img/interface/video/education.mp4')}}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    {{-- End education video --}}

                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div id='product-start' class="row g-4 justify-content-center">
                                    {{-- @foreach ($products as $product)
                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                            <div class="rounded position-relative fruite-item border rounded-bottom">
                                                <div class="fruite-img">
                                                    <a href="{{ route('get-details', ['id' => $product->id]) }}"
                                                        target="_blank">
                                                        @if ($product->videos->count())
                                                            <video style="height: 400px" controls>
                                                                <source
                                                                    src="{{ route('get-file', ['path' => $product->videos[0]->path]) }}"
                                                                    type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @else
                                                            <img style="height: 400px" loading="lazy"
                                                                src="{{ $product->images->count() ? route('get-file', ['path' => $product->images[0]->path]) : '' }}"
                                                                class="img-fluid w-100 rounded-top" alt="">
                                                        @endif
                                                        
                                                    </a>
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">{{ $product->category->name }}
                                                </div>
                                                <div style="overflow: auto; height: 200px;">
                                                    <div class="p-4">
                                                        <h4>{{ json_decode($product->product_details)->title }}</h4>
                                                        <p>Кешбек: {{ json_decode($product->product_details)->cashback }}%
                                                        </p>
                                                        <p>Согласовать выкуп с: <a style="color: #ac51b5;"
                                                                href="https://t.me/{{ json_decode($product->product_details)->owner }}"
                                                                target="_blank">{{ json_decode($product->product_details)->owner }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex  flex-lg-wrap p-4">
                                                    <p style="text-decoration: line-through;">
                                                        {{ json_decode($product->product_details)->price_in_store }}₽
                                                    </p>
                                                    &nbsp;&nbsp;
                                                    <p class="text-danger fs-5 fw-bold mb-0">
                                                        {{ getProductProcent(json_decode($product->product_details)->price_in_store, json_decode($product->product_details)->cashback) }}₽
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Shop End-->

        @include('content/interface/include/footer')


    </html>

@endsection
