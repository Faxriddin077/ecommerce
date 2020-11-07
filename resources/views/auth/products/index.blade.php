@extends('layouts.auth.master')

@section('title', 'Товары')

@section('content')
    <div class="col-md-12">
        <h1>Товары</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Код
                </th>
                <th>
                    Название
                </th>
                <th>
                    Категория
                </th>
                <th>
                    Цена
                </th>
                <th>
                    Кол-во
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->count }}</td>
                    <td>
                        <div role="group" class="btn-group">

                        </div>
                        <div role="group" class="btn-group">

                        </div>
                        <div role="group" class="btn-group">
                            <form action="{{ route('products.destroy', $product) }}" method="post">
                                <a type="button" href="{{ route('products.show', $product) }}"
                                   class="btn btn-success">Открыть</a>
                                <a type="button" href="{{ route('products.edit', $product) }}"
                                   class="btn btn-warning">Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Удалить" class="btn btn-danger">
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
        <a class="btn btn-success" type="button" href="{{ route('products.create') }}">
            Добавить товар
        </a>
    </div>
@endsection
