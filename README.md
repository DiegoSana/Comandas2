<p align="center">
    <h1 align="center">Comandas.com.ar - Yii 2</h1>
    <br>
</p>

Sotware de comandas y menú digital basado en Yii2 Framework

REQUERIMIENTOS
------------

- Docker
- Git
- Composer


INSTALACION
------------

### 1. Obtener el repositorio de github

~~~
mkdir /path/to/my/project
cd /path/to/my/project
git init 
git clone git@github.com:DiegoSana/Comandas2.git Comandas2

~~~

### 2. Crear contenedores

~~~
mkdir --parents /path/to/my/project/Comandas2/storage/mysql
mkdir --parents /path/to/my/project/Comandas2/storage/logs
mkdir --parents /path/to/my/project/Comandas2/storage/app
cd /path/to/my/project/Comandas2
docker-compose up
~~~


CONFIGURACION
-------------

### Configuraciones de Yii2Framework

Archivo config/db.php
~~~php
return [
'class' => 'yii\db\Connection',
'dsn' => 'mysql:host=172.20.0.2;dbname=comandas2',
'username' => 'username',
'password' => 'password',
'charset' => 'utf8',
];
~~~

Instalar dependencias

```
cd /path/to/my/project/Comandas2/comandas2
composer install
```