<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Tiempo Real</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link href="css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.js"></script>
        <style type="text/css">
        </style>
        <script type="text/javascript">

    function TemperaturaAgua() {

        //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    

        var agua = $.ajax({

            url: 'actualBD2.php', 
                dataType: 'text',
                async: false     
        }).responseText;

         return +agua;
    }

    setInterval(TemperaturaAgua,500);

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
                                y = TemperaturaAgua()
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
                    color: '#212121'
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
                enabled: true
            },
            credits: {
            enabled: false
        },
            series: [{
                name: 'Agua',
                data: (function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -19; i <= 0; i += 1) {
                        data.push({
                            x: time + i * 1000,
                            y: TemperaturaAgua()
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
<div class="container"><h2>Temperatura de agua caliente</h2>
<div class="container" id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<a class="btn btn-danger" href="index.php">Atrás <<</a>
</div>

    <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
    </body>
</html>