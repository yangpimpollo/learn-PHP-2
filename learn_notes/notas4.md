# NOTAS DE APRENDIZAJE 4 PHP (●'◡'●)🐧

<img src="../res/image02.png" width="100%" style="float: left; margin-right: 100px;">



 ## video 11 (Autocarga de clases)

 para evitar importar a cada rato `require classA.php` utilizamos `composer` para autocargar

 1. creamos carpeta `src` solo dejamos index.php y composer.json externamente lo demas dentro
 2. creamos `composer.json` que siempre dirige automáticamente al src

 ```json
 # composer.json
 {
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
 ```
 3. ejecutar en comando `composer dump-autoload` para activar autocarga se crea carpeta `vendor`
 4. en `index.php` modificamos require 'vendor/autoload.php' y en los demas archivos `namespace App;`
    
    > 🆘✅❇️  [ **BUENA PRACTICA** ]                                    
    `require_once` evitar cargar el mismo archivo dos veces                                    
    `__DIR__` ruta absoluta Evita errores de "File not found"

 ```php
 # index.php
 <?php
    require_once __DIR__ . '/vendor/autoload.php';
    use App\Fruit;
    use App\FruitType;


 # Fruit.php y FruitType.php
<?php

namespace App;

 ```
 5. creamos `.gitignore` y ponemos `/vendor` para que no suba vendor


  ## video 12 (Creación de bot interactivo)

  1. creamos la carpeta `bin` para los ejecutables dentro creamos un archivo `ai` sin extensión

 ```php

#!/usr/bin/env php
<?php

echo 'Ask anything to AI' . PHP_EOL;

while (true) {

    $input = readline('> ');                                 // espera entrada
    if ($input === 'exit' || $input === '') break;           // si es exit o nada ce cierra
    
    echo 'Thinking...' . PHP_EOL;                            // responde pensando PHP_EOL salta de linea
    sleep(2);                                                // espera 2 segundos
    echo 'Fake response: ' . $input . PHP_EOL;               // responde "respuesta falsa"
}

```

  2. en la carpeta donde se trabaja ejecuta en la terminal `php bin/ai` para correr el programa
  3. hay otra manera de ejecutar el programa mediante  `./bin/ai` pero no funciona si no le cambiamos permiso primero para acceder
     con `chmod +x bin/ai` (autorizar a linux ejecutar el ejecutable) y colocar `#!/usr/bin/env php` (linea de interprete indicaciones de como procesar)al inicio 

```bash
    yangpimpollo@PC--086:~/carpeta1$ ./bin/ai
    Ask anything to AI
    > hello : )
    Thinking...
    Fake response: hello : )
    > exit
    yangpimpollo@PC--086:~/carpeta1$ 
```
    > 🆘✅❇️  [ **BUENA PRACTICA** ]                       
        Si haces el chmod +x y luego haces un git commit, la próxima vez que descargues el proyecto en otra PC (o alguien más lo haga), el archivo ya tendrá el permiso de ejecución y no habrá que repetirlo. ✨


  ## video 13 (Clases de servicio)

  en src creamos una clase `FruitAIservice` y delegamos en trabajo de reponder a la clase

```php
  # FruitAIservice.php
<?php

namespace App;

class FruitAIservice 
{
    public function getResponse(string $input): string 
    {
        echo 'Thinking...' . PHP_EOL;
        sleep(2);
        return 'Fake response: ' . $input ;
    }
}
```

```php
  # ai

#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\FruitAIservice;

$aiService = new FruitAIservice();

echo 'Ask anything to AI' . PHP_EOL;

while (true) {

    $input = readline('> ');
    if ($input === 'exit' || $input === '') break;
    
    $response = $aiService->getResponse($input);
    echo $response . PHP_EOL;
    
}
```

<img src="../res/image03.png" width="100%" style="float: left; margin-right: 100px;">

  ## video 14 (Instalar Olama)

abrir terminal instalamos ollama con `brew install ollama` no sirve estoy en ubuntu y no tengo brew lo instalo directamente 
`curl -fsSL https://ollama.com/install.sh | sh` y corremos llama3.2 `ollama run llama3.2:1b` que es ligero se descargara 1.3Gb 
lugo de concluir nos mostrara para interactuar con llama:

```bash

yangpimpollo@PC--086:~/carpeta1$ ollama run llama3.2:1b
pulling manifest 
pulling 74701a8c35f6: 100% ▕█████████████████████████████████████████████████████████████████████████████████████████████████▏ 1.3 GB                         
pulling 966de95ca8a6: 100% ▕█████████████████████████████████████████████████████████████████████████████████████████████████▏ 1.4 KB                         
pulling fcc5a6bec9da: 100% ▕█████████████████████████████████████████████████████████████████████████████████████████████████▏ 7.7 KB                         
pulling a70ff7e570d9: 100% ▕█████████████████████████████████████████████████████████████████████████████████████████████████▏ 6.0 KB                         
pulling 4f659a1e86d7: 100% ▕█████████████████████████████████████████████████████████████████████████████████████████████████▏  485 B                         
verifying sha256 digest 
writing manifest 
success 
>>> por que los gatos tiene 7 vidas
No hay evidencia científica que sugiera que los gatos tengan 7 vidas. De hecho, los gatos . . .

>>> /?
Available Commands:
  /set            Set session variables
  /show           Show model information
  /load <model>   Load a session or model
  /save <model>   Save your current session
  /clear          Clear session context
  /bye            Exit
  /?, /help       Help for a command
  /? shortcuts    Help for keyboard shortcuts

Use """ to begin a multi-line message.
```

al finalizar podemos observar en `http://localhost:11434/` que el modelo esta corriendo con el mensaje: *Ollama is running*


  ## video 15 (Integración de Olama en nuestro proyecto)

1. instalamos ollama en nuestro proyecto con composer con el comando `composer require ardagnsrn/ollama-php` se modificara el archivo composer.json y se creara composer.lock    
2. creamos una clase `OllamaAIservice.php` dentro src revisar la documención de como implementarse en `https://github.com/ArdaGnsrn/ollama-php`


```php
 # OllamaAIservice.php
<?php

namespace App;

use ArdaGnsrn\Ollama\Ollama;

class OllamaAIservice 
{
    protected $client;

    public function __construct(){ $this->client = Ollama::client(); }

    public function getResponse(string $input): string {
        $result = $this->client->chat()->create([
            'model' => 'llama3.2:1b',
            'messages' => [ ['role' => 'user', 'content' => $input], ],
        ]);
        return $result->message->content;        
    }
}
```

en el ejecutable tambien modificamos

```php
 # ai
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\FruitAIservice;
use App\OllamaAIservice;

$aiService = new OllamaAIservice();

echo 'Ask anything to AI' . PHP_EOL;

while (true) {

    $input = readline('> ');
    if ($input === 'exit' || $input === '') break;
    
    $response = $aiService->getResponse($input);
    echo $response . PHP_EOL;
    
}
```
3. el model se puede obtener desde la consola con `ollama list` obtenemos `llama3.2:1b` que instalamos anteriormente

```bach
yangpimpollo@PC--086:~/carpeta1$ ollama list
NAME           ID              SIZE      MODIFIED       
llama3.2:1b    baf6a787fdff    1.3 GB    36 minutes ago    
yangpimpollo@PC--086:~/carpeta1$ ./bin/ai
Ask anything to AI
>> llama es modelo de Meta?
Meta construye tecnologías que ayudan a la comunidad a . . . 
```





