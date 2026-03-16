@echo off
title Entorno PHP: %USERNAME%
echo [1/3] Lanzando servidor PHP en segundo plano...

:: 1. Lanzamos el servidor en una ventana nueva para que no bloquee el script
start "Servidor PHP - Ubuntu" wsl sh -c "cd ~/Workspace/learn/material1/ && php -S localhost:8000"

:: Pequeña pausa de 2 segundos para asegurar que el servidor responda
timeout /t 2 /nobreak >nul

echo [2/3] Abriendo el navegador en localhost:8000...
:: 2. Abrimos el navegador 
start http://localhost:8000

echo [3/3] Iniciando VS Code...
:: 3. Abrimos el editor en la ruta de Ubuntu
wsl sh -c "cd ~/Workspace/learn/ && code ."

echo ---------------------------------------------------
echo ¡Listo! Ya puedes empezar a programar.
echo (No cierres la ventana del Servidor PHP)
echo ---------------------------------------------------
:: pause
exit