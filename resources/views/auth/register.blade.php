@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center marginLogin">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header styleLogin">{{ __('Cadastro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder ="email@adress.com" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="registration"  class="col-md-4 col-form-label text-md-right"> Matricula </label>
                            <div class="col-md-6">
                                <input type="number" name = "registration" placeholder ="x x x x x x " class = "form-control registration">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="curso"  class="col-md-4 col-form-label text-md-right"> CPF </label>
                            <div class="col-md-6">
                                <input type="text" name = "cpf" placeholder ="x x x . x x x . x x x - x x " class = "form-control cpf">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="curso"  class="col-md-4 col-form-label text-md-right"> Telefone </label>
                            <div class="col-md-6">
                                <input type="text"  name="telefone" placeholder ="( x x ) x - x x x x - x x x x " class = "form-control telefone" id="telefone">
                            </div>
                        </div>
                    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="hidden" name="checkAluno" value="0">
                                <input type="hidden" name="checkProfessor" value="0">
                        
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 