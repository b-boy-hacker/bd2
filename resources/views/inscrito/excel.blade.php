@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Importar Datos de Excel</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de Importación -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Importar Archivo Excel</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('importar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="archivo">Selecciona el archivo Excel</label>
                    <input type="file" name="archivo" id="archivo" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Importar</button>
            </form>
        </div>
    </div>

    <!-- Mostrar los datos en una tabla -->
    @if($data->isNotEmpty())
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Datos Importados</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>FACULTAD</th>
                            <th>_INS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $row->FACULTAD }}</td>
                                <td>{{ $row->_INS }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p>No hay datos para mostrar.</p>
    @endif
@stop

@section('css')
    <!-- Agregar estilo personalizado si lo deseas -->
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Página cargada correctamente.');
    </script>
@stop
