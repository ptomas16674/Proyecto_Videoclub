<?php
/*
 * Nombre del controlador: Entrada
 * Función:
 * Renderiza la pantalla de bienvenida. 
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
class Entrada extends AbstractController{
    /**
     * @Route("/Entrada", name="Entrada")
     */
    public function Entrar(){    
        return $this->render('Index.html.twig');
    }    
}