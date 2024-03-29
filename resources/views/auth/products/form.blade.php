@extends('layouts.auth.master')

@isset($category)
    @section('title', 'Редактировать товар ' . $category->name)
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($product)
            <h1>Редактировать товар <b>{{ $product->name }}</b></h1>
        @else
            <h1>Добавить товар</h1>
        @endisset
        <form method="post" enctype="multipart/form-data"
              @isset($product)
              action="{{ route('products.update', $product) }}"
              @else
              action="{{ route('products.store') }}"
            @endisset
        >
            @csrf
            <div>
                @isset($product)
                    @method('PUT')
                @endisset
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        <input type="text" name="code" class="form-control" id="code"
                               value="@isset($product){{ $product->code }}@endisset">
                        @include('layouts.auth.error', ['fieldName' => 'code'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" id="name"
                               value="@isset($product){{ $product->name }}@endisset">
                        @include('layouts.auth.error', ['fieldName' => 'name'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name_en" class="col-sm-2 col-form-label">Название (En): </label>
                    <div class="col-sm-6">
                        <input type="text" name="name_en" class="form-control" id="name_en"
                               value="@isset($product){{ $product->name_en }}@endisset">
                        @include('layouts.auth.error', ['fieldName' => 'name_en'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                    <div class="col-sm-6">
                        <select name="category_id" id="category_id" class="form-control">
                            @include('layouts.auth.error', ['fieldName' => 'category_id'])
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @isset($product)
                                        @if($product->category_id == $category->id)
                                        selected
                                    @endif
                                    @endisset
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        <textarea name="description" id="description" cols="72"
                                  rows="7">@isset($product){{ $product->description }}@endisset</textarea>
                        @include('layouts.auth.error', ['fieldName' => 'description'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description_en" class="col-sm-2 col-form-label">Описание (En): </label>
                    <div class="col-sm-6">
                        <textarea name="description_en" id="description_en" cols="72"
                                  rows="7">@isset($product){{ $product->description_en }}@endisset</textarea>
                        @include('layouts.auth.error', ['fieldName' => 'description_en'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label class="btn btn-default btn-file">
                            Загрузить <input type="file" style="display:none;" name="image" id="image">
                        </label>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                    <div class="col-sm-6">
                        <input type="text" name="price" class="form-control" id="price"
                               value="@isset($product){{ $product->price }}@endisset">
                        @include('layouts.auth.error', ['fieldName' => 'price'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="count" class="col-sm-2 col-form-label">Кол-во: </label>
                    <div class="col-sm-6">
                        <input type="text" name="count" class="form-control" id="count"
                               value="@isset($product){{ $product->count }}@endisset">
                        @include('layouts.auth.error', ['fieldName' => 'count'])
                    </div>
                </div>
                <br>
                @foreach([
                'hit' => 'Хит',
                'new' => 'Новинка',
                'recommend' => 'Рекомендуемые'
                ] as $field => $title)
                    <div class="ml-lg-5 w-25 h-50 form-check form-check-inline mr-md-5 mb-5">
                        <label for="{{ $field }}" class="form-check-label">{{ $title }} </label>
                        <input type="checkbox" name="{{ $field }}" class="form-check-input form-control"
                               id="{{ $field }}"
                               @if(isset($product) && $product->$field === 1)
                               checked="checked"
                            @endif
                        >
                    </div>
                @endforeach
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
