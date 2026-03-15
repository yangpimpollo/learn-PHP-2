# NOTAS DE APRENDIZAJE 6 PHP (●'◡'●)🍔

 ## Resumen de la instalación personal y Automaticación bat



1. instalar wls en el powersell `wsl --install` reiniciar
2. instalar ubuntu `wsl --install -d Ubuntu` tal vez no sirva usar Microsoft Store y instalarlo
3. crear usuario y contraseña

```bash
yangpimpollo@DESKTOP-8888888:~$ 

```

4. actualizar paquees de ubuntu `sudo apt update && sudo apt upgrade -y`

5. `sudo apt install php-cli php-common php-mbstring php-xml php-zip php-curl php-sqlite3 unzip -y`
instala lo esencial de php

	* php-cli → permite ejecutar PHP desde la terminal
	* php-common → archivos base de PHP
	* php-mbstring → manejo de texto Unicode
	* php-xml → leer y escribir XML
	* php-zip → trabajar con archivos zip
	* php-curl → hacer requests HTTP (APIs)
	* php-sqlite3 → base de datos ligera SQLite
	* unzip → descomprimir archivos

```bash
yangpimpollo@DESKTOP-8888888:~$ php -v
PHP 8.3.6 (cli) (built: Jan 27 2026 03:09:47) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.3.6, Copyright (c) Zend Technologies
    with Zend OPcache v8.3.6, Copyright (c), by Zend Technologies
```

6. instalar composer con 4 comandos (descargar, instalar en la carpeta global, borrar el instalador, verificar) respectivamente:

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"


yangpimpollo@DESKTOP-8888888:~$  composer -v
   ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/
Composer version 2.9.5 2026-01-29 11:40:53

```

7. viendo linux

```bash
yangpimpollo@DESKTOP-8888888:~$ pwd
/home/yangpimpollo
yangpimpollo@DESKTOP-8888888:~$ ls
Desktop  Documents  Downloads  Music  Pictures  Videos  Workspace
yangpimpollo@DESKTOP-8888888:~$ cd Workspace
yangpimpollo@DESKTOP-8888888:~/Workspace$ cd learn
yangpimpollo@DESKTOP-8888888:~/Workspace/learn$ ls
learn_notes  material1  material2
yangpimpollo@DESKTOP-8888888:~/Workspace/learn$ code .
```

8. automatización con bat

```bash
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
```



