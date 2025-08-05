<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estoque</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-login {
      padding: 30px 0 0 0;
      width: 350px;
      margin: 0 auto;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="Logo">
        Estoque
      </a>
    </div>
  </nav>

  <main class="container">
    <div class="row">
      <div class="card-login">
        <div class="card">
          @yield('card-header')
          <div class="card-body">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
