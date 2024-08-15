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
                    <span class="valor">{{$saldo}}</span>
                </div>
                <h3>Extrato</h3>
                <div class="extract">
                    <ul>
                        @foreach($extract as $ext)
                        @if($ext['payee'] == $_SESSION['id'])
                        <li class="entry"><b>R$ {{number_format($ext['value'], 2, ',', '.')}}</b> de {{\App\Models\Users::AccountName($ext['payer'])}} em {{ \Carbon\Carbon::parse($ext['created_at'])->format('d/m/Y - H:i')}}</li>
                        @else
                        <li class="exit"><b>R$ {{number_format($ext['value'], 2, ',', '.')}}</b> para {{\App\Models\Users::AccountName($ext['payee'])}} em {{ \Carbon\Carbon::parse($ext['created_at'])->format('d/m/Y - H:i')}} <a href="{{route('revert', ['id'=>$ext['id'], 'status' => 'confirm'])}}"><i class="revert fa-solid fa-arrows-rotate"></i></a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
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