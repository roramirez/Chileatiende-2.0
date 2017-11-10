# ChileAtiende

## Instalación

Primero se debe copiar el archivo .env.example a .env y editar las variables de configuración de acuerdo a tu servidor:

```
cp .env.example .env
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

Para indexar:

```
php artisan elasticsearch:admin index
```