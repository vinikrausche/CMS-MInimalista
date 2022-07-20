@extends('adminlte::page')

@section('title','Nova Página')

@section('content_header')
    <h1>Nova Página</h1>
@endsection

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-wrong>
                <ul>
                    <li>{{$error}}</li>
                </ul>
            </x-wrong>
        @endforeach
    @endif
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal" action="{{route('pages.store')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Título do Página</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Título da Página" name="title" id="title" maxlength="155">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="body" class="col-sm-2 col-form-label">Conteúdo Principal</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success">Enviar</button>
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