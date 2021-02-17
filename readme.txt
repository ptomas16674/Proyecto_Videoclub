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
* Se trata de una peque�a aplicaci�n web dise�ada para ser usada por videoclubs de tama�o mediano.
* Dada la poca popularidad de los videoclubs hoy en d�a, he optado por darle un enfoque m�s digital a la hora de proporcionar el producto al cliente, realizando algo parecido 
* a un servicio de alquiler( v�ase Netflix ).
* He subido s�lo los archivos que yo he creado o modificado, ya que el framework pesa lo suyo.

## Resumen de Apartados de la aplicaci�n

* Cat�logo: Donde el usuario podr� ver las distintas categor�as por las que filtrar los productos existentes.
* Ubicaci�n: Un modal que muestra la localizaci�n actual del negocio.
* Datos IMDB: Un modal que muestra un cuadro de b�squeda, donde el usuario podr� ver los datos de la pel�cula que quiera, siendo estos datos recibidos a trav�s de una API parecida a la de IMDB.
* Acceso para empleados: Permite acceder a diferentes funciones de gesti�n del local mediante las credenciales correctas.
* Gestionar personal: Permite a�adir, ver, editar y eliminar ( si es que se tienen los permisos adecuados ) los datos de los distintos empleados.
* Gestionar inventario: Permite a�adir, ver, editar y eliminar ( si es que se tienen los permisos adecuados ) los datos de las pel�culas.
* Barra de b�squeda: Una barra presente de forma global que permite al usuario encontrar pel�culas del inventario mediante varios tipos de datos de las mismas.
* Pago: Si la pel�cula no est� en estado de alquiler y el usuario desea verla, este tendr� que pagar una cantidad predeterminada en la base de datos para poder acceder al contenido. El pago se realiza mediante la API de Paypal y posee opciones tanto para el evento de cancelaci�n del pago o error en el proceso.
