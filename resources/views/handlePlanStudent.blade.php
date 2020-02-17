
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
                                    
                                    <a class="dropdown-item" href="{{ url('/perfil_aluno ') }}">Perfil</a>
                              
                                  @endif

                                  @if( ( $planoController->get_user_checkProfessor() ) == 1) 
                                    <a class="dropdown-item" href="{{ url('/handle_plan_teacher') }}">Planos e Materiais</a>
                                    <a class="dropdown-item" href="{{ url('/perfil_professor') }}">Perfil</a>
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
            <h1 style="color: #14395f">Planos e Materiais</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- End header-->

    <!-- Body Perfil Aluno -->
    <section style="background:#4c7aa9;">
      <div class="container">
        @if( ( $planoController->planoRecusado() ) == 1) 
          <div class="card text-center cardPlanoRecusado" >
            <div class="card-body">
              <h5 class="card-title">Atenção Plano Recusado</h5>
              <h6 class="card-subtitle mb-2 text-muted">Edite e reenviará para o professor. </h6>
              <div class="table-responsive " style="margin-top:24px;">  
                <table class="table" style="background: #ffffff">
                  <thead>
                    <tr>
                      <th scope="col">Disciplina</th>
                      <th scope="col">Curso</th>
                    </tr>
                  </thead>
                  <tbody >
                    @foreach($planoRejected as $planoRejected)  
                      @php
                          $nameCurse = DB::table('courses')
                            ->where('id',$planoRejected->curso )
                            ->value('name');
                            
                          $planoRejected->curso = $nameCurse;
                        @endphp                     
                      <tr>
                        <td><a href="{{  url('/select_plano', $planoRejected->id ) }}"> {{ $planoRejected->disciplina }}</a></td>
                        <td>{{ $planoRejected->curso }}</td>
                        <td>
                          <form action ="{{ url('/delete_plano', $planoRejected->id ) }}" method = "post">
                
                            {{csrf_field()}}
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="SUBMIT" value="Deletar" class="btn btn-danger">
                          </form>
                        </td>
                        <td>
                          <a href="{{  url('/edit_plano', $planoRejected->id ) }}" class="btn  btn-success">editar</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @endif
        <div class="row" style="width:140%">
          <div class="col-md-5 marginButtonPlano">
              <div class="row">
                <button type="button" onclick="Mudarestado('minhaDiv1')" class="btn btn-light btn-lg btn-block btnAccordion">Planos Pendentes</button>
              </div>
              <div id="minhaDiv1" style="display:none" class="accordionBox" >
                <div class="row" >
                  <div class="col-md-12">
                    <div class="table-responsive tableScroll">
              
                      <table class="table table-striped  table-borderless" >
                      <thead>
                      <tr>
                        <th scope="col" class="text-center">Disciplina</th>
                        <th scope="col" class="text-center">Curso</th>
                      </tr>
                    </thead>
                    <tbody >
                      @foreach($planosPending as $planosPending)  
                        @php
                          $nameCurse = DB::table('courses')
                            ->where('id',$planosPending->curso )
                            ->value('name');
                            
                          $planosPending->curso = $nameCurse;
                        @endphp                 
                      <tr>
                          <td><a href="{{  url('/select_plano', $planosPending->id ) }}"> {{ $planosPending->disciplina }}</a></td>
                          <td>{{ $planosPending->curso }}</td>

                          <td>
                            <form action ="{{ url('/delete_plano', $planosPending->id ) }}" method = "post">
                  
                              {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="SUBMIT" value="Deletar" class="btn btn-danger">
                            </form>
                          </td>
                          <td>
                            <a href="{{  url('/edit_plano', $planosPending->id ) }}" class="btn  btn-success">editar</a>
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
                        </table>
                      </div>            
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="row" style="width:140%">
          <div class="col-md-5 marginButton2Plano">
              <div class="row">
                <button type="button" onclick="Mudarestado('minhaDiv2')" class="btn btn-light btn-lg btn-block btnAccordion2" >Planos Adicionados</button>
              </div>
              <div id="minhaDiv2" style="display:none;" class="accordionBox2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive tableScroll">
                    <table class="table table-borderless" style="backgroud:#ffffff">
                      <thead>
                      <tr>
                        <th scope="col" class="text-center">Disciplina</th>
                        <th scope="col" class="text-center">Curso</th>
                        
                      </tr>
                    </thead>
                    <tbody >
                      @foreach($planos as $planos)    
                      @php
                          $nameCurse = DB::table('courses')
                            ->where('id',$planos->curso )
                            ->value('name');
                            
                          $planos->curso = $nameCurse;
                      @endphp               
                      <tr>
                          <td><a href="{{  url('/select_plano', $planos->id ) }}"> {{ $planos->disciplina }}</a></td>
                          <td>{{ $planos->curso }}</td>

                          <td>
                            <form action ="{{ url('/delete_plano', $planos->id ) }}" method = "post">
                  
                              {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="SUBMIT" value="Deletar" class="btn btn-danger">
                            </form>
                          </td>
                          <td>
                            <a href="{{  url('/edit_plano', $planos->id ) }}" class="btn  btn-success">editar</a>
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
                        </table>
                      </div>
                      
                     
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="row" style="width:140%">
          <div class="col-md-5 marginButtonAddPlan">
            <div class="row">
              <a class="btn btn-light btn-lg btn-block buttonGreen "  style="box-shadow:0px 165px -19px #191616;"href="{{ url('/create_plano') }}">Adicionar plano</a> 
            </div> 
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
    <!-- JS COPE-->
    <script type="text/javascript" src="js/COPE.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
  </body>
</html>