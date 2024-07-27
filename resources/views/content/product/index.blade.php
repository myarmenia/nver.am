@extends('layouts/contentNavbarLayout')

@section('title', 'Находки с WILDBERRIES | Озон | Скидки| Кешбек')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary">Продукты</h5>
                <form action="{{ route('add-new-product') }}" method="GET">
                    <button> Получать новые публикации</button>
                </form>
                @error('category_id')
                    <div class="alert alert-danger" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                @enderror
                @if ($products)
                    @foreach ($products as $key => $product)
                        {{-- {{info($key)}} --}}

                        <?php
                        // echo $product->id
                        // dd($product)
                        // if($key == 2){
                        //   dd($product);
                        // }
                        ?>
                        <div class="col-md">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        @if ($product->videos->count())
                                            <video width="100%"  controls>
                                                <source src="{{route('get-file', ['path' => $product->videos[0]->path])}}" type="video/mp4">
                                                Your browser does not support the video tag.
                                          </video>
                                        @else
                                            <img width="100%"
                                                src="{{ $product->images->count() ? route('get-file', ['path' => $product->images[0]->path]) : '' }}"></img>
                                            
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <pre style="font-size: 20px">
                                            {{ json_decode($product->text, true) }}
                                            </pre>
                                        </div>
                                        @if($product->type == App\Models\Product::TYPE_CUSTOM)
                                        <div class="card-body " >ID: <strong>{{$product->payment_id}}
                                        </div>
                                        @endif
                                        @if($product->type == App\Models\Product::TYPE_CUSTOM)
                                        <div class="card-body " >
                                          <h3 class="text-danger"> Тип добавления: <strong>{{$product->type}}</strong></h3>
                                        </div>
                                        @endif
                                        <form method="POST" action="{{ route('edit-product', ['id' => $product->id]) }}">
                                            <div class="">
                                                <div class="m-1 row">
                                                    <label for="html5-text-input" class="col-md-2 col-form-label">Заголовок</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="title"
                                                            value="{{ json_decode($product->product_details)->title }}" />
                                                    </div>
                                                </div>
                                                <div class="m-1 row">
                                                    <label for="html5-text-input" class="col-md-2 col-form-label">Цена</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="price_in_store"
                                                            value="{{ json_decode($product->product_details)->price_in_store }}" />
                                                    </div>
                                                </div>
                                                <div class="m-1 row">
                                                    <label for="html5-text-input"
                                                        class="col-md-2 col-form-label">Кешбек</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="cashback"
                                                            value="{{ json_decode($product->product_details)->cashback }}" />
                                                    </div>
                                                </div>
                                                <div class="m-1 row">
                                                    <label for="html5-text-input" class="col-md-2 col-form-label">Владелец</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="owner"
                                                            value="{{ json_decode($product->product_details)->owner }}" />
                                                    </div>
                                                </div>
                                                <div class="m-1 row">
                                                    <label for="html5-text-input" class="col-md-2 col-form-label">Категория</label>
                                                    <div class="col-md-10">
                                                        <select id="defaultSelect" class="form-select" name="category_id">
                                                            <option value="">Выбирать</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"  {{ $category->id ==  $product->category_id ? 'selected' : '' }}>{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="m-1 row">
                                                    <label for="topcheck" class="col-md-2 col-form-label">Топ</label>
                                                    <div class="col-md-10">
                                                        <input class="form-check-input" type="checkbox" name="top" value="1" id="topcheck" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <button type="submit" class="btn btn-success" value="edit">Подтверждать</button>
                                                <a class="btn btn-danger" href="{{ route('delete-product', ['id' => $product->id]) }}">Удалить</a>
                                            </div>
                                        </form>

                                    </div>

                                </div>
                            </div>
                    @endforeach
                @else 
                    <h1>Продукты отсутствуют</h1>
                @endif
            </div>
        </div>

    </div>

@endsection
