# Levantar el servidor en local

Esta guía explica los pasos necesarios para *levantar el servidor en entorno de desarrollo local* sin ningún problema.

## 🧩 Requisitos del servidor

### Sistema operativo

Se recomienda usar:

 * *Ubuntu 22.04+* o *Windows 11* con WSL habilitado.

 ### Programas necesarios

 Asegúrate de tener instaladas las siguientes herramientas:

| Programa | Versión recomendada |
| ------------- |:-------------:|
| Node.js     | Última versión estable     |
| PHP         | Última versión estable     |
| Composer    | Última versión estable     |
| PostgreSQL  | Última versión estable     |
| Git         | Última versión estable     |
| Redis       | Última versión estable     |













# Levantar el servidor en local
Esta guía explica los pasos necesarios para *levantar el servidor en entorno de desarrollo local* sin ningún problema.

## 🧩 Requisitos del servidor
### Sistema operativo
Se recomienda usar:

 * *Ubuntu 22.04+* o *Windows 11* con WSL habilitado.

 ### Programas necesarios

 Asegúrate de tener instaladas las siguientes herramientas:

Programa	Versión recomendada
Node.js	v21.7.1+
PHP	8.2
Composer	v2.7.2
PostgreSQL	v16
Git	Última versión estable
Redis	Última versión estable
Chromium	Última versión estable
PDFTK	Última versión estable
# 1. Instalar WSL
Instalar WSL desde la *Terminal de Windows*
```
wsl --install
```
# 2. Instalar Ubuntu
Instalar Ubuntu desde la *Terminal de Windows*
```
wsl --install -d Ubuntu-24.04
```
Iniciar ubuntu
```
wsl.exe -d Ubuntu-24.04
```
* Colocar nombre de usuario
* Ingresar clave   
               
Actualizar ubuntu
```
sudo apt update && sudo apt upgrade -y
```
# 3. Instalar Node
Ejecutar el siguiente comando para añadir el repositorio:
```
curl -fsSL https://deb.nodesource.com/setup_21.x | sudo -E bash -
```
Ahora, instalar Node.js 21 ejecutando:
```
sudo apt install -y nodejs
```
# 4. Instalar PHP
Agregar el repositorio de PHP ejecutando el siguiente comando
```
sudo add-apt-repository ppa:ondrej/php
```
Actualizar los paquetes
```
sudo apt update
```
Instalar PHP
```
sudo apt install php8.2
```
# 5. Modulos PHP
Módulos requeridos
```
sudo apt install php8.2-pgsql
sudo apt install php8.2-gd
sudo apt install php8.2-xml
sudo apt install php8.2-curl
sudo apt install php8.2-zip
sudo apt install php8.2-redis
```
# 6. Instalar PostgreSQL
```
sudo apt install postgresql-16
```
# 7. Instalar Composer
Ejecutar el siguiente comando
```
curl -sS https://getcomposer.org/installer | php
```
Mover el directorio
```
sudo mv composer.phar /usr/local/bin/composer
```
# 8. Permitir conexiones externas en PostgreSQL
Obtenemos la IP de WSL, desde Ubuntu ejecutar:
```
hostname -I
```
Nos devolverá algo así: nameserver 192.168.23.252

*Archivo1:*
Editar el archivo postgresql.conf
```
sudo nano /etc/postgresql/16/main/postgresql.conf
```
Buscar la línea:
```
#listen_addresses = 'localhost'

port = 5432
```
Y cambiarla a:
```
listen_addresses = '*'

port = 5433
```
Guardar y cerrar. Luego reiniciar PostgreSQL
```
sudo service postgresql restart
```
*Asignar contraseña a usuario*
Ejecutar
```
sudo -u postgres psql
```
Cambiar la constraseña al usuario *postgres*
```
ALTER USER postgres WITH PASSWORD 'TuContraseñaSegura';
```
Salir del prompt
```
\q
```
Ahora reiniciar PostgreSQL
```
sudo service postgresql restart
```
# 9. Instalar Redis
```
sudo apt install -y redis-server
```
# 10. Instalar Chromium
```
sudo apt install chromium-browser
```
Crear un enlace simbólico (para que apunte a la ruta que está en el código)
```
sudo ln -s /usr/bin/chromium-browser /usr/bin/chromium
```
Verificamos que funciona:
```
/usr/bin/chromium --version
```
Instalamos las dependencias que necesarias:
```
sudo apt update
sudo apt install -y \
  libnss3 \
  libxss1 \
  libatk-bridge2.0-0 \
  libgtk-3-0 \
  libasound2t64 \
  libxshmfence1 \
  libgbm1 \
  libx11-xcb1 \
  libxcb-dri3-0 \
  libdrm2 \
  libxcomposite1 \
  libxdamage1 \
  libxrandr2 \
  libxi6 \
  libxtst6 \
  libcups2 \
  libpangocairo-1.0-0 \
  libpango-1.0-0 \
  fonts-liberation \
  libappindicator3-1 \
  lsb-release \
  xdg-utils \
  ca-certificates \
  wget
```
# 11. Instalar PDFTK
```
sudo add-apt-repository universe
sudo apt update
sudo apt install -y pdftk-java
```
# 10. Instalar Git
```
sudo apt install git -y
```
Configurar nombre y correo
```
git config --global user.name "Tu Nombre"
git config --global user.email "tuemail@ejemplo.com"
```
# 11. Generar SSH Key
```
ssh-keygen -t rsa -b 4096 -C "tu_correo@ejemplo.com"
```
# 12. Configurar Gitlab
Desde la cuenta de Gitlab colocar el SSH Key generado.

# 13. Clonar Repositorio
Clonar los repositorios correspondientes.