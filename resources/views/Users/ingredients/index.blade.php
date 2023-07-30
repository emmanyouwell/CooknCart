@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="">
@endsection

@section('scriptHead')
    <script></script>
@endsection

@section('content')
    <div class="container">
        <div class="d-flex align-items-center flex-column m-3">
            <h4>Ingredients</h4>
            <h2><strong>Fresh, Affordable,</strong><span class="orange"> And High Quality Ingredients</span></h2>
        </div>
        @foreach ($ingredients as $ingredient)
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/'.$ingredient->image) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $ingredient->name }}</h5>
                <p class="card-text">{{ $ingredient->description }}</p>
                <a href="#" class="btn btn-primary">Add to cart</a>
            </div>
        </div>
    @endforeach
    </div>
@endsection

@section('scriptFoot')
    <script></script>
@endsection
