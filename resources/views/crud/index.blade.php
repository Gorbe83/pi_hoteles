@extends('crud.master')

@section('content')

<h1>Lista de Hoteles</h1>
<p class="lead">Lista de los Hoteles <a href="{{ route('hotel.create') }}">¿Crear uno nuevo?</a></p>
<hr>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nombre</td>
            <td>Ciudad</td>
            <td>Direccion</td>
            <td>Estrellas</td>
            <td>Telefono</td>
            <td>Detalles</td>
            <td>Acciones</td>
        </tr>
    </thead>
    <tbody>
    @foreach($hoteles as $hotel)
        <tr>
            <td>{{ $hotel->idHotel }}</td>
            <td>{{ $hotel->nombre }}</td>
            <td>{{ $hotel->ciudad->nombre }}</td>
            <td>{{ $hotel->direccion }}</td>
            <td>{{ $hotel->estrellas }}</td>
            <td>{{ $hotel->telefono }}</td>
            <td>{{ $hotel->detalles }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ route('hotel.show', $hotel->idHotel) }}">Ver este hotel</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ route('hotel.edit', $hotel->idHotel) }}">Editar este hotel</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@stop
