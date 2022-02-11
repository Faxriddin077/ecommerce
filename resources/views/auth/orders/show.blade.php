@extends('layouts.auth.master')

@section('title', 'Заказ ' . $order->id)

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="justify-content-center">
                <div class="panel">
                    <h1>Заказы №{{ $order->id}}</h1>
                    <p>Заказчик: <b>{{ $order->name }}</b></p>
                    <p>Номер телефона: <b>{{ $order->phone }}</b></p>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Кол-во</th>
                            <th>Цена</th>
                            <th>Стоимость</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                                        <img height="56px" src="{{ Storage::url($product->image) }}" alt="">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                @dd($order->products()->where('product_id', $product->id))
                                <td><span class="badge">{{ $order->products() }}</span></td>
                                <td>{{ $product->price }} {{ $order->currency->symbol }}</td>
                                <td>{{ $product->getPriceForCount() }} {{ $order->currency->symbol }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Общая стоимость:</td>
                            <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
