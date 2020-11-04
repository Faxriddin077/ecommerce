@extends('layouts.auth.master')

@section('title', 'Категории')

@section('content')
    <div class="col-md-12">
        <h1>Категории</h1>
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
                    Действия
                </th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div role="group" class="btn-group">

                        </div>
                        <div role="group" class="btn-group">

                        </div>
                        <div role="group" class="btn-group">
                            <form action="{{ route('categories.destroy', $category) }}" method="post">
                                <a type="button" href="{{ route('categories.show', $category) }}"
                                   class="btn btn-success">Открыть</a>
                                <a type="button" href="{{ route('categories.edit', $category) }}"
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
        {{ $categories->links() }}
        <a class="btn btn-success" type="button" href="{{ route('categories.create') }}">
            Добавить категорию
        </a>
    </div>
@endsection
