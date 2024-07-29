@extends('layouts/contentNavbarLayout')

@section('title', 'Находки с WILDBERRIES | Озон | Скидки| Кешбек')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary">Продукты</h5>
                
                @if ($products)
                    <div class="card">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>

                                        <th>payment_id</th>
                                        <th>link</th>
                                        <th>owner_email</th>
                                        <th>cashback</th>
                                        <th>owner</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                @foreach ($products as $key => $product)
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>{{ $product->payment_id }}</td>
                                            <td>{{ $product->link }}</td>
                                            <td>{{ $product->owner_email }}</td>
                                            <td>{{ $product->cashback }}</td>
                                            <td>{{ $product->owner }}</td>
                                            <td>
                                                <a class="dropdown-item" href="{{ route('delete-tmp-product', $product->id) }}"><i
                                                        class="bx bx-trash me-1"></i> </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach

                            </table>
                        </div>
                    </div>
                @else
                    <h1>Продукты отсутствуют</h1>
                @endif
            </div>
        </div>

    </div>

@endsection
