<?php

namespace App\Entity;

use App\Repository\AsigAlumRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AsigAlumRepository::class)
 */
class AsigAlum
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Alumnos::class, inversedBy="asigAlums")
     * @ORM\JoinColumn(nullable=false)
     */
    private $alumno;

    /**
     * @ORM\ManyToOne(targetEntity=Asignaturas::class, inversedBy="asigAlums")
     * @ORM\JoinColumn(nullable=false)
     */
    private $asignaturas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlumno(): ?Alumnos
    {
        return $this->alumno;
    }

    public function setAlumno(?Alumnos $alumno): self
    {
        $this->alumno = $alumno;

        return $this;
    }

    public function getAsignaturas(): ?Asignaturas
    {
        return $this->asignaturas;
    }

    public function setAsignaturas(?Asignaturas $asignaturas): self
    {
        $this->asignaturas = $asignaturas;

        return $this;
    }
}
