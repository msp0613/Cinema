@extends('layouts.default')

@section('content')

<div class="container">

<div class="card mb-5" style="width: 18rem;">
  <img style="width: 50px;" src="http://openweathermap.org/img/wn/{{$weather->weather[0]->icon}}.png" class="card-img-top" >
  <div class="card-body">
    <h5 class="card-title">Pogoda na dziś</h5>
    <p class="card-text">
      {{$weather->main->temp}} °C <br />
      {{$weather->weather[0]->description}}
    </p>
  </div>
</div>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Tytuł</th>
      <th scope="col">Opis</th>
      <th scope="col">Rezerwacja</th>
    </tr>
  </thead>
  <tbody>
    @foreach($movies as $movie)
        <tr>
            <td>{{$movie->title}}</td>
            <td>{{$movie->description}}</td>
            <td><a href="/film/{{$movie->id}}" class="btn btn-primary">Zarezerwuj</a> </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>

@endsection