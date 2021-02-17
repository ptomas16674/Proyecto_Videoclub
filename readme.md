# Proyecto Videoclub
Proyecto Final de FP2

### Pre-requisitos
*  Symfony 1.1.5
*  Composer 2.0.3
*  Apache 2.4.46
*  PHP 7.4.11
*  PhpMyAdmin 5.0.3
*  MariaDB 10.4.14
*  Twig 2.7
*  Doctrine 2.7.0

## Construido con
* [NetBeans 12.2]( https://netbeans.apache.org/download/nb122/nb122.html )
* [Notepad++]( https://notepad-plus-plus.org/downloads/ )

## Resumen
* Se trata de una pequeña aplicación web diseñada para ser usada por videoclubs de tamaño mediano.
* Dada la poca popularidad de los videoclubs hoy en día, he optado por darle un enfoque más digital a la hora de proporcionar el producto al cliente, realizando algo parecido 
* a un servicio de alquiler( véase Netflix ).
* He subido sólo los archivos que yo he creado o modificado, ya que el framework pesa lo suyo.

## Resumen de Apartados de la aplicación

* Catálogo: Donde el usuario podrá ver las distintas categorías por las que filtrar los productos existentes.
* Ubicación: Un modal que muestra la localización actual del negocio.
* Datos IMDB: Un modal que muestra un cuadro de búsqueda, donde el usuario podrá ver los datos de la película que quiera, siendo estos datos recibidos a través de una API parecida a la de IMDB.
* Acceso para empleados: Permite acceder a diferentes funciones de gestión del local mediante las credenciales correctas.
* Gestionar personal: Permite añadir, ver, editar y eliminar ( si es que se tienen los permisos adecuados ) los datos de los distintos empleados.
* Gestionar inventario: Permite añadir, ver, editar y eliminar ( si es que se tienen los permisos adecuados ) los datos de las películas.
* Barra de búsqueda: Una barra presente de forma global que permite al usuario encontrar películas del inventario mediante varios tipos de datos de las mismas.
* Pago: Si la película no está en estado de alquiler y el usuario desea verla, este tendrá que pagar una cantidad predeterminada en la base de datos para poder acceder al contenido. El pago se realiza mediante la API de Paypal y posee opciones tanto para el evento de cancelación del pago o error en el proceso.
