
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
     <link rel="stylesheet" type="text/css" href="css/perfil.css" />

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

      <section class="tituloPlanodeEnsino">
        <div class="container">
          <div class="row">
            <div class="col-md-6 text-center marginHeader">
              <h1 style="color: #14395f"> Validar Usuário</h1>
            </div>
          </div>
        </div>
      </section>

      <!-- End header-->

    <!-- Body Perfil Aluno -->
    <section style="background:#4c7aa9">
      <div class="container" style="padding-bottom:11%; padding-top:1%;">
      @if( Auth::User()->id== 1)
      <div class="row  widthBtnAccordion">
          <div class="col-md-5 marginButtonPlano">
              <div class="row">
                <button type="button" onclick="Mudarestado('minhaDiv1')" class="btn btn-light btn-lg btn-block btnAccordion  ">Validar Professor</button>
              </div>
              <div id="minhaDiv1" style="display:none"  class="accordionBox">
                <div class="row">
                  <div class="col-md-12" style="margin-top: 2%;">
                    <div class="table-responsive tableAccordion">
                      <table class="table table-borderless">
                        <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Curso</th>
                        </tr>
                        </thead>
                        <tbody >
                        
                        @foreach($authTeacher as $authTeacher) 
                        @php
                          $nameCurse = DB::table('courses')
                            ->where('id', $authTeacher->course_id)
                            ->value('name');

                          $authTeacher->course_id =$nameCurse; 
                        @endphp 
                          
                                <tbody>  
                                  <tr>
                                    <td style="color:#007bff;" data-course="{{$authTeacher->course_id}}" data-name="{{$authTeacher->name}}" data-email="{{$authTeacher->email}}" data-telefone="{{$authTeacher->telefone}}" data-toggle="modal" data-target="#modalTeacher">{{ $authTeacher->name}}</td>
                                    <td>{{ $authTeacher->course_id }}</td>
                                    <td>
                                      <a href="{{  url('/refuse_course', $authTeacher->id ) }}" class="btn btn-danger">recusar</a>
                                    </td>
                                    <td>
                                      <a href="{{  url('/accept_course', $authTeacher->id ) }}" class="btn  btn-success">validar</a>
                                    </td>
                                  </tr>
                                </tbody>
                                </div>
                              @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
        <div class="row  widthBtnAccordion">
          <div class="col-md-5 marginButton2Plano">
              <div class="row">
                <button type="button" onclick="Mudarestado('minhaDiv2')" class="btn btn-light btn-lg btn-block btnAccordion2">Professores Aceitos</button>
              </div>
              <div id="minhaDiv2" style="display:none"  class="accordionBox2">
                <div class="row">
                  <div class="col-md-12" style="margin-top: 2%;">
                    <div class="table-responsive tableAccordion">
                      <table class="table table-borderless">
                        <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Curso</th>
                        </tr>
                      </thead>
                      
                      @foreach($authenticatedTeacher as $authenticatedTeacher)   
                        @php
                          $nameCurse2 = DB::table('courses')
                            ->where('id', $authenticatedTeacher->course_id)
                            ->value('name');

                          $authenticatedTeacher->course_id = $nameCurse2; 
                        @endphp 
                          <tbody>  
                              <tr>
                                <td style="color:#007bff;" data-course="{{$authenticatedTeacher->course_id}}" data-name="{{$authenticatedTeacher->name}}" data-email="{{$authenticatedTeacher->email}}" data-telefone="{{$authenticatedTeacher->telefone}}" data-toggle="modal" data-target="#modalTeacher">{{ $authenticatedTeacher->name}}</td>
                                <td>{{ $authenticatedTeacher->course_id}}</td>
                                <td>
                                  <a href="{{  url('/refuse_course', $authenticatedTeacher->id ) }}" class="btn btn-danger">recusar</a>
                                </td>
                              </tr>
                          </tbody>
                        @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      <div class="row widthBtnAccordion"> 
          <div class="col-md-5 marginButtonPlano">
              <div class="row">
                <button type="button" onclick="Mudarestado('minhaDiv3')" class="btn btn-light btn-lg btn-block btnAccordion">Validar Aluno</button>
              </div>
              <div id="minhaDiv3" style="display:none" class="accordionBox">
                <div class="row">
                  <div class="col-md-12" style="margin-top: 2%;">
                    <div class="table-responsive tableAccordion">
                      <table class="table table-borderless">
                        <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Curso</th>
                          
                        </tr>
                        </thead>
                        <tbody >
                        
                        @foreach($authStudentADM as $authStudentADM)    

                        @php
                          $nameCurse = DB::table('courses')
                            ->where('id', $authStudentADM->course_id)
                            ->value('name');

                            $authStudentADM->course_id = $nameCurse;
                        @endphp
                                <tbody>  
                                  <tr>
                                    <td style="color:#007bff;" data-course="{{$authStudentADM->course_id}}" data-name="{{$authStudentADM->name}}" data-email="{{$authStudentADM->email}}" data-telefone="{{$authStudentADM->telefone}}" data-toggle="modal" data-target="#modalStudent">{{ $authStudentADM->name}}</td>
                                    <td>{{ $nameCurse}}</td>
                                    <td>
                                      <a href="{{  url('/refuse_course', $authStudentADM->id ) }}" class="btn btn-danger">recusar</a>
                                    </td>
                                    <td>
                                      <a href="{{  url('/accept_course', $authStudentADM->id ) }}" class="btn  btn-success">validar</a>
                                    </td>
                                  </tr>
                                </tbody>
                              @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
        <div class="row widthBtnAccordion">
          <div class="col-md-5 marginButton2Plano">
              <div class="row">
                <button type="button" onclick="Mudarestado('minhaDiv4')" class="btn btn-light btn-lg btn-block btnAccordion2">Alunos Aceitos</button>
              </div>
              <div id="minhaDiv4" style="display:none" class="accordionBox2">
                <div class="row">
                  <div class="col-md-12" style="margin-top: 2%;">
                    <div class="table-responsive tableAccordion">
                      <table class="table table-borderless " style="background: #f3f3f3">
                        <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Cursos</th>
                        </tr>
                      </thead>
                      
                      @foreach($authCourse as $authCourse)    

                        @php
                          $nameCurse = DB::table('courses')
                            ->where('id', $authCourse->course_id)
                            ->value('name');
                            
                          $authCourse->course_id = $nameCurse;
                          
                        @endphp
                          <tbody>  
                              <tr>
                              <td style="color:#007bff;" data-course="{{$authCourse->course_id}}" data-name="{{$authCourse->name}}" data-email="{{$authCourse->email}}" data-telefone="{{$authCourse->telefone}}" data-toggle="modal" data-target="#modalStudent">{{ $authCourse->name}}</td>
                                <td>{{ $nameCurse }}</td>
                                <td>
                                  <a href="{{  url('/refuse_course', $authCourse->id ) }}" class="btn btn-danger">recusar</a>
                                </td>
                              </tr>
                          </tbody>
                        @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      @else
      <div class="row widthBtnAccordion">
          <div class="col-md-5 marginButtonPlano">
              <div class="row">
                <button type="button" onclick="Mudarestado('minhaDiv2')" class="btn btn-light btn-lg btn-block btnAccordion ">Validar Aluno</button>
              </div>
              <div id="minhaDiv2" style="display:none" class="accordionBox">
                <div class="row">
                  <div class="col-md-12" style="margin-top: %;">
                    <div class="table-responsive tableAccordion">
                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col" class="text-center">Nome</th>
                            <th scope="col" class="text-center">Curso</th>
                          </tr>
                        </thead>
                        <tbody >
                        
                        @foreach($authStudent as $authStudent)  

                            @php
                              $nameCurse = DB::table('courses')
                                ->where('id', $authStudent->course_id)
                                ->value('name');

                              $authStudent->course_id = $nameCurse;
                            @endphp
                                <tbody>  
                                  <tr>
                                    <td style="color:#007bff;" data-course="{{$authStudent->course_id}}" data-name="{{$authStudent->name}}" data-email="{{$authStudent->email}}" data-telefone="{{$authStudent->telefone}}" data-toggle="modal" data-target="#modalStudent">{{ $authStudent->name}}</td>
                                    <td>{{ $authStudent->course_id}}</td>
                                    <td>
                                      <a href="{{  url('/refuse_course', $authStudent->id ) }}" class="btn btn-danger">recusar</a>
                                    </td>
                                    <td>
                                      <a href="{{  url('/accept_course', $authStudent->id ) }}" class="btn  btn-success">validar</a>
                                    </td>
                                  </tr>
                                </tbody>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
        <div class="row widthBtnAccordion" >
          <div class="col-md-5 marginButton2Plano">
              <div class="row">
                <button type="button" onclick="Mudarestado('minhaDiv')" class="btn btn-light btn-lg btn-block btnAccordion2">Alunos Aceitos</button>
              </div>
              <div id="minhaDiv" style="display:none" class="accordionBox2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive tableAccordion">
                      <table class="table table-borderless ">
                        <thead>
                        <tr>
                          <th scope="col" class="text-center">Nome</th>
                          <th scope="col" class="text-center">Curso</th>
                        </tr>
                      </thead>
                      
                      @foreach($authCourse as $authCourse)    
                        @php
                          $nameCurse = DB::table('courses')
                            ->where('id', $authCourse->course_id)
                            ->value('name');

                          $authCourse->course_id = $nameCurse;
                        @endphp
                          <tbody>  
                              <tr>
                              <td style="color:#007bff;" data-course="{{$authCourse->course_id}}" data-name="{{$authCourse->name}}" data-email="{{$authCourse->email}}" data-telefone="{{$authCourse->telefone}}" data-toggle="modal" data-target="#modalStudent">{{ $authCourse->name}}</td>
                                <td>{{ $authCourse->course_id}}</td>
                                <td>
                                  <a href="{{  url('/refuse_course', $authCourse->id ) }}" class="btn btn-danger">recusar</a>
                                </td>
                              </tr>
                          </tbody>
                        @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
        @endif
      </div>
    </section>
    <!-- End-->

    <!-- Modal Teacher -->
    <div class="modal fade" id="modalTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Professor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <h5 style="margin-left:1%">Nome: &nbsp; </h5> <output type="text" class="" name="name" id="name">    
            </div>
            <div class="row">
              <h5 style="margin-left:1%">Email:  &nbsp;</h5><output type="text" class="" name="email" id="email">     
            </div>
            <div class="row">
              <h5 style="margin-left:1%">Telefone:  &nbsp;</h5><output type="text" class="" name="telefone" id="telefone">   
            </div>
            <div class="row">
              <h5 style="margin-left:1%">Curso:  &nbsp;</h5><output type="text" class="" name="course" id="course">                         
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      $('#modalTeacher').on('show.bs.modal',function(event){

        var button = $(event.relatedTarget)
        var name = button.data('name')
        var email = button.data('email')
        var telefone = button.data('telefone')
        var course = button.data('course')

        var modal = $(this)

        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #telefone').val(telefone);
        modal.find('.modal-body #course').val(course);

        });
    </script>

    <!-- Modal Student -->
    <div class="modal fade" id="modalStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Estudante</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <h5 style="margin-left:1%">Nome: &nbsp; </h5> <output type="text" class="" name="name" id="name">    
            </div>
            <div class="row">
              <h5 style="margin-left:1%">Email:  &nbsp;</h5><output type="text" class="" name="email" id="email">     
            </div>
            <div class="row">
              <h5 style="margin-left:1%">Telefone:  &nbsp;</h5><output type="text" class="" name="telefone" id="telefone">   
            </div>
            <div class="row">
              <h5 style="margin-left:1%">Curso:  &nbsp;</h5><output type="text" class="" name="course" id="course">                         
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      $('#modalStudent').on('show.bs.modal',function(event){

        var button = $(event.relatedTarget)
        var name = button.data('name')
        var email = button.data('email')
        var telefone = button.data('telefone')
        var course = button.data('course')

        var modal = $(this)

        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #telefone').val(telefone);
        modal.find('.modal-body #course').val(course);

        });
    </script>

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