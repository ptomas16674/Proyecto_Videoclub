<?php 
/*
 * Nombre del controlador: EmpleadosLogin
 * Función:
 * Renderiza la pantalla de login de la aplicación, cuyo resultado es controlado por el archivo "Security.yaml". 
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class EmpleadosLogin extends AbstractController{
    /**
     * @Route("/Login", name="Login")
     */
    public function Login(){    
        return $this->render('Login.html.twig');
    }    
}