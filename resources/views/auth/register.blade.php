@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mb-4">Zarejestruj się</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="/rejestracja">
                {{csrf_field()}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Adres e-mail</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1"  class="form-label">Hasło</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1"  class="form-label">Powtórz hasło</label>
                    <input type="password" class="form-control" name="repeat_password" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Zarejestruj się</button>
            </form>
            <p class="mt-4">Jeśli masz już konto, <a href="#">zaloguj się się</a>
        </div>
    </div>
</div>

@endsection