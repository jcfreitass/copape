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
     <link rel="stylesheet" type="text/css" href="/css/style.css" />
     <link rel="stylesheet" type="text/css" href="/css/planoEnsino.css" />

    <!-- Favicon-->
    <link rel="shortcut icon" href="/Imagens/brasaoUfsc.png">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <!-- JS copa-->
    <script type="text/javascript" src="../../js/COPE.js"></script>
    
    <title>Plano de ensino</title>
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
            @if($planos->typePlan === 0)  
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
          <div class="col-md-10 marginFormInserir">
            <form action ="{{ url('/edit_plano', $planos->id ) }}" method = "post">
              
              {{csrf_field()}}
                <div class="form-group row">
                  <label for="tema"  class="col-sm-2 col-form-label letraForm"> Titulo </label>
                    <div class="col-sm-4">
                      <input type="text" name = "title" placeholder ="digite o titulo " class = "form-control" value="{{ $planos->title }}">
                    </div>
                </div>
              

                <div class="form-group row">
                  <label for="tema"  class="col-sm-2 col-form-label letraForm"> Disciplina </label>
                  <div class="col-sm-4">
                    <input type="text" name = "disciplina" placeholder ="digite a disciplina " class = "form-control" value="{{ $planos->disciplina }}">
                  </div>
                </div>
              
                 <div class="form-group row">
                  <label for="nivelEnsino" class="col-sm-2 col-form-label letraForm" >Nível de ensino</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="nivelEnsino" id="nivelEnsino">
                      <option  value="Educação Infantil">Educação Infantil</option>
                      <option value="Ensino Fundamental">Ensino Fundamental</option>
                      <option value="Ensino Médio">Ensino Médio</option>
                      <option value="Ensino Superior">Ensino Superior</option>
                    </select>               
                  </div>
                </div>
   
             
                 

                <div class="form-group row">
                  <label for="knowArea" class="col-sm-2 col-form-label letraForm" >Área de conhecimento</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="knowArea" id="knowArea">
                        <option value='Matemática / Probabilidade e estatística' >Matemática / Probabilidade e estatística</option>
                        <option value='Ciência da computação' >Ciência da computação</option>
                        <option value='Astronomia / Física' >Astronomia / Física</option>
                        <option value ='Química' >Química</option>
                        <option value='Geociência' >Geociência</option>
                        <option value='Ciências biologicas I' >Ciências biologicas I</option>
                        <option value='Ciências biologicas II' >Ciências biologicas II</option>
                        <option value='Ciências biologicas III' >Ciências biologicas III</option>
                        <option value='Biodiversidade' >Biodiversidade</option>
                        <option value='Engenharia I' >Engenharia I</option>
                        <option value='Engenharia II' >Engenharia II</option>
                        <option value='Engenharia III' >Engenharia III</option>
                        <option value='Engenharia IV'>Engenharia IV</option>
                        <option value='Medicia I' >Medicia I</option>
                        <option value='Medicia II' >Medicia II</option>
                        <option value='Medicia III'>Medicia III</option>
                        <option value='Nutrição' >Nutrição</option>
                        <option value='Odontologia' >Odontologia</option>
                        <option value='Farmácia' >Farmácia</option>
                        <option value='Enfermagem' >Enfermagem</option>
                        <option value='Saúde coletiva' >Saúde coletiva</option>
                        <option value='Educação física' >Educação física</option>
                        <option value='Ciências agrárias I' >Ciências agrárias I</option>
                        <option value='Zootecnia / Recursos pesqueiros' >Zootecnia / Recursos pesqueiros</option>
                        <option value='Medicia veterinária' >Medicia veterinária</option>
                        <option value='Ciência de alimentos' >Ciência de alimentos</option>
                        <option value='Direito' >Direito</option>
                        <option value='Administração pública e de empresas, ciências contábeis e turismo' >Administração pública e de empresas, ciências contábeis e turismo</option>
                        <option value='Economia' >Economia</option>
                        <option value='Arquitetura, urbanismo e design' >Arquitetura, urbanismo e design</option>
                        <option value='Planejamento urbano e reginal / Demografia' >Planejamento urbano e reginal / Demografia</option>
                        <option value='Comunicação e informação' >Comunicação e informação</option>
                        <option value='Serviço social' >Serviço social</option>
                        <option value='Filosofia' >Filosofia</option>
                        <option value='Teologia' >Teologia</option>
                        <option value='Sociologia' >Sociologia</option>
                        <option value='Antropologia / Arqueologia' >Antropologia / Arqueologia</option>
                        <option value='História' >História</option>
                        <option value='Geografia' >Geografia</option>
                        <option value='Psicologia' >Psicologia</option>
                        <option value='Educação' >Educação</option>
                        <option value='Ciência política e relações internacionais' >Ciência política e relações internacionais</option>
                        <option value='Letras / Linguistica' >Letras / Linguistica</option>
                        <option value='Artes / Música' >Artes / Música</option>
                        <option value='Interdisciplinar' >Interdisciplinar</option>
                        <option value='Ensino' >Ensino</option>
                        <option value='Materiais' >Materiais</option>
                        <option value='Biotecnologia' >Biotecnologia</option>
                        <option value='Ciências ambientais' >Ciências ambientais</option>
                      </select>               
                    </div>
                </div>

                <div class="form-group row">
                  <label for="tema"  class="col-sm-2 col-form-label letraForm"> Semestre/Ano </label>
                  <div class="col-sm-4">
                    <input type="text" name = "semestreAno" placeholder ="Ex: 2018.2 / 2018 " class = "form-control" value="{{ $planos->semestreAno }}">
                  </div>
                </div>

                 @if( Auth::User()->id== 1)

                    <div class="form-group row">
                      <label for="professor"  class="col-sm-2 col-form-label letraForm"> Curso </label>
                      <div class="col-sm-4">
                        <select class="form-control" name = "curso" value="{{ $planos->curso }}">
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
                        <select class="form-control" name = "curso" value="{{ $planos->curso }}" id="curso">
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
                            <option value="{{$planos->curso}}">{{ $nameCourse->name }}</option>
                        @endforeach
                        </select>
                      </div>
                    </div>
                  @endif


                <div class="form-group row">
                <label for="data"  class="col-sm-2 col-form-label letraForm">Data </label>
                  <div class="col-sm-4">
                    <input type="date" name = "datas" placeholder =" " class = "form-control" value="{{ $planos->datas }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="conteudo"  class="col-sm-2 col-form-label letraForm"> Resumo</label>
                  <div class="col-sm-4">
                    <textarea class="form-control" id="planDescription"  name = "planDescription" rows="3">{{ $planos->planDescription }}</textarea>
                  </div>
                </div>
               
                <div class="form-group" style="margin-top: 5%">
                  <label for="planoEnsino" style="color: #f3f3f3">Adicionar plano de ensino</label>
                  <input type="file" class="form-control-file formInput" name="planoEnsino">
                </div>

                <div class="form-group" style="margin-top: 5%">
                  <label for="materialExtra" style="color: #f3f3f3">Adicionar material extra</label>
                  <input type="file" class="form-control-file formInput" name="materialExtra">
                </div>
      
                <div class="row">
                  <div class="col-md-1" style="margin-top:4.5%;">
                    <img src="../imagens/check-box.png" alt="Responsive image" width="20" style="margin: 0">
                  </div>
                  <div class="col-md-8"  style="margin-top:5%;  margin-left:-5%;">
                    <h3 class="navItemColor" >
                      Autorizo a utilização e edição do material alocado neste site.
                    </h3>
                  </div>
                </div>

                <div class = "form-group">

                  <input type="hidden" name="validacao" value="0">
                  <input type="hidden" name="recusarPlano" value="0">

                  <div class = "row">  
                    <div class="col-sm-2 marginButtonEdit">
                      <button type="submit" class="btn btn-success btn-lg" onclick="alertEditPlan()" name="update" value="Update" >Atualizar</button>
                    </div>
                    <div class="col-sm-2 marginButtonEdit2">
                      <button type="submit" class="btn btn-success btn-lg" onclick="alertEditPlanNew()"  name="saveNew" value="SaveNew">Criar novo</button>
                    </div>
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
                    <img src="/imagens/instagram.png" alt="Responsive image" width="34" style="margin: 0">
                  </a>
              </div>
              <div class=" col-3 col-md-2 marginYotube">
                  <a href="#">
                    <img src="/imagens/youtube.png" alt="Responsive image" width="45" style="margin: 0">
                  </a>
              </div>
              <div class=" col-3  col-md-2">
                  <a href="#">
                    <img src="/imagens/facebook.png" alt="Responsive image" width="35" style="margin: 0">
                  </a>
              </div>
            </div>
        </div>
      </div>
    </section>
    <!-- End footer-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
      $('#nivelEnsino').val("<?php echo $planos->nivelEnsino; ?>").change();
      $('#knowArea').val("<?php echo $planos->knowArea; ?>").change();
      $('#curso').val(<?php echo $planos->curso; ?>).change();
    </script>
    
  </body>
</html>