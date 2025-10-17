@extends('layouts.main')

@section('title', 'HDC Eventos')

@section('content')
<h1>Produtos Disponiveis</h1>

@if ($busca != '')
    <p>O usuário está buscando por: {{ $busca }}</p>
@endif

@endsection