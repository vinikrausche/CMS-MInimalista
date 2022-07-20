@extends('adminlte::page')

@section('title','Editar Página')

@section('content_header')
<h1>Editar Página</h1>
@endsection

@section('content')
@if($errors->any())
    <x-wrong>
        @foreach($errors->all() as $error)
            <ul>      
                <li>{{$error}}</li>
            </ul>
        @endforeach
    </x-wrong>
@endif
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal" action="{{route('pages.update',['page' => $page->id])}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Título da Página</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="title" id="title" value="{{$page->title}}">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="body" class="col-sm-2 col-form-label">Conteúdo</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{$page->body}}</textarea>
                    </div>
                </div>
                <div class="card-footer">
            <button type="submit" class="btn btn-info">Salvar</button>
            <a class="btn btn-default float-right" href="{{route('pages.index')}}">Cancelar</a>
        </div>
            </form>
        </div>
    </div>
     
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector:'textarea',
        height:300,
        menubar:false,
        plugins: ['link','table','image','autoresize','lists'],
        toolbar: 'undo reundo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | table | link image | bullist numlist |',
        content_css:[
            '{{asset("assets/css/style.css")}}'
        ],
        images_upload_url:  "{{route('uploadimage')}}",
        images_upload_credentials:true,
        convert_urls:false
    });
    </script>
@endsection