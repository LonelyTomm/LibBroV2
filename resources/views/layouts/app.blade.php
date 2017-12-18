<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>LibBro - Powerful and Easy-to-Use Library Management System</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Josefin+Sans');
    </style>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #6ffccf">
      <a class="navbar-brand logoBrand text-white" href="/index">LibBro</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/index">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Add</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Borrow Log</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @auth
              {{Auth::user()->login}}
              @else
              User
              @endauth
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              @auth
              <a class="dropdown-item" href="/logout">Logout</a>
              @if(Auth::user()->type=='M')
              <a class="dropdown-item" href="/register">Register New Student</a>
              @endif
              @else
              <a class="dropdown-item" href="/login">Sign In</a>
              @endauth
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="POST" action="/find">
          {{ csrf_field() }}
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchQuery" required>
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    @yield('content')

    <!-- footer starts-->
    <footer class="fixed-bottom footinfo">
        <p>@LibBro all rights reserved!</p>
    </footer>
    <!-- footer ends-->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
