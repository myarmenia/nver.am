@extends('layouts/contentNavbarLayout')

@section('title', 'welcome')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title" style="text-align: center">Welcome to Our Site  {{auth()->user()->name}} </h2>
        <p class="card-text" style="text-align: center">
          Thank you for choosing our compony
        </p>
      </div>
  </div>
@endsection