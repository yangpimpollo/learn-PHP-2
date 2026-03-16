<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Learnphp2\Mat1\OperacionFactory;

// Imagina que esto viene de un formulario o una URL
$tipo = 'suma'; 

$operacion = OperacionFactory::crear($tipo);
echo $operacion->calcular(); // Imprime: Calculando una suma...


?>