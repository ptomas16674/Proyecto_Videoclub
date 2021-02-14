<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CatalogoRepository")
 */
class Catalogo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer",name="numero_pelicula")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre_pelicula;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fecha_lanzamiento;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $genero;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $origen;

    /**
     * @ORM\Column(type="integer")
     */
    private $alquilada;

    /**
     * @ORM\Column(type="integer")
     */
    private $Duracion;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroPelicula(): ?int
    {
        return $this->numero_pelicula;
    }

    public function setNumeroPelicula(int $numero_pelicula): self
    {
        $this->numero_pelicula = $numero_pelicula;

        return $this;
    }

    public function getNombrePelicula(): ?string
    {
        return $this->nombre_pelicula;
    }

    public function setNombrePelicula(string $nombre_pelicula): self
    {
        $this->nombre_pelicula = $nombre_pelicula;

        return $this;
    }

    public function getFechaLanzamiento(): ?int
    {
        return $this->fecha_lanzamiento;
    }

    public function setFechaLanzamiento(?int $fecha_lanzamiento): self
    {
        $this->fecha_lanzamiento = $fecha_lanzamiento;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getOrigen(): ?string
    {
        return $this->origen;
    }

    public function setOrigen(string $origen): self
    {
        $this->origen = $origen;

        return $this;
    }

    public function getAlquilada(): ?int
    {
        return $this->alquilada;
    }

    public function setAlquilada(int $alquilada): self
    {
        $this->alquilada = $alquilada;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->Duracion;
    }

    public function setDuracion(int $Duracion): self
    {
        $this->Duracion = $Duracion;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }
}
