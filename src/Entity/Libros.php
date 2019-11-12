<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LibrosRepository")
 */
class Libros
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titulo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Autores",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Autor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorias",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Categoria;

    /**
     * Libros constructor.
     */
    public function __construct($Titulo=null)
    {
        $this->$Titulo = $Titulo;

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->Titulo;
    }

    public function setTitulo(string $Titulo): self
    {
        $this->Titulo = $Titulo;

        return $this;
    }

    public function getAutor(): ?Autores
    {
        return $this->Autor;
    }

    public function setAutor(?Autores $Autor): self
    {
        $this->Autor = $Autor;

        return $this;
    }

    public function getCategoria(): ?Categorias
    {
        return $this->Categoria;
    }

    public function setCategoria(?Categorias $Categoria): self
    {
        $this->Categoria = $Categoria;

        return $this;
    }
}
