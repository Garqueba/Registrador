<?php 
	//Obtiene los datos de arduino y los almacena en la base de datos
	$producto = htmlspecialchars($_GET["valor1"],ENT_QUOTES);
	$agua = htmlspecialchars($_GET["valor2"],ENT_QUOTES);
	if (($producto!="") and ($agua!="")) {
		require_once("consultaBD.php");
	    $conectar = new consulta();
	    $conexion = $conectar->conectarBD();
		$registro=mysqli_query($conexion,"SELECT * FROM actual WHERE id=1" );
		if($reg=mysqli_fetch_array($registro)){
			mysqli_query($conexion,"UPDATE actual set fecha=NOW(), producto=$producto, agua=$agua WHERE 1" );
		}
		else{
			mysqli_query($conexion,"INSERT INTO actual(id,fecha,producto,agua) VALUES ('1',NOW(),'$producto','$agua')");
		}

		$conectar->desconectarBD($conexion);
	}
?>