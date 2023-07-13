@extends('layouts.app')
@section('content')
    @foreach($recipes as $recipe)
        <p>{{$recipe->name}}</p>
    @endforeach
@endsection
@section('scripts')
    
@endsection

