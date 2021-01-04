<?php
    
function listarProductos(){	
	try { 	
		$db = Conexion::getConexion();
		$stmt = $db->prepare("select * from producto");
		$stmt->execute();
		$filas = $stmt->fetchAll(PDO::FETCH_ASSOC);			
		$arreglo = array();
		foreach($filas as $fila) {			
		    $elemento = array();
			$elemento['idProducto'] = $fila['id_producto'];
			$elemento['nombre'] = $fila['nombre'];
			$elemento['descripcion'] = $fila['descripcion'];
			$elemento['precio'] = $fila['precio'];
			$elemento['stock'] = $fila['stock'];
			$elemento['importancia'] = $fila['importancia'];
			$elemento['imagen'] = $fila['imagen'];
			$elemento['id_categoria'] = $fila['id_categoria'];
			$arreglo[] = $elemento;
		}
		return $arreglo;
		
	} catch (PDOException $e) {
		$db->rollback();
		$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
		die($mensaje);
	}		
}

function buscarProductosPorNombre($nombre){	
	try { 	
		$db = Conexion::getConexion();
		$stmt = $db->prepare("select * from producto where nombre like ?");
		$stmt->bindValue(1, "%$nombre%", PDO::PARAM_STR);

		$stmt->execute();
		$filas = $stmt->fetchAll(PDO::FETCH_ASSOC);		
		$arreglo = array();
		foreach($filas as $fila) {			
			$elemento = array();
			$elemento['idProducto'] = $fila['id_producto'];
			$elemento['nombre'] = $fila['nombre'];
			$elemento['descripcion'] = $fila['descripcion'];
			$elemento['precio'] = $fila['precio'];
			$elemento['stock'] = $fila['stock'];
			$elemento['importancia'] = $fila['importancia'];
			$elemento['imagen'] = $fila['imagen'];
			$elemento['id_categoria'] = $fila['id_categoria'];
			$arreglo[] = $elemento;
		}
		return $arreglo;
		
	} catch (PDOException $e) {
		$db->rollback();
		$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
		die($mensaje);
	}		
}

function insertarProducto($nombre, $descripcion, $precio, $stock, $importancia, $imagen, $idCategoria){
	try { 
		$db = Conexion::getConexion();			
		$stmt = $db->prepare("insert into producto (nombre, descripcion, precio, stock, importancia, imagen, id_categoria) values (?,?,?,?,?,?,?)");
		$datos = array($nombre, $descripcion, $precio,
					   $stock, $importancia, $imagen,
					   $idCategoria);
		$db->beginTransaction();
		$stmt->execute($datos);
		$db->commit();
	} catch (PDOException $e) {
		$db->rollback();
		$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
		die($mensaje);
	}		
}

function actualizarProducto($nombre, $descripcion, $precio, $stock, $importancia, $imagen, $idCategoria, $idProducto){
	try { 
		$db = Conexion::getConexion();		
		$stmt = $db->prepare("update producto set nombre=?, descripcion=?, precio=?, stock=?, importancia=?, imagen=?, id_categoria=? where id_producto=?");
		$datos = array($nombre, $descripcion, $precio, $stock, $importancia, $imagen, $idCategoria, $idProducto);
		$db->beginTransaction();						
		$stmt->execute($datos);			
		$db->commit();
	} catch (PDOException $e) {
		$db->rollback();
		$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
		die($mensaje);
	}	
}

function eliminarProducto($id){
	try { 
		$db = Conexion::getConexion();  
		$stmt = $db->prepare("delete from producto where id_producto=?");
		$datos = array($id);
		$db->beginTransaction();			
		$stmt->execute($datos);			
		$db->commit();
	} catch (PDOException $e) {
		$db->rollback();
		$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
		die($mensaje);
	}	
}


function listarAvisos(){	
	try { 	
		$db = Conexion::getConexion();
		$stmt = $db->prepare("select * from aviso");
		$stmt->execute();
		$filas = $stmt->fetchAll(PDO::FETCH_ASSOC);			
		$arreglo = array();
		foreach($filas as $fila) {			
		    $elemento = array();
			$elemento['id_aviso'] = $fila['id_aviso'];
			$elemento['titulo'] = $fila['titulo'];
			$elemento['fecha_inicio'] = $fila['fecha_inicio'];
			$elemento['fecha_fin'] = $fila['fecha_fin'];
			$elemento['estado'] = $fila['estado'];
			$elemento['id_usuario'] = $fila['id_usuario'];
			
			$arreglo[] = $elemento;
		}
		return $arreglo;
		
	} catch (PDOException $e) {
		$db->rollback();
		$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
		die($mensaje);
	}		
}

function buscarAvisos($fecha){	
	try { 	
		$db = Conexion::getConexion();
		$stmt = $db->prepare("select * from aviso where ? between fecha_inicio and fecha_fin");
		$stmt->bindValue(1, $fecha, PDO::PARAM_STR);

		$stmt->execute();
		$filas = $stmt->fetchAll(PDO::FETCH_ASSOC);		
		$arreglo = array();
		foreach($filas as $fila) {			
			$elemento = array();
			$elemento['titulo'] = $fila['titulo'];
			$elemento['fecha_inicio'] = $fila['fecha_inicio'];
			$elemento['fecha_fin'] = $fila['fecha_fin'];
			$elemento['estado'] = $fila['estado'];
                        $arreglo[] = $elemento;
		}
		return $arreglo;
		
	} catch (PDOException $e) {
		$db->rollback();
		$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
		die($mensaje);
	}		
}


function insertarAviso($titulo, $fecha_inicio, $fecha_fin){
	try { 
		$db = Conexion::getConexion();			
		$stmt = $db->prepare("insert into aviso (titulo,fecha_inicio,fecha_fin,estado) values (?,?,?,'1')");
		$datos = array($titulo, $fecha_inicio, $fecha_fin);
		$db->beginTransaction();
		$stmt->execute($datos);
		$db->commit();
	} catch (PDOException $e) {
		$db->rollback();
		$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
		die($mensaje);
	}		
}

?>