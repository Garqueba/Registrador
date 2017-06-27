<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link href="css/bootstrap.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery.js"></script>
	<style type="text/css">
.highcharts-yaxis-grid .highcharts-grid-line {
	display: none;
}
		</style>
                <script type="text/javascript">

    function TemperaturaAgua() {

        //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    

        var agua = $.ajax({

            url: 'actualBD2.php', //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
        }).responseText;

        //actualizamos el div que nos mostrará la hora actual
         return +agua;
    }
    function TemperaturaProducto() {

        //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    

        var producto = $.ajax({

            url: 'actualBD.php', //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
        }).responseText;

        //actualizamos el div que nos mostrará la hora actual
         return +producto;
    }

    //con esta funcion llamamos a la función getTimeAJAX cada segundo para actualizar el div que mostrará la hora
    setInterval(TemperaturaProducto,500);

        </script>
		<script type="text/javascript">
$(function () {

    var gaugeOptions = {

        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
            [0, '#00B2FF'], // white
            [0.25, '#00B2FF'], // white
            [0.61, '#2196F3'],//Blue
            [0.69, '#2196F3'],//Blue
            [0.70, '#55BF3B'], // green
            [0.75, '#55BF3B'], // green
            [0.751, '#DDDF0D'], // yellow
            [0.775, '#DDDF0D'], // yellow
            [0.8, '#DF5353'] // red
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };

    var chartProducto = Highcharts.chart('container-producto', Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 120,
            title: {
                text: 'Producto'
            }
        },

        credits: {
            enabled: false
        },

        series: [{
            name: 'Producto',
            data: [0],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                       '<span style="font-size:12px;color:red">°C</span></div>'
            },
            tooltip: {
                valueSuffix: ' °C'
            }
        }]

    }));

    var chartAgua = Highcharts.chart('container-agua', Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 120,
            title: {
                text: 'Agua Caliente'
            }
        },
                credits: {
            enabled: false
        },

        series: [{
            name: 'Agua Caliente',
            data: [1],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' +
                       '<span style="font-size:12px;color:red">°C</span></div>'
            },
            tooltip: {
                valueSuffix: ' °C'
            }
        }]

    }));


    setInterval(function () {

        var point,
            newVal,
            inc;

        if (chartProducto) {
            point = chartProducto.series[0].points[0];
            inc = TemperaturaProducto();
            newVal = inc;

            if (newVal < 0 || newVal > 120) {
                newVal = point.y - inc;
            }

            point.update(newVal);
        }


        if (chartAgua) {
            point = chartAgua.series[0].points[0];
            inc = TemperaturaAgua();
            newVal = inc;

            if (newVal < 0 || newVal > 120) {
                newVal = point.y - inc;
            }

            point.update(newVal);
        }
    }, 500);


});

		</script>
  </head>


  <body Style="background-color: #212121"> 
    <div  class="container" style="background-color: #FFFFFF">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-default navbar-inverse" role="navigation">
						<div class="navbar-header">
							 
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
							</button> <a class="navbar-brand" href="#" style="color: #FFFFFF">INICIO </a>
						</div>
						
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li>
									<a href="consulta.php" style="color: #FFFFFF">Consultar Fecha</a>
								</li>
								<li>
									<a href="Producto.php" style="color: #FFFFFF">Temperatura del Producto</a>
								</li>
								<li>
									<a href="agua.php" style="color: #FFFFFF">Temperatura del Agua</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<img width="280" height="100" alt="Logo" src="logo.png">
				</div>
				<div class="col-md-9">
					<div class="page-header">
						<h1 style="padding-left: 40px;font-size: 50px">¡Bienvenidos!</h1>
					</div>
				</div>
			</div>

			<div class="row" class="col-md-4">
					<script src="js/highcharts.js"></script>
					<script src="js/highcharts-more.js"></script>
					<script src="js/solid-gauge.js"></script>


                        <div class="col-md-4" style="float: center; width:300px; height: 200px">
                        <table style="color: #212121; font-family: helvetica,arial,sans-serif; font-size: medium; font-weight: bold">
                        <caption style="color: #212121">Leyenda</caption>

                            <tr>
                                <td style="background-color: #2196F3"> </td>
                                <td style="padding-left: 10px">Punto inferior de operación</td>
                            </tr>
                            <tr>
                                <td style="background-color: #55BF3B"></td>
                                <td style="padding-left: 10px">Punto de operación</td>
                            </tr>
                            <tr>
                                <td style="background-color:#DDDF0D"></td>
                                <td style="padding-left: 10px">Advertencia</td>
                            </tr>     
                            <tr>
                                <td style="color: #DF5353; background-color:#DF5353">color</td>
                                <td style="padding-left: 10px">Alerta</td>
                            </tr>
                        </table>
                        </div>

                        <div class="col-md-4" id="container-producto" style="width: 300px; height: 200px; float: center"></div>
                    
                        <div class="col-md-4" id="container-agua" style="width: 300px; height: 200px; float: center"></div>

			</div>
			
	

			<div class="row">
				<div class="col-md-4">
					<h2>
					Consultar fecha
					</h2>
					<p>
						Esta opción permite al usuario seleccionar el calendario y consultar el día de forma práctica para observar la gráfica de Tiempo vs Temperatura de la salida del producto y el agua que pasa por el intercambiador de calor
					</p>
					<p>
						<a class="btn btn-danger" href="consulta.php">Consultar »</a>
					</p>
				</div>
				<div class="col-md-4">
					<h2>
						Monitor de temperatura del producto
					</h2>
					<p>
						Genera una gráfica de Tiempo vs Temperatura a tiempo real, el cual permite observar las variaciones de temperatura en el mismo instante que se consulta
					</p>
					<p>
						<a class="btn btn-primary" href="Producto.php">Consultar »</a>
					</p>
				</div>
				<div class="col-md-4">
					<h2>
						Monitor de temperatura del Agua Caliente
					</h2>
					<p>
						Genera una gráfica de Tiempo vs Temperatura a tiempo real, el cual permite observar las variaciones de temperatura en el mismo instante que se consulta
					</p>
					<p>
						<a class="btn btn-success" href="agua.php">Consultar »</a>
					</p>
				</div>
                <footer><div class="container">Pagina elaborada por el <strong>Ing. Gabriel Querales</strong></div></footer> 
			</div>
		</div>
	</div>
</div>


    <script src="js/scripts.js"></script>
  </body>
</html>