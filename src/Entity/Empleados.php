<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="empleados")
 */
class Empleados
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer",name="numero_empleado")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $apellido;

    /**
     * @ORM\Column(type="integer")
     */
    private $fecha_nacimiento;

    /**
     * @ORM\Column(type="integer")
     */
    private $fecha_inicio;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fecha_final;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $horario;

    /**
     * @ORM\Column(type="integer")
     */
    private $salario;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $alias;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $clave;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getFechaNacimiento(): ?int
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(int $fecha_nacimiento): self
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    public function getFechaInicio(): ?int
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(int $fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFinal(): ?int
    {
        return $this->fecha_final;
    }

    public function setFechaFinal(?int $fecha_final): self
    {
        $this->fecha_final = $fecha_final;

        return $this;
    }

    public function getHorario(): ?string
    {
        return $this->horario;
    }

    public function setHorario(string $horario): self
    {
        $this->horario = $horario;

        return $this;
    }

    public function getSalario(): ?int
    {
        return $this->salario;
    }

    public function setSalario(int $salario): self
    {
        $this->salario = $salario;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): self
    {
        $this->clave = $clave;

        return $this;
    }
}
