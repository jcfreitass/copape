<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts 
    <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
    <!-- Font Google-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Style Validação Plano -->
    <link rel="stylesheet" type="text/css" href="../css/style.css" />

    <!-- mask -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script type="text/javascript">
                            $(document).ready(function(){
                                $(".telefone").mask("(00) 0-0000-0000");
                                $(".cpf").mask("000.000.000-00");
                                $(".registration").mask("00000000");
                            });
    </script>	
    
</head>
<body style="background-image: linear-gradient(to bottom right, #c7d9ec, #e1e5ea);">
    <div id="app">
        <!-- Menu-->
      <section>
          <nav class="navbar navbar-expand-lg navbar-light navColor">
              <div class="container">
              <a class="navbar-brand" href="#" >  <img src="../../Imagens/brasaoUfsc.png" width="70" class="d-inline-block align-top" alt=""> <a href="#" class="brandFont">UFSC<a></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse  justify-content-end" id="navbarNavAltMarkup">
                  
                  <ul class="navbar-nav">

                      <a class="nav-item nav-link navItemColor" href="{{ url('/') }}">Início</a>
                      
                      @inject('planoController', 'App\Http\Controllers\planoController')

                      @if( ( $planoController->get_user_checkAluno() ) == 1)  
                      <a class="nav-item nav-link navItemColor" href="{{ url('/perfil_aluno') }}">Perfil
                        @if( ( $planoController->planoRecusado() ) == 1)
                          <a class='fa fa-exclamation' style="color:red; margin-left:2%"></a>
                        @endif
                      </a>
                      @endif

                      @if( ( $planoController->get_user_checkProfessor() ) == 1) 
                        <a class="nav-item nav-link navItemColor" href="{{ url('/perfil_professor') }}">Perfil</a>
                      @endif

                      <!-- Authentication Links -->
                      @guest
                          <li class="nav-item">
                              <a class="nav-link navItemColor" href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                          <li class="nav-item">
                              @if (Route::has('register'))
                                  <a class="nav-link navItemColor" href="{{ route('register') }}">{{ __('Cadastro') }}</a>
                              @endif
                          </li>
                      @else
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle navItemColor" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                      {{ __('Sair') }}
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                  </form>
                              </div>
                          </li>
                      @endguest
                    </ul>
                  </div> 
                </div>
            </div>
          </nav>
        </section>
      <!-- End Menu-->

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Footer-->
    <section  class="footer" style="margin-top: 0px" >
      <div class="container">
        <div class ="row">
          <div class="col-md-6">
            <ul style="list-style-type: none;" >
              <li> Universidade Federal de Santa Catarina - UFSC Campus Araranguá</li>
              <li> Jardim das Avenidas - CEP 88.906-072 - Araranguá - Santa Catarina  </li>
            </ul>
          </div>
          <div class="col-md-6">
            <div class="row marginSocial">
              <div class=" col-3  col-md-2 marginInstagram">
                  <a href="#">
                    <img src="../../imagens/instagram.png" alt="Responsive image" width="34" style="margin: 0">
                  </a>
              </div>
              <div class=" col-3 col-md-2 marginYotube">
                  <a href="#">
                    <img src="../../imagens/youtube.png" alt="Responsive image" width="45" style="margin: 0">
                  </a>
              </div>
              <div class=" col-3  col-md-2">
                  <a href="#">
                    <img src="../imagens/facebook.png" alt="Responsive image" width="35" style="margin: 0">
                  </a>
              </div>
            </div>
        </div>
      </div>
    </section>
    <!-- End footer-->
    
    <!-- JS COPE-->
    <script type="text/javascript" src="js/COPE.js"></script> 
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
