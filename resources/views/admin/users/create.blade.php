@extends('adminlte::page')

@section('title','Novo Usuário')

@section('content_header')
    <h1>Novo Usuário</h1>
@endsection

@section('content')
@if($errors->any())
    <x-wrong>
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    </x-wrong>
@endif
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Cadastro</h3>
    </div>
    <form action="{{route('users.store')}}" method="POST" role="form">
        @csrf 
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" placeholder="Digite seu nome" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="Digite sua Senha" class="form-control">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmação</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmação de Senha" class="form-control">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" type="submit">Cadastrar</button>
        </div>
    </form>
</div>
@endsection