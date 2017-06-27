
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Tiempo Real</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link href="css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.js"></script>
        <style type="text/css">
${demo.css}
        </style>
        <script type="text/javascript">

    function TemperaturaProducto() {

        //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    

        var producto = $.ajax({

            url: 'actualBD.php',
                dataType: 'text',
                async: false    
        }).responseText;

         return +producto;
    }

    setInterval(TemperaturaProducto,500);

        </script>

        <script type="text/javascript">
$(function () {
    $(document).ready(function () {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        Highcharts.chart('container', {
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old I
                marginRight: 10,
                events: {
                    load: function () {

                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function () {
                            var x = (new Date()).getTime(), // current time
                                y = TemperaturaProducto()
                                   ;
                            series.addPoint([x, y], true, true);
                        }, 1000);
                    }
                }
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Temperatura °C'
                },

                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
                                    credits: {
            enabled: false
        },
            series: [{
                name: 'Pasteurizador',
                data: (function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -19; i <= 0; i += 1) {
                        data.push({
                            x: time + i * 1000,
                            y: TemperaturaProducto()
                        });
                    }
                    return data;
                }())
            }]
        });
    });
});
        </script>
    </head>
    <body>

<header><div class="container"><h1>Lácteos los Andes</h1></div></header>
<div class="container"><h2>Temperatura de Producto</h2>
<div class="container" id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<a class="btn btn-danger" href="index.php">Atrás <<</a>
</div>

    <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
    </body>
</html>