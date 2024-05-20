# Crud Documentos 🚀

Prueba técnica: desarrollo de CRUD de registro de documentos utilizando PHP.

## Caracteristicas

- Login 
    - Datos de ingreso: (usuario: admin@gmail.com - contraseña: admin123)✅
- Logout✅
- Gestión de documentos:
    -Tabla o grilla de datos de los documentos Búsqueda de registro de documentos. ✅
    -Creación de registro de documentos. ✅
    -Edición de registro de documentos. ✅
    -Eliminación de registro de documentos. ✅

## Tecnologias utilizadas

* PHP 8.1.13
* [Laravel](https://laravel.com/docs/10.x) - El framework backend web usado
* [Vue](https://vuejs.org/guide/introduction.html) - El framework frontend web usado
* Composer
* Node.js 20.9.0
* MySQL

## Instalacion 🔧

#### Clona el Repositorio
```bash
git clone https://github.com/Keniier/crud_documents
cd crud_documents
```
#### Copia o duplica el archivo .env.example, nómbralo .env y edita las credenciales para la base de datos.

#### Instalar atraves de Composer
```bash
composer install
```

#### Generar Application Key y Link Storage
```bash
php artisan key:generate
php artisan storage:link
```

#### Migrar base de datos y datos precargados
```bash
php artisan migrate --seed
```

#### Instalar Dependencia Node.js
```bash
npm install
# o
yarn install
```

#### Copilar FrontEnd
```bash
npm run build
```

#### Ejecutar el proyecto
```bash
php artisan serve
```

#### Credenciales de ingreso
```
Usuario-Email: admin@gmail.com
contraseña: admin123
```

#### Diagrama
![Diagrama de Us0](/public/img/Uso.png)
![Diagrama de MVC](/public/img/MVC.jpg)

## Autor ✒️

* **Kenier Morales** - *Dev* - [KeniierM](https://github.com/Keniier)(https://www.linkedin.com/in/keniierm/)
