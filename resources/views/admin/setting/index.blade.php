@extends('adminlte::page')

@section('title','Confugrações do Site')

@section('content_header')
    <h1>Configurações</h1>
@endsection
   
@section('content')
@if($errors->any())
    @foreach($errors->all() as $error)
        <x-wrong>
            {{$error}}
        </x-wrong>
    @endforeach
@endif
@if(session('success'))
  <x-success>
    {{session('success')}}
  </x-success>
@endif
    <div class="card">
        <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{route('settings.save')}}">
      @method('PUT')
      @csrf
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Títutlo do Site</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="title"  value="{{$settings['title']}}" name="title">
        </div>
      </div>
      <div class="form-group row">
        <label for="subtitle" class="col-sm-2 col-form-label">Subtítulo do Site</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="subtitle" value="{{$settings['subtitle']}}" name="subtitle">
        </div>
      </div>
      <div class="form-group row">
        <label for="bgcolor" class="col-sm-2 col-form-label">Cor de Fundo do Site</label>
        <div class="col-sm-10">
          <input type="color" class="form-control" id="bgcolor" value="{{$settings['bgcolor']}}" name="bgcolor">
        </div>
      </div>
      <div class="form-group row">
        <label for="textcolor" class="col-sm-2 col-form-label">Cor do Texto</label>
        <div class="col-sm-10">
          <input type="color" class="form-control" id="textcolor" name="textcolor" value="{{$settings['textcolor']}}">
        </div>
      </div>
      
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-success">Atualizar</button>
      <a class="btn btn-default float-right" href="{{route('settings')}}">Cancelar</a>
    </div>
    <!-- /.card-footer -->
  </form>
        </div>
    </div>
@endsection