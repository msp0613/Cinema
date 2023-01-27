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
                @if($screening)
                    Edytuj seans
                @else
                    Dodaj seans
                @endif
            </h1>
            <form method="post" action="/zapisz-seans" class="mb-5">
                {{csrf_field()}}
                @if($screening)
                    <input type="hidden" name="screening_id" value={{$screening->id}} />
                @endif
                <input type="hidden" name="film_id" value="{{$movie_id}}" />
                <div class="mb-3">
                    <label class="form-label">Sala</label>
                    <select name="hall_id" class="form-select" >
                        @foreach($halls as $hall)
                            <option value="{{$hall->id}}" @if(old('hall_id') == $hall->id) selected @elseif($screening && $screening->hall_id == $hall->id) selected @endif>{{$hall->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Data i godzina</label>
                    <input type="datetime-local" name="date" value="@if(old('date')){{old('date')}}@elseif($screening){{Carbon\Carbon::parse($screening->date)->toIso8601String()}}@endif" class="form-control">
                </div>
            

                <button type="submit" class="btn btn-primary">Zapisz</button>
            </form>
        </div>
    </div>
</div>

@endsection