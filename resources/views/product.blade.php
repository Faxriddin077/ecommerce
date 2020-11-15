@extends('layouts.master')

@section('title', 'Товар')

@section('content')
        <h1>{{ $product->__('name') }}</h1>
        <h2>{{$product->category->name}}</h2>
        <p>Price: <b>{{ $product->price }} $</b></p>
        <img src="{{ Storage::url($product->image) }}">
        <p>{{ $product->__('description') }}</p>
        @if($product->isAvailable())
        <form action="{{ route('basket-add', $product) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
        </form>
        @else
            <span>Недоступен</span>
            <br>
            <span>Tovar bolsa, xabar qiling!</span>
            <div class="warning">
                @if($errors->get('email'))
                    {{ $errors->get('email')[0] }}
                @endif
            </div>
            <form method="POST" action="{{ route('subscription', $product) }}">
                @csrf
                <input type="text" name="email">
                <button type="submit">Otpravit</button>
            </form>
        @endif
@endsection
