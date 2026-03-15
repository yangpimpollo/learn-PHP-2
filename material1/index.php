<?php echo 'Hola mundo desde Material 1'; ?>


<?php

namespace App;

use ArdaGnsrn\Ollama\Ollama;

class OllamaAIservice implements ServiceInterface
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