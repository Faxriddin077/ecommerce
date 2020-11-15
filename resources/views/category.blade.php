@extends('layouts.master')

@section('title', 'Категория ' . $category->name)

@section('content')
        <h1>
            {{ $category->__('name') }} {{ $category->products->count() }}
        </h1>
        <p>
            {{ $category->__('description') }}
        </p>
        <div class="row">
            @foreach($category->products as $product)
                @include('layouts.card', compact('product', 'category'))
            @endforeach
        </div>
@endsection
