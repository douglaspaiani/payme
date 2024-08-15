<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payme - Crie sua conta</title>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
  </head>
  <body>
    <div id="login">
        <div class="container">
            <div class="logo">
                <a href="/login"><img src="{{ URL::asset('assets/images/payme.png') }}"></a>
            </div>
            <h1 class="text-center">Crie sua conta</h1>
        <form class="form" method="POST">
            @csrf
            <div class="input">
                <label>Tipo de conta</label>
                <select id="tipo" name="tipo">
                    <option value="0">Pessoa física</option>
                    <option value="1">Pessoa jurídica</option>
                </select>
            </div>
            <div class="input">
                <input type="text" name="nome" placeholder="Nome completo" value="" required>
            </div>
            <div class="input" id="cpf">
                <input type="text" name="cpf" placeholder="CPF" value="">
            </div>
            <div class="input" id="cnpj" style="display: none">
                <input type="text" name="cnpj" placeholder="CNPJ" value="">
            </div>
            <div class="input">
                <input type="email" name="email" placeholder="Insira seu e-mail" value="" required>
            </div>
            <div class="input">
                <input type="password" name="senha" placeholder="Crie uma senha" value="" required>
            </div>
            <div class="input">
                <button type="submit">Criar minha conta</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('assets/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  </body>
</html>