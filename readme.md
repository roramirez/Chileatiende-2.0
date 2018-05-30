# ChileAtiende

## Instalación

Primero se debe copiar el archivo .env.example a .env y editar las variables de configuración de acuerdo a tu servidor:

```
cp .env.example .env
```

Instalar libtool

```
sudo apt-get install libtool
```

Instalar PHP 7.0

```
sudo apt-get install php
```

Instalar composer
```
sudo apt-get install composer
composer update --no-scripts
```

Luego, hacer la instalación de las librerias PHP necesarias:

```
sudo apt-get install php7.0-mbstring
sudo apt-get install php-curl
sudo apt-get install php-dom
sudo apt-get install php7.0-mysql
composer install
```

Generar la llave de instalación

```
php artisan key:generate
```


Se generan los links simbolicos para acceder a la carpeta de storage de imagenes desde la web pública.

```
php artisan storage:link
```

Luego, la instalación de las librerias JS necesarias:

```
npm install
npm install ajv-keywords
npm install gumshoe
npm rebuild --no-bin-links
```

Compilación de JS

```
npm run watch
```

Configurar los accesos a la Base de Datos

```
vim .env
```

Levantar la aplicación

```
php artisan serve
```

## Elasticsearch 5.5

Para instalar elasticsearch debe descargarse directamente de la página oficial (https://www.elastic.co/downloads/past-releases/elasticsearch-5-5-3), y correr una instancia utilizando:

```
./elasticsearch
```
### Solo funciona con elasticsearch 5.5

Para crear el indice:

```
php artisan elasticsearch:admin create
```

Para indexar solo páginas (Demora menos que hacerlo por completo y es suficiente para correr localmente el proyecto):

```
php artisan elasticsearch:admin index pages
```

## Opcional

Para indexar todo (Demora mucho):

```
php artisan elasticsearch:admin index
```

Para indexar solo sugerencias de búsqueda (Esto es recomendable dejarlo en un cron cada día para ir recalculando las sugerencias de acuerdo a las búsquedas populares de los usuarios):

```
php artisan elasticsearch:admin index suggestions
```

## Algoritmo Machine Learning para similitud de fichas (Opcional)

Es recomendable dejar en un cron todos los días este comando para calcular las fichas similares de acuerdo a las visitas de los usuarios.

```
php artisan ml:similarity
```