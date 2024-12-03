@extends('adminlte::page')

@section('title', 'Porcentaje de Deserción por Facultad')

@section('content_header')
    <h1>Porcentaje de Deserción por Facultad</h1>
@stop

@section('content')
    <!-- Gráfico de deserción -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Gráfico de Deserción por Facultad</h3>
        </div>
        <div class="card-body">
            <div id="chartdiv"></div>
        </div>
    </div>

    <!-- Tabla de deserción -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Deserción por Facultad</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Facultad</th>
                        <th>Porcentaje de Deserción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($desertados as $facultad)
                        <tr>
                            <td>{{ $facultad->FAC_NOMBRE_FACULTAD }}</td>
                            <td>{{ number_format($facultad->porcentaje_desercion, 2) }}%</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">No hay datos disponibles</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>
@stop

@section('js')
    <!-- Scripts para amCharts -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <script>
        am5.ready(function() {
            // Crear el contenedor del gráfico
            var root = am5.Root.new("chartdiv");

            // Establecer temas
            root.setThemes([am5themes_Animated.new(root)]);

            // Crear el gráfico XY
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0,
                paddingRight: 1
            }));

            // Crear los ejes
            var xRenderer = am5xy.AxisRendererX.new(root, { 
                minGridDistance: 30,
                minorGridEnabled: true
            });

            xRenderer.labels.template.setAll({
                rotation: -90,
                centerY: am5.p50,
                centerX: am5.p100,
                paddingRight: 15
            });

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "facultad",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, { strokeOpacity: 0.1 })
            }));

            // Crear la serie de barras
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Deserción",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "porcentaje_desercion",
                categoryXField: "facultad",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}%"
                })
            }));

            series.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5,
                strokeOpacity: 0
            });

            // Set de los datos dinámicos
            var data = @json($desertados->map(function ($item) {
                return [
                    'facultad' => $item->FAC_NOMBRE_FACULTAD,
                    'porcentaje_desercion' => floatval($item->porcentaje_desercion),
                ];
            }));

            // Asignar los datos a los ejes
            xAxis.data.setAll(data);
            series.data.setAll(data);

            // Animar el gráfico
            series.appear(1000);
            chart.appear(1000, 100);
        });
    </script>
@stop

{{-- ------------------------------------------------------ --}}
{{-- @extends('adminlte::page')

@section('title', 'Deserción por Facultad')

@section('content_header')
    <h1>Deserción por Facultad</h1>
@stop

@section('content')
    <!-- Gráfico -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Gráfico de Deserción por Facultad</h3>
        </div>
        <div class="card-body">
            <div id="chartdiv"></div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Facultades y Porcentaje de Deserción</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Facultad</th>
                        <th>Porcentaje de Deserción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($desertados as $facultad)
                        <tr>
                            <td>{{ $facultad->FAC_NOMBRE_FACULTAD }}</td>
                            <td>{{ $facultad->porcentaje_desercion }}%</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">No hay datos disponibles</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>
@stop

@section('js')
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
        am5.ready(function() {
            var root = am5.Root.new("chartdiv");
            root.setThemes([am5themes_Animated.new(root)]);

            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true
            }));

            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);

            var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
            xRenderer.labels.template.setAll({
                rotation: -45,
                centerY: am5.p50,
                centerX: am5.p100
            });

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "FAC_NOMBRE_FACULTAD",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));

            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Deserción",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "porcentaje_desercion",
                categoryXField: "FAC_NOMBRE_FACULTAD",
                tooltip: am5.Tooltip.new(root, { labelText: "{valueY}%" })
            }));

            series.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5
            });

            series.columns.template.adapters.add("fill", function(fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function(stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            // Set data dynamically from backend
            var data = @json($desertados);
            xAxis.data.setAll(data);
            series.data.setAll(data);

            series.appear(1000);
            chart.appear(1000, 100);
        });
    </script>
@stop --}}
