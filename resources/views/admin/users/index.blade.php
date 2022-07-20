@extends('adminlte::page')

@section('title','Meus Usuários')

@section('content_header')
    <h1>Meus Usuários</h1>
@endsection

@section('content')
@if(session('warning'))
        <x-alert>
            {{session('warning')}}
        </x-alert>
@endif

@if(session('success'))
  <x-success>
    {{session('success')}}
  </x-success>
@endif

@if(session('error'))
  <x-wrong>
    {{session('error')}}
  </x-wrong>
@endif
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Todos os Usuários</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="Busca" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>NOME</th>
                      <th>E-MAIL</th>
                      <th>AÇÕES</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="{{route('users.show',['user' => $user->id])}}" class="btn btn-info btn-sm"> <ion-icon name="create"></ion-icon> Editar</a>
                                @if($loggedId !== intval($user->id))
                               <form action="{{route('users.destroy',['user' => $user->id])}}" method="POST" class="d-inline">
                                 @method('DELETE')
                                 @csrf
                                 <button onclick="return confirm('Tem certeza que deseja excluir este usuário?')" class="btn btn-danger btn-sm">Excluir</button>
                               </form>
                               @endif
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    <a href="{{ route('users.create')}}" class="btn btn-primary">Adicionar Usuário</a>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
@endsection