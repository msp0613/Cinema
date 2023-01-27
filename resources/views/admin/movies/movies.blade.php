@extends('layouts.default')

@section('content')

<div class="container">
<a href="/dodaj-film" class="btn btn-primary mb-5">Dodaj film</a>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Tytuł</th>
      <th scope="col">Opis</th>
      <th scope="col">Seanse</th>
      <th scope="col">Edycja</th>
      <th scope="col">Usuwanie</th>
    </tr>
  </thead>
  <tbody>
    @foreach($movies as $movie)
        <tr>
            <td>{{$movie->title}}</td>
            <td>{{$movie->description}}</td>
            <td>
                <a href="/zarzadzanie-seansami/{{$movie->id}}" class="btn btn-primary">Seanse</a>
            </td>
            <td>
                <a href="/edytuj-film/{{$movie->id}}" class="btn btn-primary">Edytuj</a>
            </td>
            <td>
                <a href="/usun-film/{{$movie->id}}" class="btn btn-danger">Usuń</a>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>

@endsection