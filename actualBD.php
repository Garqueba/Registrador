<?php 
	require_once("consultaBD.php");
	$conectar = new consulta();
	$conexion = $conectar->conectarBD();
	$resultado=mysqli_query($conexion,"SELECT * FROM actual WHERE id=1");
	$res=mysqli_fetch_array($resultado);  
	$conectar->desconectarBD($conexion);
	$actual1=$res['producto'];
	echo $actual1; 
 ?>    