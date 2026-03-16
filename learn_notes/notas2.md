# NOTAS DE APRENDIZAJE 2 PHP (●'◡'●)🍕

Resumen de **fundamentos de  PHP** de platzi

 ## video 01 (php sigue siendo relevante)

<img src="../res/image01.png" width="20%" style="float: left; margin-right: 100px;">

* 78% funciona con PHP (instagram, wikipedia, wordpress)
* facil integración
* principios SOLID
* ressultados inmediatos
* intgración con API

```php
# Que es solid ? reglas de diseño  orientadas a objetos
#    S - Single Responsibility (Responsabilidad Única)
#    O - Open/Closed (Abierto/Cerrado)
#    L - Liskov Substitution (Sustitución de Liskov)
#    I - Interface Segregation (Segregación de Interfaces)
#    D - Dependency Inversion (Inversión de Dependencias)
```


```php
<?php
require __DIR__ . '/bootstrap.php';

$client = OpenAI::client($_ENV['OPENAI_API_KEY']);

$result = $client->chat()->create([
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        [
            'role' => 'user',
            'content' => 'cuando se llego la luna'
        ]
    ]
]);
?>
```
> <h1>no funciona </h1>

 ## video 02 (creacion y uso de variables)

```php
<?php
$course = "Curso de PHP";     // se crea la variable
?>

<!DOCTYPE html>
<html>
    <head></head>        // usar la variable dentro de html
    <body>       
        <h1>Bienvenido al <?php echo $course; ?></h1>
        <h1>Bienvenido al <?= $course ?></h1>       // se pude de las 2 maneras
    </body>
</html>
```
> <h1>Bienvenido al Curso de PHP</h1>

 ## video 03 (condicionales)

 
```php
<?php
$archived = true;     // se crea booleavo
?>

<!DOCTYPE html>
<html>
    <head></head>     
    <body>       
        <?php if(!$archived) { echo "archivado"; }else { echo "activo"; } ?>

        <?php if($archived): ?> 
            <p>archivado</p>
        <?php else:?>   
            <p>activo</p>     // separar logica de prog
        <?php endif;?>        // con la presentación
                              // tambien se puede usar operador ternario

    </body>
</html>
```
> <h1>activo</h1>

 ## video 04 (arrays) y 05 (for each)

 
```php
<?php
// $tag_1 = "PHP";
// $tag_2 = "Laravel";
// $tag_3 = "Composer";

$tags = ["PHP", "Laravel", "Composer"];     // crear un array
?>

<!DOCTYPE html>
<html>
    <head></head>     
    <body>       
        <ul>
            <li><?= $tags[0] ?></li>
            <li><?= $tags[1] ?></li>
            <li><?= $tags[2] ?></li>

            <?php foreach ($tags as $tag): ?>
                <li><?= $tag ?></li>            // recorre el array
            <?php endforeach; ?>
        </ul>

    </body>
</html>
```

>   . PHP                          
   . Laravel                             
   . Composer

 ## video 06 (arreglos asociativos)

 
```php
<?php
    $course = [
        'title' => 'Curso de PHP',
        'subtitle' => 'Aprende PHP desde cero',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus.',
        'tags' => ['php', 'programación', 'backend'],
    ];
?>

<!DOCTYPE html>
<html>
    <head></head>     
    <body> 
        <h2><?= $course['subtitle'] ?></h2>
        <ul>
            <?php foreach ($course['tags'] as $tag): ?>
                <li><?= $tag ?></li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>

```

>   Aprende PHP desde cero   
   . PHP                          
   . Laravel                             
   . Composer