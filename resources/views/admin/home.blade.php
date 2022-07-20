@extends('adminlte::page')

@section('plugins.Chartjs',true)

@section('title','Painel')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1>Dashboard</h1>
        </div>
        <div class="col-md-3">
            <div class="float-right">
                <form  method="GET">
                    <select onchange="this.form.submit()" name="dias" id="">
                    <option {{$interval === 0? 'selected="select"' :''}} value="0">Hoje</option>
                        <option {{$interval === 30? 'selected="select"' :'' }} value="30">Últimos 30 dias</option>
                        <option {{$interval === 60? 'selected="select"' :''}} value="60">últimos 60 dias</option>
                 </select>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                   <h3>{{$visits}}</h3>
                   <p>Visitas</p>
                </div>
                <div class="icon">
                    <i class="far fa-w fa-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$onlineCount}}</h3>
                    <p>Usuários Online</p>
                </div>
                <div class="icon">
                    <i class="far fa-w fa-heart"></i>
                </div>
            </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$pages}}</h3>
                        <p>Páginas</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-w fa-file"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$users}}</h3>
                        <p>Usuários</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-w fa-user"></i>
                    </div>
                </div>
            </div>
      </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Páginas mais Visitadas</h3>
                </div>
                <div class="card-body">
                    <canvas id="pagePie"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Informações do Sistema</h3>
                </div>
                <div class="card-body">
                    <p>Sem Dados</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function () {
                let ctx = document.getElementById('pagePie').getContext('2d')
            window.pagePie = new Chart(ctx,{
                type:'pie',
                data:{
                    datasets:[{
                        data:{{$values}},
                        backgroundColor: '#0000ff'
                    }],
                    labels:{!! $labels !!}
                },
                options:{
                    responsive:true,
                    legends:{
                        display:false,
                    }
                }
            })
        }
    </script>
@endsection