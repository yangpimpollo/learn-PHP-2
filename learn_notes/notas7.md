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

 ## video 06 (interfaces y polimorfismo)

 ```php
 ```