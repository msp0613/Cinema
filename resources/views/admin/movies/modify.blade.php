@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            @if(Session::has('save_error'))
            <div class="alert alert-danger" role="alert">
                Wszystkie pola muszą być uzupełnione!
            </div>
            @endif
            <h1 class="mb-4">
                @if($movie)
                    Edytuj film
                @else
                    Dodaj film
                @endif
            </h1>
            <form method="post" action="/zapisz-film" class="mb-5">
                {{csrf_field()}}
                @if($movie)
                    <input type="hidden" name="movie_id" value={{$movie->id}} />
                @endif
                <div class="mb-3">
                    <label class="form-label">Tytuł</label>
                    <input type="text" name="title" value="@if(old('title')){{old('title')}}@elseif($movie){{$movie->title}}@endif" class="form-control">
                </div>
                <div class="mb-3">
                    <label  class="form-label">Opis</label>
                    <textarea name="description"  class="form-control">@if(old('description')){{old('description')}}@elseif($movie){{$movie->description}}@endif</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Minimalny wiek</label>
                    <input type="number" name="min_age" value="@if(old('min_age')){{old('min_age')}}@elseif($movie){{$movie->min_age}}@endif" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cena biletu normalnego</label>
                    <input type="number" name="price" value="@if(old('price')){{old('price')}}@elseif($movie){{$movie->price}}@endif" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cena biletu ulgowego</label>
                    <input type="number" name="discounted_price" value="@if(old('discounted_price')){{old('discounted_price')}}@elseif($movie){{$movie->discounted_price}}@endif" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Zapisz</button>
            </form>
        </div>
    </div>
</div>

@endsection