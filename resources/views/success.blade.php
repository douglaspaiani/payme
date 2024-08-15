<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payme - Painel</title>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
  </head>
  <body>
    <div id="home">
        <div class="container">
            <div class="panel pageSuccess">
                <a href="{{ route('home') }}" class="logo"><img height="50" src="{{ URL::asset('assets/images/payme.png') }}"></a>
                <div class="success"><i class="fa-solid fa-circle-check"></i> Sua transferência foi realizada com successo!</div>
                <a href="{{ route('home') }}" class="return"><i class="fa-solid fa-arrow-left"></i> Voltar para a página inicial</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('assets/js/scripts.js') }}"></script>
    <script src="https://kit.fontawesome.com/73683cdf67.js" crossorigin="anonymous"></script>
  </body>
</html>