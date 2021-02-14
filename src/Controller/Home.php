<?php 
namespace App\Controller;
// src/Controller/Home.php
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class Home extends AbstractController{
    /**
     * @Route("/Home", name="Home")
     */
    public function Inicio(){    
        return $this->render('Home.html.twig');
    }   
    
    /**
    * @Route("Home/mostrarEmpleados",name="Home_Empleados")
    */
    public function Home_Empleados()
    {
        $manager = $this->getDoctrine()->getManager();
        $destacados=[];
        $error_destacados=[];
        $consulta_destacados=$manager->createQuery(
            "SELECT emp from App\Entity\Empleados emp"
        );
        $destacados=$consulta_destacados->getResult();
        
        if ($destacados===[]){
           return $this->render("Errores.html.twig",array('error_empleados'=>$error_destacados));
        }else{
            return $this->render("Empleados_Destacados.html.twig", array('datos' => $destacados));
        }
    }
}


