@extends('adminlte::page')

@section('title', 'Importar Datos de Excel')

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
            <form action="{{ route('cargarExcel') }}" method="POST" enctype="multipart/form-data">
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
                            <th>Facultad</th>
                            <th>Carrera</th>
                            <th>Periodo</th>
                            <th>Localidad</th>
                            <th>Modalidad</th>
                            <th>Inscritos</th>
                            <th>Nuevos</th>
                            <th>Anteriores</th>
                            <th>Matriculados</th>
                            <th>Sin Nota</th>
                            <th>% Sin Nota</th>
                            <th>Aprobados</th>
                            <th>% Aprobados</th>
                            <th>Reprobados</th>
                            <th>% Reprobados</th>
                            <th>Reprobados con 0</th>
                            <th>% Reprobados con 0</th>
                            <th>Moras</th>
                            <th>% Moras</th>
                            <th>Retirados</th>
                            <th>PPA</th>
                            <th>PPS</th>
                            <th>PPA1</th>
                            <th>PPAC</th>
                            <th>Egresados</th>
                            <th>Titulados</th>
                            <th>Periodo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $row->FAC_NOMBRE_FACULTAD }}</td>
                                <td>{{ $row->CARRE_NOMBRE_CARRERA }}</td>
                                <td>{{ $row->PERIOD }}</td>
                                <td>{{ $row->LOCALIDAD }}</td>
                                <td>{{ $row->MODALIDAD_T }}</td>
                                <td>{{ $row->_INS }}</td>
                                <td>{{ $row->T_NUE }}</td>
                                <td>{{ $row->T_ANT }}</td>
                                <td>{{ $row->MAT_INS }}</td>
                                <td>{{ $row->SIN_NOT }}</td>
                                <td>{{ $row->{'%SNOT'} }}</td>
                                <td>{{ $row->APROBAD }}</td>
                                <td>{{ $row->{'%APRO'} }}</td>
                                <td>{{ $row->REPROBA }}</td>
                                <td>{{ $row->{'%REPR'} }}</td>
                                <td>{{ $row->R_CON_0 }}</td>
                                <td>{{ $row->{'%REP0'} }}</td>
                                <td>{{ $row->MORAS }}</td>
                                <td>{{ $row->{'%MORA'} }}</td>
                                <td>{{ $row->RETIR }}</td>
                                <td>{{ $row->PPA }}</td>
                                <td>{{ $row->PPS }}</td>
                                <td>{{ $row->PPA1 }}</td>
                                <td>{{ $row->PPAC }}</td>
                                <td>{{ $row->EGRE }}</td>
                                <td>{{ $row->TIT }}</td>
                                <td>{{ $row->Periodo }}</td>
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
