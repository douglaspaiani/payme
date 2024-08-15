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
            <div class="panel">
                <a href="{{ route('home') }}" class="logo"><img height="50" src="{{ URL::asset('assets/images/payme.png') }}"></a>
                <div class="saldo">
                    <span class="text">Saldo disponível</span>
                    <span class="moeda">R$</span>
                    <span class="valor">{{$user['saldo']}}</span>
                </div>
                <h3>Efetuar nova transferência</h3>
                @if(isset($error))
                    <div class="error" style="margin-bottom: 10px">{{$error}}</div>
                    @endif
                @if ($user['transfer'] != true)
                <div class="accountTransfer">
                    <form class="form" method="GET">
                        <input type="text" name="payee" placeholder="Insira o CPF/CNPJ ou e-mail de destino" required>
                        <button type="submit" style="margin-top: 10px">Prosseguir <i class="fa-solid fa-arrow-right"></i></button>
                    </form>
                </div>
                @endif
                @if ($user['transfer'] == true)
                <div class="valueTransfer">
                    <div class="boxAccount">
                        <h5>Você está transferindo para:</h5>
                        <span><b>Nome: </b>{{$payee['nome']}}</span>
                        <span><b>E-mail: </b>{{$payee['email']}}</span>
                        <span><b>CPF/CNPJ: </b>{{$payee['cpf'] ?? $payee['cnpj']}}</span>
                    </div>
                    <h6>Quanto você deseja transferir?</h6>
                    <div class="row value">
                    <form method="POST">
                    @csrf
                        <div class="col-md-1"><span>R$</span></div>
                        <div class="col-md-11">
                                <input type="hidden" name="payee" value="{{$payee['id']}}" required>
                                <input type="text" class="money" name="value" placeholder="0,00" required>
                        </div>
                        <div class="col-md-12"><button class="btnTransfer" type="submit" style="margin-top: 10px">Transferir <i class="fa-solid fa-arrow-right"></i></button></div>
                    </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('assets/js/scripts.js') }}"></script>
    <script src="https://kit.fontawesome.com/73683cdf67.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  </body>
</html>