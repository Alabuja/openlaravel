<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta id="token" name="token" value="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="A repository of open source Laravel projects.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
  
  <title>Open Laravel</title>

  {{-- <link rel="shortcut icon" href="images/favicon.png"> --}}

  <script src="https://use.fontawesome.com/bd782fff25.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <header class="header">
    <div class="logo">
      <a class="" href="/">
        <img src="{{ asset('images/logo.png') }}" height="100px">
      </a>
    </div>
  </header>

  <section class="hero is-primary is-bold">
    <div class="hero-body has-text-centered">
      <div class="container">
        <h2 class="subtitle">
          A repository of open source projects built using Laravel
        </h2>

        <a class="button is-secondary is-medium" href="{{ url('submit-project') }}">
          Submit Project
        </a>
      </div>
    </div>
  </section>

  <main id="project" class="section">
    <div class="container">

      @yield('content')

    </div>
  </main>

  <footer class="footer">
    <div class="container">
      <div class="content has-text-centered">
        <p>
          <a href="https://github.com/ammezie/openlaravel">
            <i class="fa fa-github"></i>
          </a>
          <a href="https://twitter.com/openlaravel">
            <i class="fa fa-twitter"></i>
          </a>
        </p>
        <p>
          <a href="https://github.com/ammezie/openlaravel">OpenLaravel</a> itself is an open source project built using <a href="https://laravel.com">Laravel</a>. Pull requests are greatly welcomed!
        </p>
        <p>
          Proudly hosted with <a href="https://m.do.co/c/98e35d32e849">DigitalOcean</a>.
        </p>
      </div>
      
    </div>
  </footer>
  
  {{-- <script src="{{ asset('js/vendor.js') }}"></script> --}}
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
