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
    protected $firstName;           // encapsulamos con protected 
    protected $lastName;

    public function getFirstName() { return $this->firstName; }         // para aceder creamos el metodo getter
    public function setFirstName($firstName) { $this->firstName = $firstName; }      // para modificar setter
    public function getLastName() { return $this->lastName; }
    public function setLastName($lastName) { $this->lastName = $lastName; }
```