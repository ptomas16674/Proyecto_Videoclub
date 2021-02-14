<?php
/*
 * Nombre del controlador: Administrador
 * Función:
 * Controla todo lo referente a la parte administrativa de los empleados en la aplicación a través de las siguientes funciones:
    * -Login_Correcto:
    *      Controla que el usuario esté logueado antes de poder entrar a las funciones de administrador.
    *      Si no es así, redirige a la plantilla "Errores" para mostrar el mensaje correspondiente.
    *      Si el usuario está logeado correctamente, se le redigire a la plantilla "Admin", donde podrá elegir qué acción realizar.
    * 
    * -Ver_personal:
    *      Función que, una vez que el usuario está logueado, se encarga de buscar los datos de todos los empleados a través de una consulta SQL, y tras obtenerlos, muestra dichos datos en 
    *      la plantilla "Personal".
    *      Si por el contrario, el usuario no se ha registrado debidamente e intenta acceder a dicha función/ruta, se le redirigirá a la plantilla "Errores" para mostrar el correspondiente 
    *      mensaje.
    * 
    * -Editar_Personal:
    *      Se encargarga,tras haber comprobado que el usuario esté dentro del sistema, de localizar los datos del usuario que se le pase a la hora de realizar la llamada a la ruta.
    *      Una vez se obtengan los datos, se mostrarán en la plantilla "PersonalEdición" para, una vez comprobado que el usuario posee permisos de administrador, su modificación.
    * 
    * -Editar_Personal_Update:
    *      Controla que primero haya habido un POST con el ID del empleado, para proporcionar seguridad, si est POST no existe o está vacío, se redirige al usuario a la ruta "Home".
    *      Por el contrario, si existe, se llama a la función UpdateEmpleados con el Post que contiene el ID del empleado para su edición. Si se ha realizado correctamente, cosa que se
    *      controla en la plantilla, redirige al usuario a la plantilla "Resultado" junto a la información del empleado para su posterior visualizado.
    * 
    * -DeletePersonal:
    *      Comprueba en primer lugar que el usuario esté logueado ( si no es así, se le redirige a la plantilla "Errores" ) y que este usuario tenga permisos administrativos 
    *      ( de nuevo, si no es así, redirige a "Errores" con otro mensaje ).
    *      Dado que para llamar a la ruta se necesita el ID de un empleado, la función busca ciertos datos del empleado y los muestra en la plantilla "ConfirmarEliminar", para mayor seguridad 
    *      a la hora de manejar datos sensibles.
    * 
    * -DeletePersonal_Delete:
    *      Función que, tras las pertientes comprobaciones de seguridad, llama a la función DeleteEmpleadosFunction, que busca al empleado según su ID y se encarga de borrarlo de la DB.
    *      Si se llegase a esta función sin poner un ID de empleado, se llevaría al usuario a una página de error con el mensaje apropiado y si se llegase a esta función con un ID inexistente,
    *      se llevaría al usuario, más experimentado dado que es un administrador, a una página propia del framework.
    * 
    * -AddPersonal:
    *      Función que permite añadir empleados a través de la llamada a la función AddEmpleado con los datos del mismo, resultando en la redirección a la plantilla "Admin_Personal" para su 
    *      visualizado en la tabla de la plantilla.
    *      No existen comprobaciones de seguridad, ya que la llamda a la ruta está oculta por un "include" y al acceder a dicha ruta, se le pide al usuario sus credenciales,y si estas son correctas,
    *      se le redirige al panel de administrador, todo ello en un ciclo perpetuo.
    * 
 * Las posteriores funciones a este conjunto funcionan de manera igual, sólo que cambiando los datos a los parámetros propios del inventario.
 * Como aclaración, esta parte de la aplicación ha sido realizada con una metodología más "simple", el proposito es mostrar que el alumno puede hacer el código de forma simple y de forma más 
 * "avanzada", cosa que ocurre en el controller Catalogo
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Administrador extends AbstractController
{
    /**
     * @Route("/Admin", name="Admin")
     */
    public function Login_Correcto()
    {
        if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY') ){
            $user = $this->getUser();
        
            $cookie_name = "usuario";
            $cookie_value = "Sí";
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        
            return $this->render('Admin.html.twig',array("usuario"=>$user));   
        }else{
            return $this->render("Errores.html.twig",array('error_login'=>[]));
        }
    }
        
    /**
    * @Route("/Admin/Personal",name="Admin_Personal")
     * 
    */
    public function Ver_personal()
    {
        if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
            $manager = $this->getDoctrine()->getManager();
            $consulta_personal=$manager->createQuery(
                "SELECT emp from App\Entity\Empleados emp"
            );
            $personal=$consulta_personal->getResult();
        
            return $this->render("Personal.html.twig", array('datos' =>$personal));
        }else{
            return $this->render("Errores.html.twig",array('error_login'=>[]));
        }
    }

    /**
    * @Route("/Admin/Personal/{id}",name="Admin_Personal_Editar")
    * 
    */
    public function Editar_personal($id)
    {
        if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
            $manager = $this->getDoctrine()->getManager();
            $consulta=$manager->createQuery("SELECT emp from App\Entity\Empleados emp where emp.id='$id'");
            $persona=$consulta->getResult();
            return $this->render("PersonalEdicion.html.twig", array('datos' =>$persona));
        }else{
            return $this->render("Errores.html.twig",array('error_login'=>[]));
        }
    }
    
    /**
    * @Route("/Admin/Personal/Edicion/Update",name="UpdatePersonal")
    * 
    */
    public function Editar_Personal_Update()
    {   
       if (isset($_POST['id'])){ 
            if ($this->UpdateEmpleados($_POST['id'],$_POST['nombre'],$_POST['apellido'],$_POST['fecha_nacimiento'],$_POST['fecha_inicio'],$_POST['fecha_final'],$_POST['horario'],$_POST['salario'],$_POST['alias'],$_POST['clave'])){
                $manager = $this->getDoctrine()->getManager();                        
                $empleado = $manager->getRepository(\App\Entity\Empleados::class)->find($_POST['id']);
                return $this->render("Resultado.html.twig",array("empleado"=>$empleado));
            }
       }else{
           return $this->redirectToRoute('Home');
       }
    }
    
    /**
     * @param $Id
     * @param $nombre
     * @param $apellido
     * @param $fecha_nacimiento
     * @param $fecha_inicio
     * @param $fecha_final
     * @param $horario
     * @param $salario
     * @param $alias 
     * @param $clave
     * @return string
     * @throws \Exception
     */
    public function UpdateEmpleados($id,$nombre,$apellido,$fecha_nacimiento,$fecha_inicio,$fecha_final,$horario,$salario,$alias,$clave){
        $manager= $this->getDoctrine()->getManager();
        $empleado = $manager->getRepository(\App\Entity\Empleados::class)->find($id);
            
        if (!$empleado) {
            throw $this->createNotFoundException('No existe ningun empleado con id:  '.$id);
        } 

        $empleado->setNombre($nombre);
        $empleado->setApellido($apellido);
        $empleado->setFechaNacimiento($fecha_nacimiento);
        $empleado->setFechaInicio($fecha_inicio);
        $empleado->setFechaFinal((int)$fecha_final);
        $empleado->setHorario($horario);
        $empleado->setSalario($salario);
        $empleado->setAlias($alias);
        $empleado->SetClave($clave);
        $manager->flush();
        return 1;
    }
    
    /**
    * @Route("/Admin/Personal/Edicion/Delete/{id}",name="DeletePersonal")
    * 
    */
    public function DeletePersonal($id)
    {             
        if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
            if ($this->getUser()->getAdmin()==1){
                $manager = $this->getDoctrine()->getManager();
                $consulta=$manager->createQuery("SELECT emp from App\Entity\Empleados emp where emp.id='$id'");
                $final=$consulta->getResult();
        
                return $this->render("ConfirmarEliminar.html.twig",array('empleado'=>$final));
            }else{
                return $this->render("Errores.html.twig",array('error_login_admin'=>[]));
            }
        }else{
            return $this->render("Errores.html.twig",array('error_login'=>[]));
        }
    }
    
    /**
    * @Route("/Admin/Personal/Edicion/Delete/Confirmed/{id}",name="DeletePersonal_Confirmado")
    * 
    */
    public function DeletePersonal_Delete($id)
    {      
        if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
            if ($this->getUser()->getAdmin()==1){
                if ($this->DeleteEmpleadosFunction($id)){
                   return $this->redirectToroute('Admin_Personal');             
                }   
            }else{
                 return $this->render("Errores.html.twig",array('error_login_admin'=>[]));
            }
        }else{
            return $this->render("Errores.html.twig",array('error_login'=>[]));
        }
    }
    
     /**
     * @param $Id
     * @return string
     * @throws \Exception
     */
    public function DeleteEmpleadosFunction($id){
            $manager= $this->getDoctrine()->getManager();
            $empleado = $manager->getRepository(\App\Entity\Empleados::class)->find($id);
            
            if (!$empleado) {
                throw $this->createNotFoundException('No existe ningun empleado con id:  '.$id);
            } 
            
            $manager->remove($empleado);
            $manager-> flush();
            
            return 1;
    }
    
    /**
    * @Route("/Admin/Personal/Edicion/AddPersonal",name="FormAddPersonal")
    * 
    */
    public function AddPersonal()
    {        
        if (isset($_POST['nombre'])){ 
            if ($this->AddEmpleado($_POST['nombre'],$_POST['apellido'],$_POST['fecha_nacimiento'],$_POST['fecha_inicio'],$_POST['fecha_final'],$_POST['horario'],$_POST['salario'],$_POST['alias'],$_POST['clave'])){
                 return $this->redirectToRoute('Admin_Personal');
            }
       }else{
            return $this->render("Login.html.twig");
       }
    }
    
    /**
     * @param $Id
     * @param $nombre
     * @param $apellido
     * @param $fecha_nacimiento
     * @param $fecha_inicio
     * @param $fecha_final
     * @param $horario
     * @param $salario
     * @param $alias
     * @param $clave 
     * @return string
     * @throws \Exception
     */
    public function AddEmpleado($nombre,$apellido,$fecha_nacimiento,$fecha_inicio,$fecha_final,$horario,$salario,$alias,$clave){
            $manager= $this->getDoctrine()->getManager();
            
            $emp=new \App\Entity\Empleados();
            $emp->setNombre($nombre);
            $emp->setApellido($apellido);
            $emp->setFechaNacimiento($fecha_nacimiento);
            $emp->setFechaInicio($fecha_inicio);
            $emp->setFechaFinal($fecha_final);
            $emp->setHorario($horario);
            $emp->setSalario($salario);
            $emp->SetAlias($alias);
            $emp->SetClave($clave);

            $manager->persist($emp);
            $manager->flush();
                
            return 1;
    }

    /**
    * @Route("/Admin/Inventario",name="Admin_Inventario")
     * 
    */
    public function Ver_Inventario()
    {
        $manager = $this->getDoctrine()->getManager();
        $consulta_inventario=$manager->createQuery(
            "SELECT cat from App\Entity\Catalogo cat"
        );
        $inventario=$consulta_inventario->getResult();
        
        return $this->render("Inventario.html.twig", array('datos' =>$inventario));
    }
    
    /**
    * @Route("/Admin/Inventario/{id}",name="Admin_Inventario_Editar")
    * 
    */
    public function Editar_Inventario($id)
    {
        if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
            $manager = $this->getDoctrine()->getManager();
            $consulta=$manager->createQuery("SELECT inv.nombre_pelicula,inv.id,inv.fecha_lanzamiento,inv.genero,inv.origen,inv.Duracion,inv.precio,inv.alquilada from App\Entity\Catalogo inv where inv.id='$id'");
            $item_editar=$consulta->getResult();
        
            return $this->render("InventarioEdicion.html.twig", array('datos' =>$item_editar));
        }else{
            return $this->render("Errores.html.twig",array('error_login'=>[]));
        }
    }
    
    /**
    * @Route("/Admin/Inventario/Edicion/Update",name="UpdateInventario")
    * 
    */
    public function Editar_Inventario_Update()
    {  
       if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){ 
            if (isset($_POST['id'])){ 
                if ($this->UpdateInventario($_POST['id'],$_POST['nombre_pelicula'],$_POST['fecha_lanzamiento'],$_POST['genero'],$_POST['origen'],$_POST['Duracion'],$_POST['precio'],$_POST['estado'])){
                    $manager = $this->getDoctrine()->getManager();                        
                    $pelicula = $manager->getRepository(\App\Entity\Catalogo::class)->find($_POST['id']);
                    return $this->render("Resultado.html.twig",array("peli"=>$pelicula));
                }
            }else{
                return $this->redirectToRoute('Login');
            }
       }else{
           return $this->render("Errores.html.twig",array('error_login'=>[]));
       }
    }
    
     /**
     * @param $Id
     * @param $nombre
     * @param $apellido
     * @param $fecha_lanzamiento
     * @param $genero
     * @param $origen
     * @param $duracion
     * @param $precio
     * @param $estado
     * @throws \Exception
     */
    public function UpdateInventario($id,$nombre,$fecha_lanzamiento,$genero,$origen,$duracion,$precio,$estado){
            $manager= $this->getDoctrine()->getManager();
            $pelicula = $manager->getRepository(\App\Entity\Catalogo::class)->find($id);
            
            if (!$pelicula) {
                throw $this->createNotFoundException('No existe ninguna pelicula con id:  '.$id);
            } 

            $pelicula->setNombrePelicula($nombre);
            $pelicula->setFechaLanzamiento($fecha_lanzamiento);
            $pelicula->setGenero($genero);
            $pelicula->setOrigen($origen);
            $pelicula->setDuracion($duracion);
            $pelicula->setPrecio($precio);
            $pelicula->setAlquilada((int)$estado);
            $manager->flush();
            return 1;
    }
    
    /**
    * @Route("/Admin/Inventario/Edicion/Delete/{id}",name="DeleteInventario")
    * 
    */
    public function DeleteInventario($id)
    {          
        if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){ 
            if ($this->getUser()->getAdmin()==1){
                $manager = $this->getDoctrine()->getManager();
                $consulta=$manager->createQuery("SELECT inv from App\Entity\Catalogo inv where inv.id='$id'");
                $final=$consulta->getResult();
        
                return $this->render("ConfirmarEliminar.html.twig",array('peli'=>$final));
            }else{
                return $this->render("Errores.html.twig",array('error_login_admin'=>[]));
            }
        }else{
            return $this->render("Errores.html.twig",array('error_login'=>[]));
        }
    }
    
    /**
    * @Route("/Admin/Inventario/Edicion/Delete/Confirmed/{id}",name="DeleteInventario_Confirmado")
    * 
    */
    public function DeleteInventario_Delete($id)
    {
        if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){ 
            if ($this->getUser()->getAdmin()==1){
                 if ($this->DeleteInventarioFunction($id)){
                    return $this->redirectToroute('Admin_Inventario');          
                }
            }else{
                return $this->render("Errores.html.twig",array('error_login_admin'=>[]));
            }
        }else{
             return $this->render("Errores.html.twig",array('error_login'=>[]));
        }
    }
    
     /**
     * @param $Id
     * @return string
     * @throws \Exception
     */
    public function DeleteInventarioFunction($id){
            $manager= $this->getDoctrine()->getManager();
            $pelicula = $manager->getRepository(\App\Entity\Catalogo::class)->find($id);
            
            if (!$pelicula) {
                throw $this->createNotFoundException('No existe ninguna pelicula con id:  '.$id);
            } 
            
            $manager->remove($pelicula);
            $manager-> flush();
            
            return 1;
    }
    
     /**
    * @Route("/Admin/Inventario/Edicion/AddInventario",name="FormAddInventario")
    * 
    */
    public function AddInventario()
    {        
        if (isset($_POST['nombre_pelicula'])){ 
            if ($this->AddCatalogo($_POST['nombre_pelicula'],$_POST['fecha_lanzamiento'],$_POST['genero'],$_POST['origen'],$_POST['Duracion'],$_POST['precio'],$_POST['estado'])){
                 return $this->redirectToRoute('Admin_Inventario');
            }
       }else{
            return $this->redirectToRoute('Home');
       }
    }
    
    /**
     * @param $nombre
     * @param $fecha_lanzamiento
     * @param $genero
     * @param $origen
     * @param $duracion
     * @param $precio
     * @param $estado
     * @throws \Exception
     */
    public function AddCatalogo($nombre,$fecha_lanzamiento,$genero,$origen,$duracion,$precio,$estado){
            $manager= $this->getDoctrine()->getManager();
            
            $peli=new \App\Entity\Catalogo();
            $peli->setNombrePelicula($nombre);
            $peli->setFechaLanzamiento($fecha_lanzamiento);
            $peli->setGenero($genero);
            $peli->setOrigen($origen);
            $peli->setDuracion($duracion);
            $peli->setPrecio($precio);
            $peli->setAlquilada($estado);

            $manager->persist($peli);
            $manager->flush();
            return 1;
    }
}
