@extends('layouts.default')

@section('content')

<div class="container">
<a href="/dodaj-seans/{{Request::segment(2)}}" class="btn btn-primary mb-5">Dodaj seans</a>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Film</th>
      <th scope="col">Data</th>
      <th scope="col">Sala</th>
      <th scope="col">Ilość miejsc</th>
      <th scope="col">Ilość wolnych miejsc</th>
      <th scope="col">Edycja</th>
      <th scope="col">Usuwanie</th>
    </tr>
  </thead>
  <tbody>
    @foreach($screenings as $screening)
        <tr>
            <td>{{$screening->movie->title}}</td>
            <td>{{$screening->date}}</td>
            <td>{{$screening->hall->name}}</td>
            <td>{{$screening->hall->seats}}</td>
            <td>{{$screening->getFreeSeats()}}</td>
            <td>
                <a href="/edytuj-seans/{{Request::segment(2)}}/{{$screening->id}}" class="btn btn-primary">Edytuj</a>
            </td>
            <td>
                <a href="/usun-seans/{{$screening->id}}" class="btn btn-danger">Usuń</a>
            </td>
           
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>

@endsection