@extends('layouts.main')

@section('title', 'HDC Eventos')

@section('content')

<h1>Algum título</h1>
<img src="{{ asset('img/banner.jpg') }}" alt="Banner">


@if (10 > 15)
    <p>A condição é true</p>
@elseif($nome == 'Luan')
    <p>Oi eu sou {{ $nome }} e tem {{ $idade }} anos</p>
@else
    <p>O nome não é pedro</p>
@endif

@for ($i = 0; $i < count($arr); $i++)
    <p>{{ $arr[$i] }} - {{ $i }}</p>
    @if ($i == 2)
        <p>O i é 2</p>
    @endif
@endfor

@foreach ($nomes as $nomes)
    <P>{{ $loop->index }}</P>
    <p>{{ $nomes }}</p>
@endforeach

@php
    $name = 'joão';
    echo $name;
@endphp

@endsection