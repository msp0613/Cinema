<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
        Kino
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="/">Strona główna</a>
        </li>
        
        @if(Auth::check())
          <li class="nav-item">
            <a class="nav-link" href="/moje-rezerwacje">Moje rezerwacje</a>
          </li>
          @if(Auth::user()->role->role_id == 2)
            <li class="nav-item">
              <a class="nav-link" href="/zarzadzanie-filmami">Zarządzaj filmami</a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="/wylogowanie">Wyloguj się</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="/logowanie">Zaloguj się</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>