# 📘 Proyecto PHP con Doctrine y Docker

Este es un proyecto de PHP que implementa el patrón Ports and Adapters junto con Domain-Driven Design (DDD). Usa Docker para facilitar la configuración y gestión del entorno de desarrollo.

---

## 🚀 Requisitos

Antes de comenzar, asegúrate de tener instalados los siguientes programas en tu sistema:

- [Docker](https://www.docker.com/get-started)
- [Make](https://www.gnu.org/software/make/)

---

## 📦 Instalación y configuración

### 1️⃣ Clonar el repositorio

```sh
git clone https://github.com/nicolasfromerom/prueba_tecnica.git
cd prueba_tecnica
```

### 2️⃣ Levantar los servicios con Docker

Ejecuta el siguiente comando para iniciar los contenedores:

```sh
make up
```

### 3️⃣ Ejecutar la migración de la base de datos

Ejecuta la migración para crear las tablas necesarias en MySQL:

```sh
make migrate
```

Durante la ejecución de este paso, se te solicitará la contraseña de la base de datos. Ingresa:

```
rootpassword
```

### 4️⃣ Verificar los contenedores en ejecución

Para asegurarte de que los servicios están corriendo correctamente, usa:

```sh
docker ps
```

Deberías ver los contenedores `php_app` y `mysql_db` en ejecución.

### 5️⃣ Acceder al contenedor de PHP

Si necesitas ejecutar comandos dentro del contenedor de PHP, usa:

```sh
docker exec -it php_app bash
```

---

## 🛠 Comandos disponibles

| Comando        | Descripción                                    |
| -------------- | ---------------------------------------------- |
| `make up`      | Inicia los contenedores y configura el entorno |
| `make migrate` | Genera la base de datos y tablas              |
| `make tests`   | Ejecuta las pruebas con PHPUnit                |
| `make down`    | Detiene los contenedores de Docker             |
| `make logs`    | Muestra los logs de los contenedores           |
| `make shell`   | Abre una terminal dentro del contenedor PHP    |

---

## 🛑 Apagar el proyecto

Si deseas detener los contenedores, usa:

```sh
make down
```

¡Listo! Ahora puedes empezar a desarrollar 🚀

