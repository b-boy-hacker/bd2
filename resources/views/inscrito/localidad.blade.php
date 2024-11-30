@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Estudiantes Inscritos por Localidad</h1>
@stop

@section('content')
    <!-- Contenedor del gráfico -->
    <div id="chartdiv"></div>

    <!-- Chart code -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <script>
    am5.ready(function() {
        // Crear el elemento root
        var root = am5.Root.new("chartdiv");

        // Establecer temas
        root.setThemes([am5themes_Animated.new(root)]);

        // Crear gráfico
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true,
            paddingLeft: 0,
            paddingRight: 1
        }));

        // Agregar cursor
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);

        // Crear ejes
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

        xRenderer.grid.template.setAll({
            location: 1
        });

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0.3,
            categoryField: "country",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
        }));

        var yRenderer = am5xy.AxisRendererY.new(root, {
            strokeOpacity: 0.1
        });

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0.3,
            renderer: yRenderer
        }));

        // Crear serie
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: "Inscritos",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            sequencedInterpolation: true,
            categoryXField: "country",
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
            })
        }));

        series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
        series.columns.template.adapters.add("fill", function (fill, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function (stroke, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        // Convertir los datos de PHP a formato JavaScript
        var data = @json($data);

        // Establecer los datos para el gráfico
        xAxis.data.setAll(data);
        series.data.setAll(data);

        // Animar el gráfico
        series.appear(1000);
        chart.appear(1000, 100);
    }); // end am5.ready()
    </script>

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
    <!-- Scripts de amCharts -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
@stop
