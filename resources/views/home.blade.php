@extends('layouts.app')

@section('titulo')
    Home
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />
@endsection
