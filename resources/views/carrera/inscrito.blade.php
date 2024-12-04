@extends('adminlte::page')

@section('title', 'Estudiantes por Carrera')

@section('content_header')
    <h1>Estudiantes Inscritos por Carrera</h1>
@stop

@section('content')
    <div class="row">
        <!-- Gráfico -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gráfico de Inscritos por Carrera</h3>
                </div>
                <div class="card-body">
                    <div id="chartdiv"></div>
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Listado de Carreras</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Carrera</th>
                                <th>Total Inscritos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($carreras as $carrera)
                                <tr>
                                    <td>{{ $carrera->CARRE_NOMBRE_CARRERA }}</td>
                                    <td>{{ $carrera->total_inscritos }}</td>
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

            // Add cursor
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);
            
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
                categoryField: "CARRE_NOMBRE_CARRERA",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, { strokeOpacity: 0.1 })
            }));

            // Crear la serie de barras
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Inscritos",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "total_inscritos",
                categoryXField: "CARRE_NOMBRE_CARRERA",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}%"
                })
            }));

            series.columns.template.adapters.add("fill", function(fill, target) {
                const index = series.columns.indexOf(target);
                const colors = ["#ff5733", "#33c1ff", "#7aff33", "#ff33a8", "#f2ff33", "#33ff57"];
                return colors[index % colors.length];
            });

            // Set de los datos dinámicos
            var data = @json($carreras->map(function ($item) {
                return [
                    'CARRE_NOMBRE_CARRERA' => $item->CARRE_NOMBRE_CARRERA,
                    'total_inscritos' => floatval($item->total_inscritos),
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


{{-- ------------------------------------- --}}
{{-- 
@extends('adminlte::page')

@section('title', 'Estudiantes por Carrera')

@section('content_header')
    <h1>Estudiantes Inscritos por Carrera</h1>
@stop

@section('content')
    <!-- Gráfico -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Gráfico de Inscritos por Carrera</h3>
        </div>
        <div class="card-body">
            <div id="chartdiv"></div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Carreras</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Carrera</th>
                        <th>Total Inscritos</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($carreras as $carrera)
                        <tr>
                            <td>{{ $carrera->CARRE_NOMBRE_CARRERA }}</td>
                            <td>{{ $carrera->total_inscritos }}</td>
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
                categoryField: "CARRE_NOMBRE_CARRERA",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));

            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Inscritos",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "total_inscritos",
                categoryXField: "CARRE_NOMBRE_CARRERA",
                tooltip: am5.Tooltip.new(root, { labelText: "{valueY}" })
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
            var data = @json($carreras);
            xAxis.data.setAll(data);
            series.data.setAll(data);

            series.appear(1000);
            chart.appear(1000, 100);
        });
    </script>
@stop --}}
