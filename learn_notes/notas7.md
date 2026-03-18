# NOTAS DE APRENDIZAJE 7 PHP (●'◡'●)🦊

Resumen de tutorial *PHP orientado a Objetos* de Styde
```php
```


 ## video 01 (clases y objetos)
```php
class Person {                             // creamos la clase Person
    public $firstName;
    public $lastName;

    public function __construct($firstName, $lastName) {        // el constructor
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getFullName() { return "$this->firstName $this->lastName"; }
}

$person1 = new Person('John', 'Doe');              // creamos el objeto

echo "Hello, ". $person1->getFullName() . "!";     // imprimimos el nombre

$person1->firstName = 'Jane';                      // modificamos la variable
echo "Hello, ". $person1->getFullName() . "!";     // volvemos a imprimir
```
se pude ejecutar en la consola con `php index.php`
> Hello, John Doe!                                                    
  Hello, Jane Doe!

 ## video 02 (encapsulamiento getter setter)
```php
    protected $firstName;           // encapsulamos con protected 
    protected $lastName;

    public function getFirstName() { return $this->firstName; }         // para aceder creamos el metodo getter
    public function setFirstName($firstName) { $this->firstName = $firstName; }      // para modificar setter
    public function getLastName() { return $this->lastName; }
    public function setLastName($lastName) { $this->lastName = $lastName; }
```

 ## video 03 (herencia y abstracción)
```php

    abstract class Unit {                                        // clase abstracta
        protected $falive = true;
        protected $name;

        public function __construct($name) { $this->name = $name; }

        abstract public function move($direction);                              // las funciones abstractas NO se definen

        public function attack($opponent) { echo $this->name . " is attacking " . $opponent . "\n"; }
    }

    class Soldier extends Unit {       // hereda de la clase Unit
        
        public function move($direction) { echo $this->name . " is moving " . $direction . "\n"; }         
        // función abstracta debe ser implementada 
        
        public function attack($opponent) { echo $this->name . " is attacking " . $opponent . " with a sword\n"; }
        // sobre escribimos el metodo atack
    }

$fulano = new Soldier( "Fulano");
$fulano->attack("enemies");

```
> Fulano is attacking enemies with a sword

 ## video 04 (interaccion entre objetos)
```php
```

 ## video 05 (interfaces y polimorfismo)
En PHP una clase solo:                                                                           
    ✅ Puede heredar de una sola clase                            
    ✅ Puede implementar varias interfaces                                                 
    ✅ Cuando una clase implementa una interface, debe definir todos sus métodos                                 
    ✅ Cuando una clase hereda de otra (extends), no es obligatorio sobrescribir los métodos.                       

```php
class Animal { public function comer() { echo "Comiendo"; } }

interface Volador { public function volar(); }
interface Nadador { public function nadar(); }

class Pato extends Animal implements Volador, Nadador {

    public function volar() {  echo "Volando"; }
    public function nadar() { echo "Nadando"; }

    public function comer() { echo "El pato está comiendo"; }    // opcional sobreescribir la función heredada
}
```

 ## video 06 (Autocarga de clases y espacio de nombres)

para importar clases `require 'classA.php'` tambien `spl_autoload_register` lo hace automaticamente carga las clases necesarias y espacio de nombres `namespace`


 ## video 07 (Autocarga de clases con composer)

 En la consola `composer init` rellerar el formulario y se creara composer.json, y la carpeta vendor

 ## video 08 (repaso de ejercicios)

 ## video 09 (patron factory)
 ```php

 proyect/
    |──public/ ── [index.php]
    |──src/ ── [Operacion.php, OperacionFactory.php, Suma.php, Resta.php]
    |──vendor/ ── [composer/, autoload.php]
    |──composer.json
    |──.gitignore

  ### composer.json
    {
    "name": "mat1/oot",
    "autoload": {
        "psr-4": {
            "Mat1\\Oot\\": "src/"
        }
    },

  ### interface Operacion.php
    <?php
        namespace Mat1\Oot;

        interface Operacion { public function calcular(): string; }
    ?>
  ### clases sumas y resta
    <?php
        namespace Mat1\Oot;

        class Suma implements Operacion {
            public function calcular(): string {
                return "Calculando una suma... 3 + 5 = 8";
            }
        }
        class Resta implements Operacion {
            public function calcular(): string {
                return "Calculando una resta...";
            }
        }

  ### OperacionFactory.php
    <?php
        namespace Mat1\Oot;

        class OperacionFactory {
            public static function crear(string $tipo): Operacion {
                return match ($tipo) {
                    'suma' => new Suma(),
                    'resta' => new Resta(),
                    default => throw new \Exception("Tipo de operación no soportado"),
                };
            }
        }
  ### index.php
        require_once __DIR__ . '/../vendor/autoload.php';

        use Mat1\Oot\OperacionFactory;                   // como no esta en el espacio de nombres se debe importar

        $operacion = OperacionFactory::crear('suma');
        echo $operacion->calcular(); // Imprime: Calculando una suma... 


 ```

 ## video 13 (patron facade)
 El patrón Facade (Fachada) es uno de los diseños más útiles cuando quieres esconder la complejidad de un sistema detrás de una interfaz simple. En lugar de que tu código principal tenga que lidiar con cinco clases diferentes, solo interactúa con una.
```php
❌ // Código complejo y repetitivo
   $stock = new Inventory();
   $payment = new PaymentGateway();
   $shipping = new CourierService();
   
   if ($stock->check('Laptop')) {
       $payment->charge(1200);
       $shipping->ship('Calle Falsa 123');
   }

✅
class Inventory { public function checkProduct($name) { return true; } }
class PaymentGateway { public function processPayment($amount) { echo "Cobrando $$amount...\n"; } }
class Shipping { public function sendProduct($address) { echo "Enviando a $address...\n"; } }

class OrderFacade {
    protected $inventory;
    protected $payment;
    protected $shipping;

    public function __construct() {
        $this->inventory = new Inventory();
        $this->payment = new PaymentGateway();
        $this->shipping = new Shipping();
    }

    public function placeOrder($product, $price, $address) {
        if ($this->inventory->checkProduct($product)) {
            $this->payment->processPayment($price);
            $this->shipping->sendProduct($address);
            return "¡Pedido completado con éxito!";
        }
        return "Error: Producto no disponible.";
    }
}

// Uso súper simple
$order = new OrderFacade();
echo $order->placeOrder("Laptop", 1200, "Av. Siempre Viva 742");
```

 ## video 14 (declarar constantes)
 tienes dos formas principales de declarar constantes
```php
define("PI", 3.1416);                     // define
define("APP_NAME", "Mi Sistema");         // alcance global, dentro de if, ma lenta 
echo PI; // Imprime 3.1416


const MONEDA = "USD";                                            // const
class Config { const VERSION = "1.0.2"; }                    // alcance local dentro de una clase, no puede con if, mas rapido
echo Config::VERSION;                                       // Acceso mediante el operador de resolución de ámbito

if (!defined("API_KEY")) { define("API_KEY", "12345"); }        // ver si se definio
```

 ## video 15 (metodos magicos get set isset unser)
 🧠 FORMA DE RECORDARLO
Piensa que tu objeto tiene un “portero”:
- Si alguien quiere ver algo → __get
- Si quiere cambiar algo → __set
- Si pregunta “¿existe?” → __isset
- Si quiere borrar → __unset
Se activan solo cuando: la propiedad no existe, o es private/protected


 ## video 16 (llamada dinamica a metodo)

Llamas métodos usando variables:

$metodo = "hola";
$obj->$metodo();

👉 Sirve para hacer código flexible (APIs, routers)

 ## video 17 (metodos magicos call callStatic)

Se ejecutan cuando llamas métodos que no existen

__call($nombre, $args)
__callStatic($nombre, $args)
👉 Uso típico
Simular métodos

Crear APIs dinámicas

 ## video 18 (metodos magicos toString invoke)
__toString()

👉 Convierte objeto a string

echo $obj;
__invoke()

👉 Permite usar el objeto como función

$obj();
 ## video 19 (metodos magicos sleep wakeup)

👉 Se usan con serialización

__sleep() → antes de guardar objeto

__wakeup() → al restaurarlo

👉 Ejemplo: guardar en sesión

 ## video 20 (metodos magicos clone)

👉 Se ejecuta cuando clonas un objeto

$obj2 = clone $obj1;

👉 Sirve para:
Copias controladas
Evitar compartir referencias

 ## video 21 (iteracion de objetos)

Puedes recorrer objetos con foreach

foreach ($obj as $key => $value) {}

👉 Solo propiedades públicas (por defecto)

 ## video 22 (objetos inmutables)

👉 No se pueden modificar después de crearse
class User {
    private $name;
    public function __construct($name) {
        $this->name = $name;
    }
}
👉 Ventaja:

Más seguro

Menos errores

 ## video 23 (compracion objetos)
$obj1 == $obj2  // valores iguales
$obj1 === $obj2 // misma instancia

👉 IMPORTANTE:

== compara contenido
=== compara referencia
 ## video 24 (traits)

👉 Reutilizar código sin herencia

trait Saludo {
    public function hola() {
        echo "Hola";
    }
}
class Persona {
    use Saludo;
}

👉 Es como “copiar y pegar elegante”

 ## video 25 (creacion macros usando traits metodos estaticos y call)

👉 Crear métodos dinámicos en tiempo de ejecución

Ejemplo idea:

Clase::macro('saludar', function() {
    return "Hola";
});
👉 Muy usado en frameworks como Laravel

 ## video 26 (instalar componentes con composer)
👉 Gestor de dependencias de PHP
composer require paquete
👉 Sirve para:
Instalar librerías
Autoload automático

 ## video 27 (desrrollo de clases y metodos con pruebas automatizadas)

👉 Testear código automáticamente
PHPUnit
👉 Beneficio:
Detectar errores rápido
Código más confiable

 ## video 28 29(array access)

👉 Permite usar objetos como arrays
$obj["clave"] = "valor";
Implementando:

offsetSet()
offsetGet()
offsetExists()
offsetUnset()
 ## video 30 (clases anonimos)
👉 Clases sin nombre

$obj = new class {
    public function hola() {
        echo "Hola";
    }
};

👉 Útil para:
Código rápido
Testing
Objetos temporales

 
