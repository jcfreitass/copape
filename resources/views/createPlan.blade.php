
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
    <link rel="shortcut icon" href="/Imagens/brasaoUfsc.png">

    <!-- Auto Complete-->

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <!-- JS copa-->
    <script type="text/javascript" src="js/COPE.js"></script>
    
    <title>Cadastro Plano de aula</title>
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
            <h1 style="color: #14395f"> Adicionar Plano</h1>
          </div>
        </div>
      </div>
    </section>

     <!--End header-->

    <!-- Boody Plano de ensino-->
    <section class="planoEnsino">
      <div class="container">
        <div class="row">
          <div class="col-md-10 marginFormInserir">
            <form action ="{{ url('/create_plano') }}" method = "post" enctype="multipart/form-data">
              
              {{csrf_field()}}
             
                <div class="row" style="margin-bottom:1%;"> 
                  <div class="col-md-2">
                    <h5 class="letraForm">Tipo de plano </h5>
                  </div>
                  <div class="form-check form-check-inline marginRadio">
                    <input class="form-check-input" type="radio" name="typePlan" value="1" checked>
                    <label class="form-check-label  letraForm" for="exampleRadios1">
                    Plano de Ensino
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="typePlan" value="0">
                    <label class="form-check-label letraForm" for="exampleRadios2">
                    Plano de Aula
                    </label>
                  </div>  
                </div>
                <div class="form-group row">
                  <label for="tema"  class="col-sm-2 col-form-label letraForm"> Titulo </label>
                    <div class="col-sm-4">
                      <input type="text" name = "title" placeholder ="digite o titulo " class = "form-control">
                    </div>
                </div>
                <div class="form-group row">
                  <label for="tema"  class="col-sm-2 col-form-label letraForm"> Disciplina </label>
                  <div class="col-sm-4">
                    <input type="text" name = "disciplina" placeholder ="digite a disciplina " class = "form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="nivelEnsino" class="col-sm-2 col-form-label letraForm" >Nível de ensino</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="nivelEnsino">
                      <option>Educação Infantil</option>
                      <option>Ensino Fundamental</option>
                      <option>Ensino Médio</option>
                      <option>Ensino Superior</option>
                    </select>               
                  </div>
                </div>

                <div class="form-group row">
                  <label for="knowArea" class="col-sm-2 col-form-label letraForm" >Área de conhecimento</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="knowArea">
                        <option>Matemática / Probabilidade e estatística</option>
                        <option>Ciência da computação</option>
                        <option>Astronomia / Física</option>
                        <option>Química</option>
                        <option>Geociência</option>
                        <option>Ciências biologicas I</option>
                        <option>Ciências biologicas II</option>
                        <option>Ciências biologicas III</option>
                        <option>Biodiversidade</option>
                        <option>Engenharia I</option>
                        <option>Engenharia II</option>
                        <option>Engenharia III</option>
                        <option>Engenharia IV</option>
                        <option>Medicia I</option>
                        <option>Medicia II</option>
                        <option>Medicia III</option>
                        <option>Nutrição</option>
                        <option>Odontologia</option>
                        <option>Farmácia</option>
                        <option>Enfermagem</option>
                        <option>Saúde coletiva</option>
                        <option>Educação física</option>
                        <option>Ciências agrárias I</option>
                        <option>Zootecnia / Recursos pesqueiros</option>
                        <option>Medicia veterinária</option>
                        <option>Ciência de alimentos</option>
                        <option>Direito</option>
                        <option>Administração pública e de empresas, ciências contábeis e turismo</option>
                        <option>Economia</option>
                        <option>Arquitetura, urbanismo e design</option>
                        <option>Planejamento urbano e reginal / Demografia</option>
                        <option>Comunicação e informação</option>
                        <option>Serviço social</option>
                        <option>Filosofia</option>
                        <option>Teologia</option>
                        <option>Sociologia</option>
                        <option>Antropologia / Arqueologia</option>
                        <option>História</option>
                        <option>Geografia</option>
                        <option>Psicologia</option>
                        <option>Educação</option>
                        <option>Ciência política e relações internacionais</option>
                        <option>Letras / Linguistica</option>
                        <option>Artes / Música</option>
                        <option>Interdisciplinar</option>
                        <option>Ensino</option>
                        <option>Materiais</option>
                        <option>Biotecnologia</option>
                        <option>Ciências ambientais</option>
                      </select>               
                    </div>
                </div>

                <div class="form-group row">
                  <label for="tema"  class="col-sm-2 col-form-label letraForm"> Semestre/Ano </label>
                  <div class="col-sm-4">
                    <input type="text" name = "semestreAno" placeholder ="Ex: 2018.2 / 2018 " class = "form-control">
                  </div>
                </div>
                @if( Auth::User()->id== 1)

                  <div class="form-group row">
                    <label for="professor"  class="col-sm-2 col-form-label letraForm"> Curso </label>
                    <div class="col-sm-4">
                      <select class="form-control" name = "curso">
                      @php
                        $nameCourse = DB::table('courses')
                          ->get();
                      @endphp
                      @foreach($nameCourse as $nameCourse)  
                          <option>{{ $nameCourse->name }}</option>
                      @endforeach
                      </select>
                    </div>
                  </div>

                @else
              
                  <div class="form-group row">
                    <label for="professor"  class="col-sm-2 col-form-label letraForm"> Curso </label>
                    <div class="col-sm-4">
                      <select class="form-control" name = "curso">
                      @php
                        $nameCourse = DB::table('courses')
                          ->join('course_users', function ($join) {
                              $join->on('courses.id', '=', 'course_users.course_id')
                                  ->where('course_users.user_id', '=', Auth::user()->id)
                                  ->where('course_users.checkCourse', '=', 1);
                          })
                          ->get();
                      @endphp
                      @foreach($nameCourse as $nameCourse)  
                          <option>{{ $nameCourse->name }}</option>
                      @endforeach
                      </select>
                    </div>
                  </div>
                  
                @endif
              
                <!--
                <div class="form-group row">
                  <label for="curso"  class="col-sm-2 col-form-label letraForm"> Curso </label>
                  <div class="col-sm-4">
                    <input type="text" name = "curso" placeholder ="digite o curso " class = "form-control">
                  </div>
                </div>
                -->
                <div class="form-group row">
                <label for="curso"  class="col-sm-2 col-form-label letraForm"> Data </label>
                  <div class="col-sm-4">
                    <input type="date" name = "datas" placeholder =" " class = "form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="curso"  class="col-sm-2 col-form-label letraForm"> Resumo </label>
                  <div class="col-sm-6">
                      <!--<input type="text" name = "planDescription" placeholder ="digite o resumo de seu pano de aula" class = "form-control" rows="3">-->
                      <textarea class="form-control" id="planDescription"  name = "planDescription" rows="3"></textarea>
                      
                  </div>
                </div>
               
                <div class="form-group " style="margin-top: 5%; width:66%;">
                    <label for="planoEnsino" style="color: #f3f3f3">Adicionar plano</label>
                    <input type="file" class="form-control-file formInput" name="planoEnsino" >
                </div>
                
                <div class="form-group" style="margin-top: 5%; width:66%;">
                  <label for="materialExtra" style="color: #f3f3f3">Adicionar material extra</label>
                  <input type="file" class="form-control-file formInput" name="materialExtra" >
                </div>
                
                <div class="row">
                  <div class="col-md-1" style="margin-top:4.5%;">
                    <img src="imagens/check-box.png" alt="Responsive image" width="20" style="margin: 0">
                  </div>
                  <div class="col-md-8"  style="margin-top:5%;  margin-left:-5%;">
                    <h3 class="navItemColor" >
                      Autorizo a utilização e edição do material alocado neste site.
                    </h3>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-10 marginButtonForm">
                    <button type="submit" class="btn btn-success btn-lg" onclick="alertCreatePlan()">Salvar</button>
                  </div>
                </div>
              
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- End boody Plano de ensino-->
    
    <!-- Footer-->
    <section  class="footer" style="margin-top: 0px" >
      <div class="container">
        <div class ="row">
          <div class="col-md-6 marginDetalhesFooter" >
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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
  </body>
</html>