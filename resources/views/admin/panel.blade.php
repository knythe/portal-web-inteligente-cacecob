<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Dashboard')

@push('css')

@endpush


@section('content')
<!--Contenido-->
<h1 class="color:white">{{auth()->user()->name}}</h1>
<h1>success/administrador/dashboard</h1>

@endsection

@push('js')

@endpush