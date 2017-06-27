<?php 
	require_once("consultaBD.php");
	$conectar = new consulta();
	$conexion = $conectar->conectarBD();
	$resultado=mysqli_query($conexion,"SELECT * FROM actual WHERE id=1");
	$res=mysqli_fetch_array($resultado);  
	$conectar->desconectarBD($conexion);
	$actual2=$res['agua'];
	echo $actual2; 
 ?>    