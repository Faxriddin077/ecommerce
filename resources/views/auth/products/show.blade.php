@extends('layouts.auth.master')

@section('title', 'Категория ' . $product->name)

@section('content')
    <div class="col-md-12">
        <h1>Категория <b>{{ $product->category->name }}</b></h1>
        <table class="table">
            <tbody>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>Картинка</td>
                <td><img src="{{ Storage::url($product->image) }}" alt="" height="240px"></td>
            </tr>
            <tr>
                <td>Кол-во товаров</td>
                <td>{{ $product->category->count() }}</td>
            </tr>
            <tr>
                <td>Лейблы</td>
                <td>
                    @if($product->isNew())
                        <span class="badge badge-success">Новинка</span>
                    @endif
                    @if($product->isRecommend())
                        <span class="badge badge-warning">Рекомендуемые</span>
                    @endif
                    @if($product->isHit())
                        <span class="badge badge-danger">Хит продаж!</span>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
