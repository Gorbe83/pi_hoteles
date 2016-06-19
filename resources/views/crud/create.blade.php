@extends('crud.master')

@section('content')

<h1>Crear un nuevo Hotel</h1>

<!-- if there are creation errors, they will show here -->
@foreach ($errors as $error)
    <p class="alert alert-danger">{{ $error }}</p>
@endforeach

{!! Form::open([
    'route' => 'hotel.store'
]) !!}

    <div class="form-group">
        {{ Form::label('nombre', 'Nombre') }}
        {{ Form::text('nombre', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('estrellas', 'Estrellas') }}
        {{ Form::radio('estrellas', '1', array('class' => 'form-control')) }}1
        {{ Form::radio('estrellas', '2', array('class' => 'form-control')) }}2
        {{ Form::radio('estrellas', '3', array('class' => 'form-control')) }}3
        {{ Form::radio('estrellas', '4', array('class' => 'form-control')) }}4
        {{ Form::radio('estrellas', '5', array('class' => 'form-control')) }}5
    </div>

    <div class="form-group">
        {!! Form::Label('ciudad', 'Ciudad') !!}
        {!! Form::select('ciudad', $ciudades, null, array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {{ Form::label('direccion', 'Direccion') }}
        {{ Form::text('direccion', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('telefono', 'Telefono') }}
        {{ Form::text('telefono', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('detalles', 'Detalles') }}
        {{ Form::text('detalles', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Guardar nuevo hotel', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@endsection
