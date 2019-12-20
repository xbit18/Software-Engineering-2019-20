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

@endsection
