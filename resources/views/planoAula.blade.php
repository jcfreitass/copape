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
    <link rel="stylesheet" type="text/css" href="../../css/planoEnsino.css" />

    <!-- Favicon-->
    <link rel="shortcut icon" href="../../Imagens/brasaoUfsc.png">
    
    <title>Plano de Ensino</title>
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

    <section  class="tituloPlanodeEnsino">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center marginHeader">
            @foreach($planosAlocados as $planosAlocados) 
            @if( $planosAlocados->typePlan === 0)  
              <h1 style="color: #14395f">Plano de Aula</h1>
            @else
              <h1 style="color: #14395f">Plano de Ensino</h1>
            @endif
          </div>
        </div>
      </div>
    </section>

    <!-- End header-->

    <!-- Boody Plano de ensino-->
    <section class="planoEnsino">
      <div class="container">
        <div class="row">
          <div class="col-md-8 detalhesPlano">      
            <ul class="ul" style="list-style-type: none;">
                <li> <a class="tituloDetalhes">Titulo :  </a> {{ $planosAlocados->title }}</li>
                <li> <a class="tituloDetalhes">Autor :  </a> {{ $planosAlocados->autor }}</li>
                @php
                  $nameCurse = DB::table('courses')->where('id',$planosAlocados->curso )->value('name');
                @endphp
                <li> <a class="tituloDetalhes">Curso :  </a> {{ $nameCurse }}</li>
                <li> <a class="tituloDetalhes">Disciplina :  </a> {{ $planosAlocados->disciplina }}</li>
                <li> <a class="tituloDetalhes">Semestre/Ano :  </a> {{ $planosAlocados->semestreAno }}</li>
                <li> <a class="tituloDetalhes">Nivel de Ensino :  </a> {{ $planosAlocados->nivelEnsino }}</li>
                <li> <a class="tituloDetalhes">Área de ensino :  </a> {{ $planosAlocados->knowArea }}</li>
                <li> <a class="tituloDetalhes">Resumo :  </a> {{ $planosAlocados->planDescription }}</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5 marginVersaoAtual">
            @if( $planosAlocados->typePlan === 0)  
              <h5 style="color: #f3f3f3">Plano de aula</h5>
            @else
            <h5 style="color: #f3f3f3">Plano de ensino</h5>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-7 marginVersaoAtual">
            <div class="table-responsive tableScroll">
              <table class="table table-striped " style="background: #f3f3f3">
                  <thead>
                      <tr>
                        <th scope="col">nome</th>
                        <th scope="col">Data</th>
                      </tr>
                  </thead>
                  <tbody >
                    <tr>
                      <th scope="row">{{ $planosAlocados->namePlan}}</th>
                      <td>{{ $planosAlocados->datas }}</td>
                      <td>
                        <a  class="btn btn-primary" href="{{ route('downloadFile', $planosAlocados->id) }}">
                          download
                        </a>
                      </td> 
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          @if( $planosAlocados->nameMaterialExtra !== null)          
          <div class="row" style="margin-top: 3%;">
            <div class="col-md-5 marginVersaoAtual">
              <h5 style="color: #f3f3f3">Materiais extras</h5>
            </div>
          </div>
            <div class="row">
              <div class="col-md-7 marginVersaoAtual">
                <div class="table-responsive tableScroll">
                  <table class="table table-striped " style="background: #f3f3f3">
                      <thead>
                          <tr>
                            <th scope="col">nome</th>
                            <th scope="col">Data</th>
                          </tr>
                      </thead>
                      <tbody >
                        <tr>
                          <th scope="row">{{ $planosAlocados->nameMaterialExtra}}</th>
                          <td>{{ $planosAlocados->datas }}</td>
                          <td>
                            <a  class="btn btn-primary" href="{{ route('downloadMaterialExtra', $planosAlocados->id) }}">
                              download
                            </a>
                          </td>
                        </tr>
                      </tbody>
                      
                    </table>
                  </div>
                </div>
              </div>
            @endif

          @endforeach

          @auth

            @php
              $courseId = DB::table('course_users') // selecionar os dados dos planos
                ->where('user_id','=', Auth::User()->id )
                ->get()
            @endphp

              @foreach($courseId as $courseId)
                @if(  ( ( $planoController->get_user_checkProfessor() ) == 1)    &&     ( $planosAlocados->validacao == 0  )   &&  ( $planosAlocados->curso ==  ($courseId->course_id) )  )
                  <div class="row marginButtonValidate">
                    <div class="col-md-2 marginButtonRefuse">
                      <a href="{{  url('/recusar', $planosAlocados->id ) }}" class="btn btn-danger btn-lg">Recusar</a>
                    </div>
                    <div class="col-md-2">
                      <a href="{{  url('/validacao', $planosAlocados->id ) }}" class="btn  btn-lg btn-success">Validar</a>
                    </div>  
                  </div>
                @endif
                @if(  ( ( $planoController->get_user_checkProfessor() ) == 1)    &&     ( $planosAlocados->validacao == 1  )   &&  ( $planosAlocados->curso ==  ($courseId->course_id) )  )
                  <div class="row marginButtonValidate">
                    <div class="col-md-2 marginButtonRefuse">
                      <a href="{{  url('/recusar', $planosAlocados->id ) }}" class="btn btn-danger btn-lg">Recusar</a>
                    </div>
                  </div>
                @endif
              @endforeach

              @if( Auth::User()->id== 1)
                  @if( $planosAlocados->validacao == 0 )
                    <div class="row marginButtonValidate">
                      <div class="col-md-2 marginButtonRefuse">
                        <a href="{{  url('/recusar', $planosAlocados->id ) }}" class="btn btn-danger btn-lg">Recusar</a>
                      </div>
                      <div class="col-md-2">
                        <a href="{{  url('/validacao', $planosAlocados->id ) }}" class="btn  btn-lg btn-success">Validar</a>
                      </div>  
                    </div>
                  @endif
                  @if( $planosAlocados->validacao == 1 )
                  <div class="row marginButtonValidate">
                    <div class="col-md-2 marginButtonRefuse">
                      <a href="{{  url('/recusar', $planosAlocados->id ) }}" class="btn btn-danger btn-lg">Recusar</a>
                    </div>
                  </div>
                  @endif
              @endif
            @endauth
           
      </div>
    </section>
    <!-- End boody Plano de ensino-->
  
    
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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>