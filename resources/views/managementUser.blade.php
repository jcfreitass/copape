
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Font Google-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

     <!-- Style Validação Plano -->
     <link rel="stylesheet" type="text/css" href="css/style.css" />
     <link rel="stylesheet" type="text/css" href="css/perfil.css" />

     <!--awesome-->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <title>Plano de ensino</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- Favicon-->
    <link rel="shortcut icon" href="/Imagens/brasaoUfsc.png">

    <link rel="stylesheet" type="text/css" href="css/tabby-ui.css">

  </head>
  <body style="background:#4c7aa9;">

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
                                  @inject('planoController', 'App\Http\Controllers\planoController')

                                  @if( ( $planoController->get_user_checkAluno() ) == 1)  
                                  
                                    <a class="dropdown-item" href="{{ url('/handle_plan_student') }}">Planos e Materiais
                                      @if( ( $planoController->planoRecusado() ) == 1)
                                        <h5 class='fa fa-exclamation' style="color:red;margin-top:5%;"></h5>
                                      @endif
                                    </a>
                                      
                                    <a class="dropdown-item" href="{{ url('/perfil_aluno ') }}">Perfil
                                        @if( ( $planoController->refusedCourse()  ) == 1)
                                          <h5 class='fa fa-exclamation' style="color:red;margin-top:5%;"></h5>
                                        @endif
                                    </a>
                                      
                                  @endif

                                  @if(  Auth::User()->id== 1) 
                                    <a class="dropdown-item" href="{{ url('/create_plano') }}">Adicionar Plano</a>
                                    <a class="dropdown-item" href="{{ url('/managementUser') }}">Gerenciar Usuário</a>
                                    
                                  @endif

                                  @if( ( $planoController->get_user_checkProfessor() ) == 1) 
                                    <a class="dropdown-item" href="{{ url('/handle_plan_teacher') }}">Planos e Materiais</a>
                                    <a class="dropdown-item" href="{{ url('/perfil_professor') }}">Perfil</a>
                                    <a class="dropdown-item" href="{{ url('/auth_user') }}">Validar Usuário</a>
                                  @endif
                                  
                                  

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
    
    <!-- Header-->

    <section class="tituloPlanodeEnsino">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center marginHeaderManagement">
            <h1 style="color: #14395f">Gerenciamento de Usuário</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- End header-->


    <!-- End-->
    <section class="management">
      <div class="container">
          <div class="row styleSearchManagement">
                <div class=" col-md-4 marginNameSearcManagement">
                  <h4 style="color: #f3f3f3;"> Pesquise um Usuário</h4>
                </div>
                <div class="col-md-4 marginSearchManagement">
                  <form action="/search_user" method="get" class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Palavra chave" aria-label="Search" name="search">
                    <button class="btn btn-outline-light my-2 my-sm-0 " type="submit">Pesquisar</button>
                  </form>
                </div>
          </div>
          <div class="row">
          <table class="table table-striped boddyTableManagement">
                    <thead>
                      <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Matricula</th>
                        <th scope="col">Tipo</th>
                      </tr>
                    </thead>
                    <tbody >
                      @foreach($userSearch as $userSearch)   
                        @php
                          if($userSearch->checkProfessor === 1 ){
                              $type = 'Professor';
                          }elseif($userSearch->checkAluno === 1){
                              $type = 'Aluno';
                            }
                        @endphp                
                      <tr>
                        <td>{{ $userSearch->name }}</td>
                        <td>{{ $userSearch->email }}</td>
                        <td>{{ $userSearch->telefone }}</td>
                        <td>{{ $userSearch->registration }}</td>
                        <td>{{ $type }}</td>
                        <td>
                          <form action ="{{ url('/delete_user', $userSearch->id ) }}" method = "post">
                  
                              {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="SUBMIT" value="Deletar" class="btn btn-danger">
                          </form>
                        </td>
                      </tr>
                      @endforeach 
                    </tbody>
                  </table>
                </div>
            
          </div>
      </div>
    </section>
    <!-- end table-->
   
    <!-- Footer-->
    <section  class="footer" style="margin-top: 4%" >
      <div class="container">
        <div class ="row">
          <div class="col-md-6 marginDetalhesFooter">
            <ul style="list-style-type: none;" >
              <li> Universidade Federal de Santa Catarina - UFSC Campus Araranguá</li>
              <li> Jardim das Avenidas - CEP 88.906-072 - Araranguá - Santa Catarina  </li>
            </ul>
          </div>
          <div class="col-md-6">
            <div class="row marginSocial">
              <div class=" col-3  col-md-2 marginInstagram">
                  <a href="#">
                    <img src="imagens/instagram.png" alt="Responsive image" width="34" style="margin: 0">
                  </a>
              </div>
              <div class=" col-3 col-md-2 marginYotube">
                  <a href="#">
                    <img src="imagens/youtube.png" alt="Responsive image" width="45" style="margin: 0">
                  </a>
              </div>
              <div class=" col-3  col-md-2">
                  <a href="#">
                    <img src="imagens/facebook.png" alt="Responsive image" width="35" style="margin: 0">
                  </a>
              </div>
            </div>
        </div>
      </div>
    </section>
    <!-- End footer-->

    <!-- Optional JavaScript -->

    <script src="js/tabby.js"></script>
    <script>
      var tabs = new Tabby('[data-tabs]');
    </script>
    <!-- JS COPE-->
    <script type="text/javascript" src="js/COPE.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
  </body>
</html>