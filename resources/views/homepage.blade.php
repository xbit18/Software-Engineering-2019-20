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

    <div class="title">
        <h2 style="margin: 0">Visualizza Aule Disponibili</h2>
    </div>
    <table class="tg">
        <tr>
            <th class="tg-p78r"><span style="font-weight:bold">Aula</span></th>
            <th class="tg-gwxw">Edificio</th>
            <th class="tg-gwxw">Capienza</th>
            <th class="tg-gwxw">Tipo</th>
        </tr>
        @foreach ($aule as $aula)
        <tr>
            <td class="tg-p78r">{{ $aula->codice }}</td>
            <td class="tg-p78r"></td>
            <td class="tg-p78r">{{ $aula->capienza }}</td>
            <td class="tg-p78r">{{ $aula->tipo }}</td>
        </tr>
        @endforeach
    </table>

@endsection
