@extends('layouts.auth.master')

@isset($category)
    @section('title', 'Редактировать категорию ' . $category->name)
@else
    @section('title', 'Создать категорию')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($category)
            <h1>Редактировать категорию <b>{{ $category->name }}</b></h1>
        @else
            <h1>Добавить категорию</h1>
        @endisset
        <form method="post" enctype="multipart/form-data"
              @isset($category)
              action="{{ route('categories.update', $category) }}"
              @else
              action="{{ route('categories.store') }}"
            @endisset
        >
            @csrf
            <div>
                @isset($category)
                    @method('PUT')
                @endisset
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        <input type="text" name="code" class="form-control" id="code"
                               value="{{ old('code', isset($category) ? $category->code : null) }}">
                        @include('layouts.auth.error', ['fieldName' => 'code'])
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" id="name"
                               value="{{ old('name', isset($category) ? $category->name : null) }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name_en" class="col-sm-2 col-form-label">Название (En): </label>
                    <div class="col-sm-6">
                        <input type="text" name="name_en" class="form-control" id="name_en"
                               value="{{ old('name_en', isset($category) ? $category->name_en : null) }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        <textarea name="description" id="description" cols="72"
                                  rows="7">{{ old('description', isset($category) ? $category->description : null) }}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description_en" class="col-sm-2 col-form-label">Описание (En): </label>
                    <div class="col-sm-6">
                        <textarea name="description_en" id="description_en" cols="72"
                                  rows="7">{{ old('description_en', isset($category) ? $category->description_en : null) }}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
