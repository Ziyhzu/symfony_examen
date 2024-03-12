<?php

namespace App\Entity;

use App\Repository\HabitacionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HabitacionesRepository::class)]
class Habitaciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $habitacion_id_pk = null;

    #[ORM\Column(length: 40)]
    private ?string $tipo_habitacion = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $numero_habitacion = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $precio_dia = null;

    #[ORM\Column]
    private ?bool $activo = null;

    #[ORM\OneToMany(targetEntity: Reservas::class, mappedBy: 'habitacion_id_fk')]
    private Collection $reservas;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
    }

    public function getHabitacionIdPk(): ?int
    {
        return $this->habitacion_id_pk;
    }

    public function getTipoHabitacion(): ?string
    {
        return $this->tipo_habitacion;
    }

    public function setTipoHabitacion(string $tipo_habitacion): static
    {
        $this->tipo_habitacion = $tipo_habitacion;

        return $this;
    }

    public function getNumeroHabitacion(): ?int
    {
        return $this->numero_habitacion;
    }

    public function setNumeroHabitacion(int $numero_habitacion): static
    {
        $this->numero_habitacion = $numero_habitacion;

        return $this;
    }

    public function getPrecioDia(): ?string
    {
        return $this->precio_dia;
    }

    public function setPrecioDia(string $precio_dia): static
    {
        $this->precio_dia = $precio_dia;

        return $this;
    }

    public function isActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): static
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * @return Collection<int, Reservas>
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reservas $reserva): static
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas->add($reserva);
            $reserva->setHabitacionIdFk($this);
        }

        return $this;
    }

    public function removeReserva(Reservas $reserva): static
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getHabitacionIdFk() === $this) {
                $reserva->setHabitacionIdFk(null);
            }
        }

        return $this;
    }
}
