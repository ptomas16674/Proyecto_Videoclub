<?php
/*
 * Nombre del controlador: Catalogo
 * Función:
 * Controla todo lo referente a la parte administrativa del inventario en la aplicación a través de las siguientes funciones:
    * -Ver_Catalogo:
    *      Se encarga sencillamente de renderizar la plantilla "Catalogo", donde se muestran las diferentes catagorías del mismo
    * 
    * -Busqueda:
    *      Primero revisa que exista un POST con los datos del dato y del campo que se quiera buscar, si no es así, redirige a la ruta "Home".
    *      Por el contrario, si todo va bien, realiza una consulta a la BD buscando que el campo coincida con los datos buscados.
    *      Si encuentra algún resultado, renderiza la plantilla "Filtrar_Categorias" donde se mostrarán los datos de la categoría buscada.
    *      Si no encuentra ningún resultado, se renderizará la plantilla "Errores", mostrando el pertinente mensaje por categoría.
    * 
    * -Filtrar_Nombre:
    *      Esta función requiere código propio ya que se encarga de filtrar los nombres de todas las películas, sin importar cualquier otro dato, de forma alfabética.
    *      Una vez filtradas, se renderiza la plantilla "Filtrar_Categorias" con los datos pertinentes.
    *      Si no encuentra ningún dato, renderiza la plantilla "Errores" con el mensaje adecuado.
 * 
 * Todas las demás categorías y la filtración de sus datos responde a la llamada de estas dos funciones con el dato correspondiente:
    * -Ver:
    *      Función que se encarga de encontrar los distintos datos del campo que se le asigne para su posterior filtración.
    *      Hecho esto, renderiza la plantilla "Filtrar_Categorias".
    *      Si no encuentra resultados, renderiza la plantilla "Errores" con el mensaje pertienente a cada campo.
    * 
    * -Filtrar:
    *      A través del atributo elemento que se le envía cuando el usuario pulsa sobre el campo que desea filtrar en la plantilla "Filtrar_Categorias" y el atributo dato de la misma,
    *      esta funcion busca los datos propios de cada película de la DB correspondientes a los atributos.
    *      Si encuentra resultados, se renderiza la plantilla "Filtrar", si no es así, se renderiza la plantilla "Errores", donde se mostrará un mensaje con los atributos buscados.
    * 
    * -Alquilar:
    *      Función que, através de un ID de película, consigue ciertos datos de esta misma,entre ellos, su estado.
    *      Si no existen datos para el ID seleccionado o el estado de la película es igual a 1, renderiza la plantilla "Reproductor" con el pertinente mensaje.
    *      Por el contrario, si todo es correcto, se envia al usuario a la plantilla "Pago" para su alquiler.
    * 
    * -Reproductor:
    *      Comprueba que exista un POST con el ID de la película, que es enviado una vez el usuario haya realizado el pago correctamente en la plantilla "Pago".
    *      Si no es así, muestra en la plantilla "Reproductor" un mensaje de error.
    *      Por el contrario, busca a través de una consulta SQL el nombre y el id de la película para su posterior visualizado en la susodicha plantilla, así como
    *      para cambiar el estado de la misma a 1, indicando que la película está alquilada.
    * 
    * -Terminar:
    *      Función que, a través de la pulsación de un botón, envía el ID de la película en reproducción y cambia su estado a 0, indicando que es posible su alquiler.
    *      Si este botón no fuere pulsado, se tendría que cambiar el estado de forma manual.
    *      Por otro lado, si el ID enviado es inexistente, se enviaría al usuario al la ruta "Home".
    *      Por el contrario, si todo es correcto, se reenviaría al usuario a la ruta "Catalogo".
    *     
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Catalogo extends AbstractController
{
    /**
     * @Route("/Catalogo", name="Catalogo")
     */
    public function Ver_Catalogo()
    {
        return $this->render('Catalogo.html.twig');
    }
    
    /**
    * @Route("/Catalogo/Buscar",name="Buscar")
    */
    public function Busqueda()
    { 
        if (isset($_POST['dato']) and isset($_POST['campo'])){                   
            $dato=$_POST['dato'];
            $campo=$_POST['campo'];
            $manager= $this->getDoctrine()->getManager();
            $consulta=$manager->createQuery(
                "SELECT inv.nombre_pelicula,inv.id,inv.fecha_lanzamiento,inv.genero,inv.origen,inv.Duracion,inv.precio,inv.alquilada from App\Entity\Catalogo inv where inv.$campo like '%$dato%'"
            );
            $pelicula=$consulta->getResult();
             
             if ($pelicula!=[]){
                 return $this->render("Filtrar_Categorias.html.twig",array("nombres"=>$pelicula));
             }else{
                 return $this->render("Errores.html.twig",array('error_busqueda'=>$dato,'error_campo'=>$campo));
             }
         }else{
             return $this->redirectToRoute('Home');
         }             
    }   
    
    /**
    * @Route("/Catalogo/Nombres",name="Cat_Nombres")
    */
    public function Filtrar_Nombres()
    {
        $manager = $this->getDoctrine()->getManager();
        $error=[];
        $consulta_nombres=$manager->createQuery(
            "SELECT cat.nombre_pelicula,cat.id,cat.fecha_lanzamiento,cat.genero,cat.origen,cat.Duracion,cat.alquilada,cat.precio from App\Entity\Catalogo cat order by cat.nombre_pelicula"
        );
        $nombres=$consulta_nombres->getResult();

        if ($nombres===[]){
            return $this->render("Errores.html.twig",array('error_nombres'=>$error));
        }else{
            return $this->render("Filtrar_Categorias.html.twig", array('nombres' => $nombres));
        }
    }
   
    public function Ver($campo)
    {
        $manager = $this->getDoctrine()->getManager();
        $error=[];
        $consulta=$manager->createQuery(
            "SELECT DISTINCT cat.$campo from App\Entity\Catalogo cat ORDER BY cat.$campo"
        );
        $final=$consulta->getResult();

        if ($final!=[]){
           return $this->render("Filtrar_Categorias.html.twig",array("$campo"=>$final));
        }else{
            return $this->render("Errores.html.twig",array("error_$campo"=>$error));
        }
    }
    
    public function Filtrar($elemento,$nombre)
    {
        $manager = $this->getDoctrine()->getManager();
        $error=[];

        $consulta=$manager->createQuery(
            "SELECT cat.nombre_pelicula,cat.id,cat.fecha_lanzamiento,cat.genero,cat.origen,cat.Duracion,cat.alquilada,cat.precio from App\Entity\Catalogo cat where cat.$elemento='$nombre'"
        );
                
        $final=$consulta->getResult();
        
        if ($final!=[]){       
            return $this->render("Filtrar.html.twig", array('datos' =>$final));
        }else{  
            return $this->render("Errores.html.twig",array("error_filtrar"=>$error,'elemento'=>$elemento));
        }
    }
   
    /**
    * @Route("/Catalogo/Generos",name="Cat_Generos")
    */
    public function Ver_Generos()
    {
        return $this->Ver("genero");
    }
    
    /**
    * @Route("/Catalogo/Generos/{genero}",name="FiltrarGeneros")
    */
    public function FiltrarGeneros($genero)
    {
       if ($genero!=null){
           return $this->Filtrar("genero",$genero);
       }
    }
    
    /**
    * @Route("/Catalogo/Fechas",name="Cat_Fechas")
    */
    public function Ver_Fechas()
    {
       return $this->Ver("fecha_lanzamiento");
    }
    
    /**
    * @Route("/Catalogo/Fecha/{fecha}",name="Filtrar_Fecha")
    */
    public function FiltrarFecha($fecha)
    {
      if ($fecha!=null){
          return $this->Filtrar("fecha_lanzamiento",$fecha);
       }
    }
    
    /**
    * @Route("/Catalogo/Duracion",name="Cat_Duracion")
    */
    public function Ver_Duracion()
    {
        return $this->Ver("Duracion");
    }
    
    /**
    * @Route("/Catalogo/Duracion/{duracion}",name="FiltrarDuracion")
    */
    public function FiltrarDuracion($duracion)
    {
        if ($duracion!=null){
          return $this->Filtrar("Duracion",$duracion);
       }
    }
    
    /**
    * @Route("/Catalogo/Precio",name="Cat_Precio")
    */
    public function Ver_Precios()
    {
       return $this->Ver("precio");
    }
    
    /**
    * @Route("/Catalogo/Precio/{precio}",name="FiltrarPrecio")
    */
    public function FiltrarPrecio($precio)
    {
        if ($precio!=null){
          return $this->Filtrar("precio",$precio);
       }
    }
    
    /**
    * @Route("/Catalogo/Paises",name="Cat_Paises")
    */
    public function Ver_Paises()
    {
       return $this->Ver("origen");
    }
    
    /**
    * @Route("/Catalogo/Paises/{pais}",name="FiltrarPais")
    */
    public function FiltrarPais($pais)
    {
        if ($pais!=null){
          return $this->Filtrar("origen",$pais);
       }
    }
    
    /**
    * @Route("/Alquiler/Comprar/{id}",name="Alquilar")
    */
    public function Alquilar($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $error=[];

        $consulta=$manager->createQuery(
               "SELECT cat.id,cat.nombre_pelicula,cat.precio,cat.alquilada from App\Entity\Catalogo cat where cat.id='$id'"
        );
                
        $final=$consulta->getResult();
        
        if (isset($final[0])){
            if (in_array("1", $final[0])){
                return $this->render("Reproductor.html.twig",array("error_estado"=>$error));
            }else{
                return $this->render("Pago.html.twig", array('datos' => $final));
            }          
        }else{
             return $this->render("Reproductor.html.twig",array("error"=>$error));
        }
        
    }
 
    /**
    * @Route("/Alquiler/Reproductor",name="Reproductor")
    */
    public function Reproductor()
    {   
        $error=[];
        if (isset($_POST['id'])){
            $id=$_POST['id'];
            $manager = $this->getDoctrine()->getManager();     
            $consulta=$manager->createQuery(
                "SELECT cat.nombre_pelicula,cat.id from App\Entity\Catalogo cat where cat.id='$id'"
            );
            
            $final=$consulta->getResult();
            $pelicula = $manager->getRepository(\App\Entity\Catalogo::class)->find($id);
            $pelicula->setAlquilada("1");
            $manager->flush();
            return $this->render("Reproductor.html.twig", array('datos' => $final));
        }else{
            return $this->render("Reproductor.html.twig",array("error"=>$error));
        }
    }
    
    /**
    * @Route("/Alquiler/Fin/{id}",name="TerminarReproduccion")
    */
    public function terminar($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $pelicula = $manager->getRepository(\App\Entity\Catalogo::class)->find($id);

        if ($pelicula!=[]){
            $pelicula->setAlquilada("0");
            $manager->flush();
            return $this->redirectToRoute('Catalogo');
        }else{
            return $this->redirectToRoute('Home');
        }
            
    }
}
