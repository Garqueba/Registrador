<?php 
//Obtiene los datos de arduino y los almacena en la base de datos
$year = htmlspecialchars($_GET["yy"],ENT_QUOTES);
$month = htmlspecialchars($_GET["mm"],ENT_QUOTES);
$day = htmlspecialchars($_GET["dd"],ENT_QUOTES);
$hora = htmlspecialchars($_GET["h"],ENT_QUOTES);
$minuto = htmlspecialchars($_GET["m"],ENT_QUOTES);
$segundo = htmlspecialchars($_GET["s"],ENT_QUOTES);
$producto = htmlspecialchars($_GET["pro"],ENT_QUOTES);
$agua = htmlspecialchars($_GET["ag"],ENT_QUOTES);

if (($producto!="") and ($agua!="")) {
	require_once("consultaBD.php");
    $conectar = new consulta();
    $conexion = $conectar->conectarBD();
	
	if (($producto!="") and ($agua!="")) {
    	mysqli_query($conexion,"INSERT INTO pasteurizador(fecha,producto,agua) VALUES ('$year-$month-$day $hora:$minuto:$segundo','$producto','$agua')");
	}

	 $conectar->desconectarBD($conexion);

}