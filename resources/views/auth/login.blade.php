@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            @if(Session::has('register_success'))
                <div class="alert alert-success" role="alert">
                    Rejestracja zakończona powodzeniem! Zaloguj się aby rezerwować bilety!
                </div>
            @endif
            @if(Session::has('login_failed'))
            <div class="alert alert-danger" role="alert">
                Podany adres email lub hasło są niepoprawne!
            </div>
            @endif
            <h1 class="mb-4">Zaloguj się</h1>
            <form method="post" action="/logowanie">
                {{csrf_field()}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Adres e-mail</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Hasło</label>
                    <input type="password" name="password"  class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Zaloguj się</button>
            </form>
            <p class="mt-4">Jeśli nie masz konta, <a href="/rejestracja">zarejestruj się</a>
        </div>
    </div>
</div>

@endsection