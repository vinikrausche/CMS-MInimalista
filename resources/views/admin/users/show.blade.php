@extends('adminlte::page')


@section('title','Editar Usuário')

@section('content_header')
    <h1>Dados do Usuário</h1>
@endsection

@section('content')
<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Informações de {{$user->name}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if($errors->any())
                @foreach($errors->all() as $error)
                  <ul>
                    <li>{{$error}}</li>
                  </ul>
                @endforeach
              @endif
              <form class="form-horizontal" method="POST" action="{{route('users.update',['user' => $user->id])}}">
                  @method('PUT')
                  @csrf
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Nome" value="{{$user->name}}" name="name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{$user->email}}" name="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Senha</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="Senha" name="password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword2" class="col-sm-2 col-form-label">Confirmação de Senha</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword2" placeholder="Confirme a Senha" name="password_confirmation">
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Cadastrar</button>
                  <a class="btn btn-default float-right" href="{{route('users.index')}}">Cancelar</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
@endsection