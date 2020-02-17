
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

    <!-- Boody Plano de ensino-->
    <section style="background-image: linear-gradient(to bottom right, #c7d9ec, #e1e5ea)">
      <div class="container">
       <div class="row">
          <div class="col-12  text-center marginChoose">
            <h1 class="styleWriting">Registre seus Cursos</h1>
          </div>
        </div>
        <div class="row">
          <div class="table-responsive tableChooseCourse" style="height: 133px;">  
            <table class="table table-striped table-hover ">
              @foreach($course as $course)    
                @php 
                  $nameCurse = DB::table('courses')->where('id',$course->course_id )->value('name');
                  $course->name = $nameCurse;
                @endphp  
                <tbody>  
                  <tr>
                    <td>{{ $course->name}}</td>
                    <td>
                        <form action ="{{ url('/delete_course', $course->id ) }}" method = "post">
                  
                          {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="SUBMIT" value="Deletar" class="btn btn-danger">
                      </form>
                    </td>
                  </tr>
                </tbody>
              @endforeach
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10 marginFormInserir">
            <form action ="{{ url('/choose_course') }}" method = "post">
              
              {{csrf_field()}}
            
                <div class="form-group row">
                  <label for="professor"  class="col-sm-2 col-form-label styleCourseChoose "> Curso </label>
                  <div class="col-sm-4" style="margin-left: -7%;">
                    <input type="text" name = "curso" class = "typeahead form-control">
                  </div>
                  <div class="col-sm-4">
                    <button type="submit" class="btn btn-success" style="height:-5%!important;" >Adicionar</button>
                  </div>
                </div>
                  
                <script type="text/javascript">
                    var path = "{{ route('autocomplete') }}";
                    $('input.typeahead').typeahead({
                        source:  function (query, process) {
                        return $.get(path, { query: query }, function (data) {
                                return process(data);
                            });
                        }
                    });
                </script>
            </form>
          </div>
          <div class ="row">
            <div class="form-group row">
              <div class="col-sm-4 marginButtonFinishChoose">
                <a  href="{{ url('/') }}" class="btn buttonEndCourse btn-lg">Finalizar</a>
              </div>
            </div>
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