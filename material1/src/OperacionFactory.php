<?php
namespace Learnphp2\Mat1;

class OperacionFactory {
    public static function crear(string $tipo): Operacion {
        return match ($tipo) {
            'suma' => new Suma(),
            'resta' => new Resta(),
            default => throw new \Exception("Tipo de operación no soportado"),
        };
    }
}