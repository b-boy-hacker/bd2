@extends('adminlte::page')

@section('title', 'Rendimiento Académico por Facultad')

@section('content_header')
    <h1>Rendimiento Académico por Facultad</h1>
@stop

@section('content')
    <!-- Gráfico -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Gráfico de Rendimiento Académico por Facultad</h3>
        </div>
        <div class="card-body">
            <div id="chartdiv"></div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Facultades con Rendimiento Académico</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Facultad</th>
                        <th>Total Deserción (%)</th>
                        <th>Total Aprobación (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rendimiento as $facultad)
                        <tr>
                            <td>{{ $facultad->FAC_NOMBRE_FACULTAD }}</td>
                            <td>{{ $facultad->total_desercion }}%</td>
                            <td>{{ $facultad->total_aprobacion }}%</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay datos disponibles</td>
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
                valueYField: "total_desercion",
                categoryXField: "FAC_NOMBRE_FACULTAD",
                tooltip: am5.Tooltip.new(root, { labelText: "{valueY}%" })
            }));

            var series2 = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Aprobación",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "total_aprobacion",
                categoryXField: "FAC_NOMBRE_FACULTAD",
                tooltip: am5.Tooltip.new(root, { labelText: "{valueY}%" })
            }));

            series.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5
            });

            series2.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5
            });

            // Set data dynamically from backend
            var data = @json($rendimiento);
            xAxis.data.setAll(data);
            series.data.setAll(data);
            series2.data.setAll(data);

            series.appear(1000);
            series2.appear(1000);
            chart.appear(1000, 100);
        });
    </script>
@stop
