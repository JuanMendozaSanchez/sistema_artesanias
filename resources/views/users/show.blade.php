@extends('layout')

@section('title', "Usuario {$id}")

@section('content')
	<br>
	<br>
    <h1>Usuario #{{ $id }}</h1>
    <p>Mostrando detalle del usuario: {{ $id }}</p>

@endsection