<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Suhen @yield('judul')</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('template') }}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/dist/css/adminlte.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item ml-3">
          @yield('nama_menu')
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #5ec3ea;">
      <div>
        <a href="/" class="brand-link">
          <img src="/logo_baby.jpg" alt="Logo" class="img-circle elevation-3" style="opacity: .8; width: 60px; height: 60px;">
          <span class="brand-text font-weight-bold m-4 h3">Toko Susu</span>
        </a>
      </div>
      <div class="sidebar">
        @include('0_Layout.navbar')
      </div>
    </aside>
    <div class="content-wrapper">
      <section class="content mr-3 ml-3">
        @yield('content')
      </section>
    </div>
    @yield('scripts')
  </div>
  <script src="{{ asset('template') }}/plugins/jquery/jquery.min.js"></script>
  <script src="{{ asset('template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('template') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
