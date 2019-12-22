@extends ('layout')

@section ('content')

    <header>
        <div>
            <div id="logo-div">
                <img id="logo-univaq" src="images/logo.png">
            </div>
            <div id="form-div">
                <img onclick="manageNav()" id="logo-hamburger" src="images/hamburger.png">
            </div>
        </div>
    </header>

    <div id="mySidenav" class="sidenav">
        <a href="/about">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>

    <div>
        <ul class="aule">
            @foreach ($aule as $aula)
                <li>
                    <h3>{{ $aula->codice }}</h3>
                    <p>Capienza: {{ $aula->capienza }}</p>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
