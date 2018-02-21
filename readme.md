# ChileAtiende

## Instalación

Primero se debe copiar el archivo .env.example a .env y editar las variables de configuración de acuerdo a tu servidor:

```
cp .env.example .env
```

Generar la llave de instalación

```
php artisan key:generate
```

Luego, hacer la instalación de las librerias PHP necesarias:

```
composer install
```

Se generan los links simbolicos para acceder a la carpeta de storage de imagenes desde la web pública.

```
php artisan storage:link
```

Luego, la instalación de las librerias JS necesarias:

```
npm install
```

Compilación de JS

```
npm run prod
```


## Elasticsearch

Para crear el indice:

```
php artisan elasticsearch:admin create
```

Para indexar todo (Realizar esto en instalación inicial):

```
php artisan elasticsearch:admin index
```

Para indexar solo páginas:

```
php artisan elasticsearch:admin index pages
```

Para indexar solo sugerencias de búsqueda (Esto es recomendable dejarlo en un cron cada día para ir recalculando las sugerencias de acuerdo a las búsquedas populares de los usuarios):

```
php artisan elasticsearch:admin index suggestions
```

## Algoritmo Machine Learning para similitud de fichas

Es recomendable dejar en un cron todos los días este comando para calcular las fichas similares de acuerdo a las visitas de los usuarios.

```
php artisan ml:similarity
```