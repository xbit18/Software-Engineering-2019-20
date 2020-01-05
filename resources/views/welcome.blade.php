@extends ('layout')

@section ('content')
    <header>
        <div>
            <div id="logo-div">
                <img id="logo-univaq" src="images/logo.png">
            </div>
            <div id="form-div">
                <form method="POST" action="/login">
                    @csrf
                    <input class="input" type="text" name="email" id="email" placeholder="email" required>
                    <input class="input" type="password" name="passwd" id="passwd" placeholder="password" required>
                    <button class="button" type="submit">LOGIN</button>
                </form>
            </div>
        </div>
    </header>
@endsection
