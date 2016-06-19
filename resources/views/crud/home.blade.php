@extends('crud.master')

@section('content')

<h1>Welcome Home</h1>
<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, possimus, ullam? Deleniti dicta eaque facere, facilis in inventore mollitia officiis porro totam voluptatibus! Adipisci autem cumque enim explicabo, iusto sequi.</p>
<hr>

<a href="{{ route('hotel.index') }}" class="btn btn-info">Ver Hoteles</a>
<a href="{{ route('hotel.create') }}" class="btn btn-primary">Agregar nuevo hotel</a>

@stop
