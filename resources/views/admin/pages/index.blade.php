@extends('adminlte::page')

@section('title','Minhas Páginas')

@section('content_header')
    <h1>Todas as Páginas</h1>
@endsection

@section('content')

@if(session('info'))
    <x-info>
        {{session('info')}}
    </x-info>
@endif
    @if(count($pages) === 0)
        <div class="card">
            <div class="card-body">
                <h4 style="text-align: center;">Você ainda não possui nenhuma página :(</h4>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="{{route('pages.create')}}">Criar Página</a>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>PAGINA</th>
                            <th>TITULO</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{$page->id}}</td>
                                <td>{{$page->title}}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" target="_blank" href=""><ion-icon name="eye"></ion-icon> Ver</a>
                                    <a class="btn btn-info btn-sm" href="{{route('pages.edit',['page' => $page->id])}}"><ion-icon name="create"></ion-icon> Editar</a>
                                    <form class="d-inline" action="{{route('pages.destroy',['page' => $page->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf 
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Tem certeza que deseja excluir esta página?')"><ion-icon name="trash"></ion-icon> Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer">
                    <a class="btn btn-primary" href="{{route('pages.create')}}">Criar Página</a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $pages->links() }}
        </div>
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    @endif

@endsection