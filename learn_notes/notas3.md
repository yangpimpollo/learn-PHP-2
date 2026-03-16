# NOTAS DE APRENDIZAJE 3 PHP (●'◡'●)🦁

Introduccion a las clases yu objetos en php

 ## video 07 (clases y objetos)

 ```php
 <?php
    class Fruit {
        public $name;
        public $color;
        
        function __construct($name, $color) {
            $this->name = $name;
            $this->color = $color;
        }
        function get_details() {
            echo "Name: " . $this->name . ". Color: " . $this->color .".<br>";
        }
    }

    $apple = new Fruit('Apple', 'Red');
    $apple->get_details(); 
    $banana = new Fruit('Banana', 'Yellow');
    $banana->get_details();

    var_dump($apple instanceof Fruit);       // comprobar si un objeto pertenece a una clase 
?>
 ```
> Name: Apple. Color: Red.                      
  Name: Banana. Color: Yellow.                       
  bool(true)

```php
<?php
    class Course {                             // tambien se puede se crear la clase de esta manera
        public function __construct(           // "crear las variables en el constructor (dentro del parentesis)"
            public string $title,
            public string $subtitle,
            public string $description,
            public array $tags = []
        ) {}
    }

    $course = new Course(                      // se crea un objeto de la clase Course
        title: 'Curso de PHP',
        subtitle: 'Aprender PHP desde cero',
        description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus.',
        tags: ['php', 'programación', 'backend']
    );
?>

<!DOCTYPE html>
<html>
    <head></head>        // usar la variable dentro de html
    <body>       
        <h1>Bienvenido al <?php echo $course->title; ?></h1>
        <h1>Queremos <?= $course->subtitle ?></h1>       // se pude de las 2 maneras
    </body>
</html>
```
> Bienvenido al Curso de PHP                        
  Queremos Aprender PHP desde cero


 ## video 08 (organización de clases)

separamos archivos un archivo `Fruit.php` y `index.php`

 ```php
 # Fruit.php
 <?php
    class Fruit {
        function __construct(
            protected string $name,
            protected string $color // protected para evitar que se modifique externamente
            ) {}               
        

        public function getName(): string { return $this->name; }
        public function getColor(): string { return $this->color; }


        function get_details() {
            echo "Name: " . $this->name . ". Color: " . $this->color .".<br>";
        }
    }
?>
 ```

  ```php
  # index.php
 <?php
    require 'Fruit.php';       // se importa aqui

    $apple = new Fruit('Apple', 'Red');

    echo $apple->get_details() ;
    echo $apple->getName() ;
    echo $apple->getColor() ;
?>
 ```

 > Name: Apple. Color: Red.                          
   Apple                         
   Red


 ## video 09 (metodos magicos)

 metodos magicos empiezan con doble subguion __

```php
  # Fruit.php
 <?php
        public function getName(): string { return $this->name; }             ❌   // para evitar muchos geters
        public function getColor(): string { return $this->color; }           ❌   

        public function __get($name){
            if(property_exists($this, $name)) { return $this->$name; }        ✅   // geter magico
            return null;
        }

        ------------------------------------------------------------------------------------------------------------------
        public function __toString(){                                              // comviete en string metodo magico
            return "I am an ".$this->name." and I am ".$this->color.".";           // resultado personalizado
        }
?>
 ```

```php
  # index.php
 <?php
    require 'Fruit.php';
    $apple = new Fruit('Apple', 'Red');

    //echo $apple->getName() ;          ❌
    //echo $apple->getColor() ;         ❌
    echo $apple->name ; 
    echo $apple->color ;                ✅   // llamamos directamente con el geter magico

    ------------------------------------------------------------------------------------------------------------------
    echo $apple;
?>
 ```

 > Apple              
   Red                          
   I am an Apple and I am Red.


 ## video 10 (Estructura profecional separar archivos)

```php
  # FruitType.php
 <?php
    enum FruitType: string                            // hacemos una clase enumeración
    {
        case SWEET = 'sweet';
        case ACIDIC = 'acid';

        public function label(): string               // funcion personalizada
        {
            return match ($this) {
                self::SWEET => 'sweet fruit',
                self::ACIDIC => 'acid fruit',
            };
        }
    }
?>
 ```

 ```php
  # Fruit.php
 <?php
    require 'FruitType.php';                   // importamos el tipo de dato FruitType

    class Fruit {
        function __construct(
            protected string $name,
            protected string $color, 
            protected FruitType $type = FruitType::SWEET           // añadimos nuevo parametro type 
            ) {}                                                   // de valor predeterminado SWEET
        
        public function __toString(){
            return "I am an ".$this->name." and I am ".$this->color." and I am ".$this->type->label().".";
        }
    }                                         //   $this->type->value        da su valor 'sweet' o 'acid'
?>                                            //   $this->type->label()      la funcion personalizada label de FruiType
 ```

 ```php
  # index.php
<?php
    require 'Fruit.php';           // importamos Fruit

        // se puede crear con las etiquetas de cada parametro o sin ellas

    $apple = new Fruit(name: 'Apple', color: 'Red', type: FruitType::ACIDIC);     
    $banana = new Fruit('Banana', 'Yellow', FruitType::SWEET);               
    
    echo $apple;            // llama la funcion __toString() de Fruit
    echo $banana; 
?>                                         
 ```
 > I am an Apple and I am Red and I am acid fruit.                                     
   I am an Banana and I am Yellow and I am sweet fruit.


