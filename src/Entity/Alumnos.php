<?php

namespace App\Entity;

use App\Repository\AlumnosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlumnosRepository::class)
 */
class Alumnos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=AsigAlum::class, mappedBy="alumno")
     */
    private $asigAlums;

    public function __construct()
    {
        $this->asigAlums = new ArrayCollection();
    }

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

    /**
     * @return Collection|AsigAlum[]
     */
    public function getAsigAlums(): Collection
    {
        return $this->asigAlums;
    }

    public function addAsigAlum(AsigAlum $asigAlum): self
    {
        if (!$this->asigAlums->contains($asigAlum)) {
            $this->asigAlums[] = $asigAlum;
            $asigAlum->setAlumno($this);
        }

        return $this;
    }

    public function removeAsigAlum(AsigAlum $asigAlum): self
    {
        if ($this->asigAlums->removeElement($asigAlum)) {
            // set the owning side to null (unless already changed)
            if ($asigAlum->getAlumno() === $this) {
                $asigAlum->setAlumno(null);
            }
        }

        return $this;
    }
}
