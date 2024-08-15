<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payme - Entrar</title>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
  </head>
  <body>
    <div id="login">
        <div class="container">
            <div class="logo">
                <img src="{{ URL::asset('assets/images/payme.png') }}">
            </div>

            <h1 class="text-center">Acesse sua conta</h1>
        <form class="form" method="POST">
            @if (isset($_GET['return']) && $_GET['return'] == 'error')
            <div class="error">E-mail ou senha incorreta, tente novamente.</div>
            @endif
            @csrf
            <div class="input">
                <input type="email" name="email" placeholder="Insira seu e-mail" value="" required>
            </div>
            <div class="input">
                <input type="password" name="senha" placeholder="Insira sua senha" value="" required>
            </div>
            <div class="input">
                <button type="submit">Entrar</button>
            </div>
        </form>
        <h2>Ou</h2>
        <a href="/register" class="btnLink">Cadastre-se grátis!</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('assets/js/scripts.js') }}"></script>
  </body>
</html>