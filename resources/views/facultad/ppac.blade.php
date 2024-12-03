@extends('adminlte::page')

@section('title', 'Promedio Ponderado Acumulado (PPAC) por Facultad')

@section('content_header')
    <h1>Promedio Ponderado Acumulado (PPAC) por Facultad</h1>
@stop

@section('content')
    <!-- Gráfico -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Gráfico de Promedio Ponderado Acumulado (PPAC) por Facultad</h3>
        </div>
        <div class="card-body">
            <div id="chartdiv"></div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Promedio Ponderado Acumulado por Facultad</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Facultad</th>
                        <th>Promedio PPAC</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ppac as $facultad)
                        <tr>
                            <td>{{ $facultad->FAC_NOMBRE_FACULTAD }}</td>
                            <td>{{ number_format($facultad->promedio_ppac, 2) }}</td>
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
            // Create root element
            var root = am5.Root.new("chartdiv");

            // Set themes
            root.setThemes([am5themes_Animated.new(root)]);

            // Create chart
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0,
                paddingRight: 1
            }));

            // Add cursor
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);

            // Create axes
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
                maxDeviation: 0.3,
                categoryField: "facultad",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: am5xy.AxisRendererY.new(root, { strokeOpacity: 0.1 })
            }));

            // Create series
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Promedio PPAC",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "promedio_ppac",
                categoryXField: "facultad",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5,
                strokeOpacity: 0
            });

            // Colores personalizados para las barras
            series.columns.template.adapters.add("fill", function(fill, target) {
                const index = series.columns.indexOf(target);
                const colors = ["#ff5733", "#33c1ff", "#7aff33", "#ff33a8", "#f2ff33", "#33ff57"];
                return colors[index % colors.length];  // Ciclar los colores
            });

            // Set data
            var data = @json($ppac->map(function ($item) {
                return [
                    'facultad' => $item->FAC_NOMBRE_FACULTAD,
                    'promedio_ppac' => $item->promedio_ppac
                ];
            }));

            xAxis.data.setAll(data);
            series.data.setAll(data);

            // Animar los elementos cuando carguen
            series.appear(1000);
            chart.appear(1000, 100);
        });
    </script>
@stop
