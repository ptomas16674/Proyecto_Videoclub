<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity 
 * @ORM\Table(name="usuarios")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",name="Codigo")
     */
    private $Codigo;
    
    /**
     * @ORM\Column(type="string", length=20, name = "Alias")
     */
    private $Alias;
    
    /**
     * @ORM\Column(type="string", length=50, name = "Clave")
     */
    private $Clave;

    /**
     * @ORM\Column(type="integer",  name = "Admin")
     */
    private $Admin;

    /**
     * @return mixed
     */
    public function getAdmin(){
        return $this->Admin;
    }
    /**
     * @param mixed $Admin
     */
    public function setAdmin($Admin){
        $this->Admin = $Admin;
    }

    public function getCodigo(){
        return $this->Codigo;
    }

    public function setCodigo($Codigo){
        $this->Codigo = $Codigo;
    }
    public function getAlias(){
        return $this->Alias;
    }
    public function setAlias($Alias){
        $this->Alias = $Alias;
    }
    public function getClave(){
        return $this->Clave;
    }
    public function setClave($Clave){
        $this->Clave = $Clave;
    }

    public function serialize(){
        return serialize(array(
            $this->Codigo,
            $this->Alias,
            $this->Clave,
        ));
    }

    public function unserialize($serialized){
        list (
            $this->Codigo,
            $this->Alias,
            $this->Clave,
            ) = unserialize($serialized);
    }

    public function getRoles()
    {
        return array('ROLE_USER');            }

    public function getPassword()
    {
        return $this->getClave();
    }

    public function getSalt()
    {
        return;
    }

    public function getUsername()
    {
        return $this->getAlias();
    }

    public function eraseCredentials()
    {
        return;
    }
}