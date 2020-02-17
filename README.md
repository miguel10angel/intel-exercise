

## Instalacion del proyecto

Requisitos
- Php 7.4
- Laravel 6.14
- Mysql
- composer 1.6.3
- Bootstrap 4.0

Plugins utilizados
- DataTable*
- DatePicker*
- SweetAlert*

*instalados atravez de CDN.


## Proceso de instalación

Despues de haber clonado el repositorio se deveran de seguir los siguientes pasos:

- Instalar las librerias necesarias para el proyecto con el comando **composer install**.
- Copiar el archivo .env.example con el nombre .env, este se encuenta en la raiz del proyecto.
- Generar una clave de proyecto con el comando **php artisan key:generate**
- Crear una base de datos en MySql.
- Editar el archivo .env con la configuracion de acceso a la BD, acontinuacion se muestra un ejemplo de configuración:
- **DB_CONNECTION=mysql**
- **DB_HOST=127.0.0.1**
- **DB_PORT=3306**
- **DB_DATABASE=DB_NAME**
- **DB_USERNAME=root**
- **DB_PASSWORD=SECRET**

- Actualizar la configuración con el comando **php artisan config:cache**
- Ejecutar la migración con el comando **php artisan migrate**, para esta parte se está utilizando el ORM que incluye Laravel el cual es Eloquent.

- Correr el servidor de artisan con **php artisan serve**
- Verificar que el proyecto este corriendo accediendo al navegador que indique el servidor de artisan, por lo regular suele ser http://127.0.0.1:8000/


## Archivos extras que se incluyen
En el directorio resources/docs se incluyen 2 archivos:
1. El script de mysql para la creación de la tabla usuarios en caso de ser requerida.
2. Un archivo de excel nombrado **Users** que servirá de guía para la carga masiva de usuarios.


## Funcionamiento del código

La primer vista que se muestra será una tabla con la lista de usuarios registrados, en la parte superior izquierda se encontran con 2 botones, el primero con la leyenda "Nuevo usuario" el cual abrirá un modal que permitirá hacer el registro de un nuevo usuario al llenar el fomulario.
El segundo boton con la leyenda "Importar usuarios" redireccionará a una segunda vista en la cual se podra hacer la carga masiva de usuarios haciendo uso de un archivo excel.

Dentro del listado de usuarios se incluyen 2 botones por cada registro, el primero abre un modal para mostar los detalles del usuario, el segundo boton abre un dialogo el cual pide una confirmación para proceder a eliminar el registro.

Dentro de la vista de Importar usuarios se muestra un panel en el cual se podra seleccionar el archivo excel a subir para la carga de usuarios, una vez seleccionado un archivo se muestra un checkbox en el cual se podrá decidir si se requiere limpiar la tabla de usuarios o los usuarios a ser cargados se sumaran a los registros existentes, por ultimo se escuentra el boton para el procesamiento del archivo, una vez que la importación de usuarios haya concluida se mostrara un resumen en la tabla que se encuentra debajo del primer panel, así mismo en la parte superior derecha aparecerá un segundo panel en el cual se indica cuantos usuarios fueron agregados.



Por otra parte, cada función empleada cuenta con su docuemtnación correspondiente.