# NOTAS DE APRENDIZAJE 1 PHP 🚀

Resumen de **fundamentos de  PHP**. 

para la terminal 🥲
```linux
cd carpeta1
code .
php -S localhost:8000
php -S localhost:8000 -t public

cd - Moverse entre directorios
ls - Listar archivos
rm - Eliminar archivos o directorios
mv - Mover o renombrar archivos o directorios
mkdir - Para crear carpetas
sudo - elevar permisos
sudo su - cambiar al usuario Root
clear - Limpiar la terminal
```

## 0. Nociones Basicas

* comentarios

```php
// de una linea
#  de una linea
/*  multilinea */
```
* variables         

```php
// (siempre con un $)
<?php
$nombre = "John";
$edad = 24;
$peso = 85.3;
$soltero = false;
$estado = ($soltero)? "soltero" : "casado";   // "shorthand" operador ternario

var_dump($soltero);   //tipo de dato

echo "$nombre de edad: $edad con peso de $peso Kg es $estado";
?>
```
> John de edad: 24 con peso de 85.3 Kg es casado                                        
> bool(false)

* impresion
```php
echo "Hello";     /* cualquier es valido */      echo("Hello");
echo "<h2>PHP is Fun!</h2>";     // etiquetas html
echo "Hola"." ".$nombre." "."como estas";    // concatenar con punto (.)
```


* Conversión de datos
```php
$value1 = 3.14;

$value2 = (int) $value1;
$value3 = (string) $value1;
```


* Condicionales
```php
if (condition) { } else { }
if (condition) { } elseif(condition) { }else {}
if (condition) ...;
   (condition)? true  false;
```

* Switch case
```php
$favcolor = "red";

switch ($favcolor) {
  case "red":
    echo "Your favorite color is red!";
    break;
  case "blue":
    echo "Your favorite color is blue!";
    break;
  case "green":
    echo "Your favorite color is green!";
    break;
  default:
    echo "Your favorite color is neither red, blue, nor green!";
}
```
> Your favorite color is red!

* Bucles

while, do while, for, foreach

```php
$i = 1;  
while ($i < 6) {  
  echo $i;  
  $i++;  }

//  continue; saltarse el ciclo actual
//  break; cerrar ciclo 
```
> 12345 

```php
$i = 7;
do {
  echo $i;
  $i++;
} while ($i < 6);

//  ejecuta al menos 1 vez
```

```php
for ($x = 0; $x <= 10; $x++) {
  echo "The number is: $x <br>";
}
```

```php
$colors = array("red", "green", "blue", "yellow");

foreach ($colors as $value) {
  echo "$value <br>";
}

```

* Funciones
```php
function functionName($parameter1, $parameter2) {
  // code to be executed
  return $value; // optional
}

// se puede iniciar parametro predeterminado $parameter1=50
// se puede argumentos de referencia (&$value)
```

* Arrays
```php
$cars = array("Volvo", "BMW", "Toyota");      // se pude contar      echo count($cars);
$cars = ["Volvo", "BMW", "Toyota"];

$myArr = array("Volvo", 15, ["apples", "bananas"]);      //tipo de datos diferentes
echo $cars[0];     // acceso

$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
echo $car["model"];     // array asosiados

// aumentar elementos
$fruits = array("Apple", "Banana", "Cherry");
$fruits[] = "Orange";

$cars = array("brand" => "Ford", "model" => "Mustang");
$cars["color"] = "Red";
```





* codigo final

```php
<!DOCTYPE html>
<html>
<body>
 
<?php
$nombre = "John";
$edad = 24;
$peso = 85.3;
$soltero = false;
$estado = ($soltero)? "soltero" : "casado";

// echo "$nombre de edad: $edad con peso de $peso Kg es $estado";

$fruits = array("Apple", "Banana", "Cherry");
$fruits[] = "Orange";
var_dump($fruits);

?>



</body>
</html>

```