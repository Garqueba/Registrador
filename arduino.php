<?php 
	//Obtiene los datos de arduino y los almacena en la base de datos
	$producto = htmlspecialchars($_GET["valor1"],ENT_QUOTES);
	$agua = htmlspecialchars($_GET["valor2"],ENT_QUOTES);
	if (($producto!="") and ($agua!="")) {
		require_once("consultaBD.php");
	    $conectar = new consulta();
	    $conexion = $conectar->conectarBD();
	   	mysqli_query($conexion,"INSERT INTO pasteurizador(fecha,producto,agua) VALUES (NOW(),'$producto','$agua')");
	   	$conectar->desconectarBD($conexion);
	}
?>
