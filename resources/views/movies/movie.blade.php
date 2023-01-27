@extends('layouts.default')

@section('content')

<div class="container">
<h1 class="mb-4">Film: {{$movie->title}}</h1>
<div class="table-responsive">
<table class="table table-striped">
  <tbody>
        <tr>
            <td>Tytuł</td>
            <td>{{$movie->title}}</td>
        </tr>
        <tr>
            <td>Opis</td>
            <td>{{$movie->description}}</td>
        </tr>
        <tr>
            <td>Minimalny wiek</td>
            <td>{{$movie->min_age}} lat</td>
        </tr>
        <tr>
            <td>Cena biletu normalnego</td>
            <td>{{$movie->price}} złotych</td>
        </tr>
        <tr>
            <td>Cena biletu ulgowego</td>
            <td>{{$movie->discounted_price}} złotych</td>
        </tr>   
  </tbody>
</table>
</div>
@if(Auth::check())
    @if(!count($screenings))
        <div class="alert alert-warning" role="alert">
            Brak senasów na wybrany film!
        </div>
    @else
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                @if(Session::has('save_error'))
                    <div class="alert alert-danger" role="alert">
                        Należy podać liczbę biletów normalnych lub ulgowych!
                    </div>
                @endif
                @if(Session::has('seats_error'))
                    <div class="alert alert-danger" role="alert">
                        Nie można zarezerwować więcej miejsc niż jest dostępne!
                    </div>
                @endif
                @if(Session::has('reservation_success'))
                    <div class="alert alert-success" role="alert">
                        Poprawnie zarezerwowano bilety!
                    </div>
                @endif
                <form method="post" action="/rezerwuj-bilety">
                    {{csrf_field()}}
                    <div class="col-md-12">
                        <select name="screening_id" class="form-select">
                            @foreach($screenings as $screening)
                                <option value="{{$screening->id}}">{{Carbon\Carbon::parse($screening->date)->format('Y-m-d H:i')}} - {{$screening->hall->name}} - Wolne miejsca: {{$screening->getFreeSeats()}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Liczba biletów normalnych</label>
                            <input type="number" min="1" name="normal_tickets" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Liczba biletów ulgowych</label>
                            <input type="number" min="1" name="concession_tickets" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-12 mt-3 mb-3">
                        <button type="submit" class="btn btn-primary">Rezerwuj</button>
                    </div>
                </form>
            </div>
        </div>
    @endif 
@else
    <div class="alert alert-warning" role="alert">
        Zaloguj się aby zarezerować bilet!
    </div>
@endif
</div>

@endsection