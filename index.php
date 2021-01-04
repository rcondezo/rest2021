<?php
require_once './lib/Slim/Slim.php';
require_once 'funciones.php';
require_once 'Conexion.php';

// Autocarga de la librería
\Slim\Slim::registerAutoloader();

// Creando una instancia del Slim
$app = new \Slim\Slim();
$app->response->header('Content-Type', 'application/json');

// Servicio 1
$app->get('/productos', function(){  
    $lista = listarProductos();    
    echo json_encode($lista);    
});

// Servicio 2
$app->get('/productos/:nombre', function($nombre){   
    $lista = buscarProductosPorNombre($nombre);    
    echo json_encode($lista);    
});

// Servicio 3
$app->post('/productos', function () use ($app) {    
   $nombre = $app->request()->post('nombre');
   $precio = $app->request()->post('precio');   
   insertarProducto($nombre, '', $precio, 0, 0, '', 1);   
   echo json_encode(array('mensaje' => "Producto registrado satisfactoriamente"));    
});


// Servicio 4
$app->get('/avisos', function(){  
    $lista = listarAvisos();    
    echo json_encode($lista);    
});


// Servicio 5
$app->get('/avisos/:fecha', function($fecha){  
    $lista = buscarAvisos($fecha);    
    echo json_encode($lista);    
});


// Servicio 6
$app->post('/avisos', function() use ($app){     
   /*
   $request = $app->request();
   $body = $request->getBody();
   $data = json_decode($body);       
   insertarAviso($data->titulo, $data->fecha_inicio, $data->fecha_fin);
   */
   $titulo = $app->request()->post('titulo');
   $fecha_inicio = $app->request()->post('fecha_inicio');
   $fecha_fin = $app->request()->post('fecha_fin');
   insertarAviso($titulo, $fecha_inicio, $fecha_fin);
   echo json_encode(array('mensaje' => "Aviso registrado!"));    
});


$app->run();