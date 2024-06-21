@extends('layouts/contentNavbarLayout')

@section('title', 'Категории')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                @include('includes.alert')
                <h5 class="card-title text-primary">Категории</h5>
                <div>
                    <div class="mb-3">
                        <form action="{{route('add-new-category')}}" method="POST">
                            <label class="form-label" for="basic-default-message">Добавить новую категорию</label>
                            <input id="basic-default-message" class="form-control" name='category' placeholder="пожалуйста, введите название категории"/>
                            <button type="submit" class="btn btn-primary mt-2">Отправить</button>
                        </form>
                    </div>
                    <div>
                        @foreach ($data as $type)
                            <div class="btn btn-secondary m-1">
                                <span class="tf-icons bx bx-bell me-1"></span>{{ $type->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
