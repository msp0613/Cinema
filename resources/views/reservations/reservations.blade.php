@extends('layouts.default')

@section('content')

<div class="container">
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Tytuł</th>
      <th scope="col">Data rezerwacji</th>
      <th scope="col">Data seansu</th>
      <th scope="col">Bilety normalne</th>
      <th scope="col">Bilety ulgowe</th>
      <th scope="col">Łączna cena</th>
    </tr>
  </thead>
  <tbody>
    @foreach($reservations as $reservation)
        <tr>
            <td>{{$reservation->screening->movie->title}}</td>
            <td>{{$reservation->created_at}}</td>
            <td>{{$reservation->screening->date}}</td>
            <td>{{$reservation->normal_tickets}} ({{$reservation->screening->movie->price * $reservation->normal_tickets}} zł) </td>
            <td>{{$reservation->concession_tickets}} ({{$reservation->screening->movie->discounted_price * $reservation->concession_tickets}} zł) </td>
            <td>{{$reservation->screening->movie->price * $reservation->normal_tickets + $reservation->screening->movie->discounted_price * $reservation->concession_tickets}} zł </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>

@endsection