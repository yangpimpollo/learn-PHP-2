# NOTAS DE APRENDIZAJE 10 PHP (●'◡'●)🦊

 ## video 01 (introducción de refactorizacion)
  leer el libro *REFACTORING* de MartinFowler
  es biblia para los programadores *"no solo debe funcionar sino debe ser legible y modificable"*


  ### 🧠 Idea principal

El refactoring (refactorización) consiste en reestructurar el código existente para hacerlo más limpio, entendible y mantenible, sin alterar lo que el programa hace.

### 🔄 Proceso de refactorización
  1. *Pruebas Autogestionadas:* Antes de tocar nada, debes tener una suite de pruebas sólidas.
  2. *Pasos Pequeños:* Realiza cambios minúsculos. Si algo se rompe, es fácil de encontrar.
  3. *Testeo Constante:* Ejecuta las pruebas después de cada pequeño cambio.
👉 Siempre tener pruebas automatizadas antes de refactorizar

### 🚨 Code Smells (malos olores)

Son señales de que el código necesita mejoras. Algunos ejemplos:

- Métodos muy largos
- Clases demasiado grandes
- Código duplicado
- Demasiados parámetros
- Uso excesivo de condicionales


### 🛠️ Técnicas de refactorización

El libro presenta pequeños cambios seguros y graduales, como:

- Extract Method: dividir métodos largos
- Rename Variable: nombres más claros
- Move Method: mover funciones a clases más apropiadas
- Inline Method: eliminar métodos innecesarios
- Replace Conditional with Polymorphism

 ## video 02 (--)
  creando el proyecto con composer

 ## video 03 (--)
 viendo un proyecto sin refactorizar

 ## video 04 (--)
 instalar `PHPIUnit` para pruebas automatizadas

 ## video 05 (--)
automatizando pruebas automatizadas

 ## video 06 (eje de refacto  extraer metodos)

    > 🆘✅❇️  [ **BUENA PRACTICA** ]                       
        si las funciones son largas y tienen comentario lo extraemos a un metodo diferente y remplazamos por con el nombre del metodo✨


```php
       
❌   // si el elemento es void
    if(in_array($this->name,['br','hr','img','input','meta'])){
        return $result;
    }

✅   
    if($this->isVoidElement()) { return $result; }
    protected function isVoidElement(){ return in_array($this->name,['br','hr','img','input','meta']), }

```

 ## video 07 (calistenia de objetos menos indentacion)

     > 🆘✅❇️  [ **BUENA PRACTICA** ]                       
        reducir niveles de indentación remplazando por metodos✨

 ## video 08 (calistenia de objetos no usar else)

     > 🆘✅❇️  [ **BUENA PRACTICA** ]                       
        remplazar if-else anidadas por clausulas de proteccion (guard clauses) comprobaciones planas que finalizan la funcion anticipadamente                                       
        tambien no usar negaciones✨

```php
❌
    public function getAttribute($var){
        if($var){
            $result = "A";
        }else{
            $result = "B";
        }

        return $result;
    }
✅   
    public function getAttribute($var){
        if($var) return "A"; 
        return "B";
    }

```

 ## video 09 (eliminar variables temporales)

     > 🆘✅❇️  [ **BUENA PRACTICA** ]                       
        quitar las variables inecesarias nentro de una funcion✨

 ## video 10 (refactorizar una clase)
