<!DOCTYPE HTML>
<html>
	<head>
    	<meta charset="utf-8"> 
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script src="js/highstock.js"></script>
        <script src="js/exporting.js"></script>
        <script type="text/javascript">
            jQuery(function($){
                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '&#x3c;Ant',
                    nextText: 'Sig&#x3e;',
                    currentText: 'Hoy',
                    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
                    'Jul','Ago','Sep','Oct','Nov','Dic'],
                    dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
                    dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
                    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                    weekHeader: 'Sm',
                    dateFormat: 'yy-mm-dd',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['es']);
            });    

            $(document).ready(function() {
               $("#datepicker").datepicker();
             });
        </script>
    </head>
  <body style="background-color: #212121"> 
    <div  class="container" style="background-color: #FFFFFF">
    <div class="row">
        <div class="col-md-12">


            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-default navbar-inverse" role="navigation">
                        <div class="navbar-header">
                             
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                            </button> <a class="navbar-brand" href="#" style="color: #FFFFFF">Lácteos Los Andes </a>
                        </div>
                    </nav>
                </div>
            </div>

<div class="container"><h1>Consulta</h1></div>
<form class="container" method="POST" action="consulta.php">
  <label> Seleccionar Fecha:</label>
  <input type="text" id="datepicker" name="fecha" readonly="readonly" size="12" />
  <input type="submit" class="btn btn-primary btn-sm" value="Consultar" name="boton" readonly="readonly" size="12" />
</form>
<?php
if(isset($_POST['boton'])){
    require_once("consultaBD.php");
    $rand = new consulta();
    //obtenemos toda la información de la tabla
    $rawdata = $rand->getAllInfo();
    //nos creamos dos arrays para almacenar el tiempo y el valor numérico
    $productoArray;
    $aguaArray;
    $timeArray;
    //en un bucle for obtenemos en cada iteración el valor númerico y 
    //el TIMESTAMP del tiempo y lo almacenamos en los arrays 
    for($i = 0 ;$i<count($rawdata);$i++){
        $aguaArray[$i]= $rawdata[$i][3];
        $productoArray[$i]= $rawdata[$i][2];
        //OBTENEMOS EL TIMESTAMP
        $time= $rawdata[$i][1];
        $date = new DateTime($time);
        //ALMACENAMOS EL TIMESTAMP EN EL ARRAY
        $timeArray[$i] = $date->getTimestamp()*1000;
    }
}
?>
<div id="contenedor"></div>
<div class="container">
<script>

    chartCPU = new Highcharts.StockChart({
        chart: {
            renderTo: 'contenedor'
            //defaultSeriesType: 'spline'

        },

        title: {
            text: 'Línea de envasado UHT',
      		style: {
      			color: '#CC0000',
                fontWeight: 'bold',
                fontSize: "22px"
            }
        },
        subtitle: {
            text: 'Temperatura del pasteurizador',
      		style: {
      			color: '#222',
                fontWeight: 'bold',
                fontSize: "16px"
            }
        },
        scrollbar: {
            barBackgroundColor: '#2c3e50',
            barBorderRadius: 7,
            barBorderWidth: 0,
            buttonBackgroundColor: '#2c3e50',
            buttonBorderWidth: 0,
            buttonBorderRadius: 7,
            trackBackgroundColor: 'none',
            trackBorderWidth: 1,
            trackBorderRadius: 8,
            trackBorderColor: '#CCC'
         },
        xAxis: {
            type: 'datetime'
            //tickPixelInterval: 150,
            //maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Temperatura °C',
                margin: 10,
                style: {
              		color: '#CC0000',
                    fontWeight: 'bold',
                    fontSize: "22px"
                }
            },
            plotBands: [{
                from: 85,
                to: 90,
                color: 'rgba(68, 170, 213, 0.2)',
                label: {
                text: 'Rango de temperatura'
                }
            }]
        },
        legend:{
            enabled: true,
            borderRadius: 10,

        },
        rangeSelector: {
    	    buttonTheme: { // styles for the buttons
                fill: 'none',
                stroke: 'none',
                'stroke-width': 0,
                r: 8,
                style: {
                    color: '#2c3e50',
                    fontWeight: 'bold'
                },
                states: {
                    hover: {
                    },
                    select: {
                        fill: '#2c3e50',
                        style: {
                            color: 'white'
                        }
                    }
                                        // disabled: { ... }
                }
            },
            buttons: [{
                type: 'hour',
                count: 1,
                text: '1h'
            },  {
                    type: 'hour',
                    count: 4,
                    text: '4h'
            },  {
                    type: 'hour',
                    count: 8,
                    text: '8h'
            },  {
                        type: 'all',
                        count: 24,
                        text: 'All'
                    }],

                    selected: 1,

                    inputStyle: {
                        color: '#2c3e50',
                        fontWeight: 'bold'
                    },
                    inputEnabled: false
        },
        series: [{
            name: 'Producto',
            type: 'spline',
            dataLabels:{
            	enabled:false
            },
            data: (function() {
                    // generate an array of random data
                    var data = [];
                    <?php
                        for($i = 0 ;$i<count($rawdata);$i++){
                    ?>
                    data.push([<?php echo $timeArray[$i];?>,<?php echo $productoArray[$i];?>]);
                    <?php } ?>
                    return data;
            })()
        },  {
                name: 'Agua',
                type: 'spline',
                dataLabels:{
                	enabled:false
                },
                data: (function() {
                        // generate an array of random data
                        var data = [];
                        <?php
                            for($i = 0 ;$i<count($rawdata);$i++){
                        ?>
                        data.push([<?php echo $timeArray[$i];?>,<?php echo $aguaArray[$i];?>]);
                        <?php } ?>
                        return data;
                    })()
        }],



        credits: {
                enabled: false
        }
    });

</script>
<a class="btn btn-danger" href="index.php">Atrás <<</a>
</div>
    <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.min.js"></script>
             </div>
    </div>
</div>
	</body>
</html>