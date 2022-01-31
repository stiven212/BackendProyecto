# Manual de instalación

### Para realizar la instalación del sistema backend seguir los siguientes pasos.

Previamente se requiere tener instalado el servicio de XAMPP o LAMPP dependiendo el sistema operativo.
Tambien se requiere tener Git y Node JS.

#### Pasos

1. Ejecutar el siguiente comando dentro de una Git Bash git clone https://github.com/stiven212/BackendProyecto.git
2. Acceder a la aplicación con el comando cd BackendProyecto.
3. Ejecutar el siguiente comando una vez se encuentre dentro del directorio npm i
4. Abrir el proyecto con un editor (se recomienda PHPStorm)
5. Dentro del .env establecer el nombre de la base de datos a usar, se requiere crear una base con el nombre que se especifique en el .env
6. Para ejecutar el servidor se requiere que se ejecute el servidor de Apache y la base de datos que se especifique en el XAMPP o LAMPP.
7. Ejecutar el comando php artisan serve para que se ejecute el servidor local.
8. Se ejecuta el comando php artisan migrate:fresh --seed para completar la base de datos con las colecciones y datos aleatorios para poder probar la aplicación y ejecutar algun CRUD.

## En el caso de que se requiera desplegar la aplicación, se recomienda usar el servicio de Digital Ocean siguiendo el tutorial que se presenta en el enlace [tutorial](https://www.youtube.com/watch?v=qkg5Cufa-C8&ab_channel=DigitalOcean)
