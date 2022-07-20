@extends('site.layout')


@section('title',$page['slug'])
<link rel="stylesheet" href="{{asset('assets/css/page.css')}}">


@section('content')
<h2>{{$page->title}}</h2>
<div id="line"></div>

<div class="container">
    {!!$page['body']!!}
</div>
@endsection