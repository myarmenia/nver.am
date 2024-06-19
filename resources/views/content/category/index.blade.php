@extends('layouts/contentNavbarLayout')

@section('title', 'categories')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                @include('includes.alert')
                <h5 class="card-title text-primary">Category</h5>
                <div>
                    <div class="mb-3">
                        <form action="{{route('add-new-category')}}" method="POST">
                            <label class="form-label" for="basic-default-message">Add category</label>
                            <input id="basic-default-message" class="form-control" name='category' placeholder="Hi, please add category name"/>
                            <button type="submit" class="btn btn-primary mt-2">Send</button>
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
