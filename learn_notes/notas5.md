# NOTAS DE APRENDIZAJE 5 PHP (●'◡'●)🤢

 ## video 16 (API key de OpenAI)

anteriormente trabajamos con el modelo instalado en local ahora pasamos a hacer consultas en nube 
1. similar a lo anterior instalamos openia en nuestro proyecto con composer con el comando `composer require openai-php/client` se modificara el archivo composer.json 
2. creamos una clase `OpenAIservice.php` dentro src revisar la documención de como implementarse en `https://github.com/openai-php/client`
3. pedimos el api key en la plataforma de openai for developers.

```php
 # OpenAIservice.php
<?php

namespace App;

use OpenAI;

class OpenAiservice 
{
    protected $client;                                         // no colocar el key directamente
    
    public function __construct() { $this->client = OpenAI::client('sk-proj-rNvBpCrNh....'); }

    public function getResponse(string $input): string                 
    {
        $result = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo', // 'gpt-3.5-turbo',gpt-4o-mini
            'messages' => [
                ['role' => 'user', 'content' => $input],
            ],
        ]);

        return $result['choices'][0]['message']['content'];
    }
}
 ```

 ```php
 # ai
#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\FruitAIservice;
use App\OllamaAIservice;
use App\OpenAIservice;

$aiService = new OpenAIservice();

echo 'Ask anything to AI' . PHP_EOL;

while (true) {

    $input = readline('> ');
    if ($input === 'exit' || $input === '') break;
    
    $response = $aiService->getResponse($input);
    echo $response . PHP_EOL;
    
}
 ```
> No funciona por que es un servicio de paga💸😂

 ## video 17 (variables de entorno)

1. creamos un anchivo `.env` que no se subira a git y uno `.env.example` de ejemplo para subir en .gitignore debemos añadir *.env* para que no se suba
2. ejecutamos el comando `composer require vlucas/phpdotenv` se modificara el archivo composer.json 
3. colocamos el key en .env `OPENAI_API_KEY=sk-proj-rNvBpCrNhgOupj... `

```php
public function __construct() { $this->client = OpenAI::client($_ENV['OPENAI_API_KEY']); }

// del codigo anterior remplazamos el key por la variable de entorno
```

```php
#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// añadir las 2 lineas anteriores nos dan la ubicacion de las variables y protegen a que no sea sobre escrita
```

 ## video 18 (organizacion de archivos con bootstrap)

 1. creamos un archivo `bootstrap.php` 

 ```php
 <?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$aiService = new  App\OpenAIservice();
```

2. en archivo `ai`    remplazamos toda la parte inicial por un llamado a bootstrap

 ```php
#!/usr/bin/env php
<?php

require __DIR__ . '/../bootstrap.php';

echo 'Ask anything to AI' . PHP_EOL;

while (true) {
```

## video 19 (diseño de pronts)
## video 20 (inyeción de dependencias)

reubicamos el codigo creamos `Chat.php` en src

```php
 # bootstrap.php
 <?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$aiService = new  App\FruitAIservice();
return new App\Chat($aiService);
```

```php
 # Chat.php
 <?php

namespace App;

class Chat
{
    public function __construct( protected FruitAIservice $aiService ) { }

    public function start()
    {
        echo 'Ask anything to AI' . PHP_EOL;

        while (true) {

            $input = readline('> ');
            if ($input === 'exit' || $input === '') break;
            
            $response = $this->aiService->getResponse($input);
            echo $response . PHP_EOL;        
        }
    }
}
```

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

$app = require __DIR__ . '/../bootstrap.php';

$app->start();
```

## video 21 (interfaces)

el ejecutable `ai` da inicio a app que es un objeto Chat podemos ver en la clase bootstrap
pero en Chat el costructor solo admite `public function __construct( protected FruitAIservice $aiService ) { }` FruitAIservice como parametro como se podria hacer par los demas servicios usamos las interfaces 
creamos la clase interface `ServiceInterface` y modificamos  la clase Chat

```php
 # ServiceInterface.php
<?php

namespace App;

interface ServiceInterface { public function getResponse(string $input): string; }
```

```php
 # Chat.php
<?php

namespace App;

class Chat
{
    public function __construct( protected ServiceInterface $aiService ) { }

    public function start()
    {
```

en los servicios implementamos la interface `class .....AIservice implements ServiceInterface`

## video 22 (Refactorización)

adornar codigo crea funciones private que se usara dentro del la misma clase
programar con intencion! para que se entienda mejor

## video 23 (Adaptando al navegador)

creamos carpeta public ponemos al `index.php` ahi iniciamos el servidor con `php -S localhost:8000 -t public`
modificamos algunas funciones de chat usamos el modelo Ollama.

```php
 # index.php
 <?php

$app = require __DIR__ . '/../bootstrap.php';

$question = $_POST['question'] ?? '';
$answer = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $question) {
    $answer = $app->getResponse($question);
}
?>

<form method="POST">
    <label for="question">Ask anything to AI</label>
    <input type="text" name="question" value="<?= htmlspecialchars($question) ?>" required>
    <button type="submit">Ask</button>
</form>

<p>
    <?php if ($answer): ?>
        <strong>Answer:</strong> <?= htmlspecialchars($answer) ?>
    <?php endif; ?>
</p>
```

```php
<?php

namespace App;

class Chat
{
    public function __construct( protected ServiceInterface $aiService ) { }

    public function start()
    {
        echo 'Ask anything to AI' . PHP_EOL;

        while (true) {

            $input = readline('> ');
            if ($input === 'exit' || $input === '') break;
            
            $response = $this->aiService->getResponse($input);
            echo $response . PHP_EOL;        
        }
    }

    public function getResponse(string $input): string { return $this->aiService->getResponse($input); }
}
```
>  <img src="../res/image04.png" width="100%" style="float: left; margin-right: 100px;">