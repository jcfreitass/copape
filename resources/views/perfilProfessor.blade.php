
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
     <link rel="stylesheet" type="text/css" href="../../css/style.css" />
     <link rel="stylesheet" type="text/css" href="../../css/perfil.css" />

     <!--awesome-->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <title>Plano de ensino</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- Favicon-->
    <link rel="shortcut icon" href="../../Imagens/brasaoUfsc.png">
  </head>
  <body>

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
          <div class="col-md-6 text-center marginHeader">
            <h1 style="color: #14395f">Perfil Professor</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- End header-->

    <!-- Body Perfil Aluno -->
    <section style="background:#4c7aa9">
      <div class="container">
        <div class="row">
          <div class="col-md-1 marginPhotoDetalhes">
            <img src="../../imagens/professor.png" alt="Responsive image" width="100" style="margin: 0">
          </div>
          <div class="col-md-6 marginDetalhes">
            <ul style="list-style-type: none;">
              @foreach($user as $user)
                <li class="colorDetalhesPessoa"><a>Nome : </a><a>{{ $user->name }}</a></li>
                <li class="colorDetalhesPessoa"><a>Email : </a><a>{{ $user->email }}</a></li>
                <li class="colorDetalhesPessoa"><a>Matricula : </a><a>{{ $user->registration }}</a></li>
                <li class="colorDetalhesPessoa"><a>Telefone : </a><a>{{ $user->telefone }}</a></li>
                <li class="colorDetalhesPessoa"><a>CPF : </a><a>{{ $user->cpf }}</a></li>
            </ul>
          </div>
        </div>
        @endforeach
        @if( ( $planoController->refusedCourse() ) == 1) 
        <div class="card text-center cardPlanoRecusado" >
            <div class="card-body">
              <h5 class="card-title">Atenção Curso Recusado</h5>
              <h6 class="card-subtitle mb-2 text-muted">Atualize seu perfil e peça novamente os seguintes Cursos. </h6>
              <div class="table-responsive " style="margin-top:24px;">  
                <table class="table" style="background: #ffffff">
                  <tbody >


                    @foreach($refusedCourse as $refusedCourse)   
                      @php
                        $nameCurse = DB::table('courses')
                              ->where('id',$refusedCourse->course_id )
                              ->value('name');
                              
                            $refusedCourse->course_id = $nameCurse;
                      @endphp              
                      <tr>
                        <td> {{ $refusedCourse->course_id }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @endif
        <div class="row" style="margin-top:4%;">
          <div class ="col-md-3 buttonUpdate">
            <a class="btn btn-outline-light" style="padding: .375rem 1.75rem;" href="{{ url('/update_user') }}" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Atualizar <i class="fas fa-sync-alt" style="margin-left:2%; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> </a>
          </div>
          <div class ="col-md-3">
            <a class="btn btn-outline-light" href="{{ url('/changePassword') }}" >   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Alterar Senha <i class="fas fa-unlock-alt" style="margin-left:2.5%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> </a>
          </div>
        </div>
        <div class ="row" style="margin-top:2%;">
          <div class ="col-md-3 buttonUpdate">
              <a class="btn btn-outline-light " href="{{ url('/choose_type_update') }}" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Alterar Modo <i class="fas fa-user-friends" style="margin-left:2%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> </a>
          </div>
          <div class ="col-md-3" style="margin-bottom:4%">
              <a class="btn btn-outline-light " href="{{ url('/choose_course') }}" > Adicionar e Remover Cursos <i class="fas fa-user-friends" style="margin-left:2%;"></i> </a>
          </div>
        </div>
      </div>
    </section>
    <!-- End-->
   
    <!-- Footer-->
    <section  class="footer" style="margin-top: 0px" >
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
                    <img src="../../imagens/facebook.png" alt="Responsive image" width="35" style="margin: 0">
                  </a>
              </div>
            </div>
        </div>
      </div>
    </section>
    <!-- End footer-->

    <!-- Optional JavaScript -->
    <!-- JS COPE-->
    <script type="text/javascript" src="js/COPE.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
  </body>
</html>