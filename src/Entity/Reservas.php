<?php

namespace App\Entity;

use App\Repository\ReservasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservasRepository::class)]
class Reservas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "reserva_id_pk")]
    private ?int $reservas_id_pk = null;

    #[ORM\Column(length: 40)]
    private ?string $cliente = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_entrada = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_salida = null;

    #[ORM\Column]
    private ?bool $activo = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(name: 'habitacion_id_fk', referencedColumnName: 'habitacion_id_pk')]
    private ?Habitaciones $habitacion_id_fk = null;

    #[ORM\OneToOne(mappedBy: 'reserva_id_fk', cascade: ['persist', 'remove'])]
    private ?Reviews $reviews = null;

    public function getReservasIdPk(): ?int
    {
        return $this->reservas_id_pk;
    }

    public function getCliente(): ?string
    {
        return $this->cliente;
    }

    public function setCliente(string $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getFechaEntrada(): ?\DateTimeInterface
    {
        return $this->fecha_entrada;
    }

    public function setFechaEntrada(\DateTimeInterface $fecha_entrada): static
    {
        $this->fecha_entrada = $fecha_entrada;

        return $this;
    }

    public function getFechaSalida(): ?\DateTimeInterface
    {
        return $this->fecha_salida;
    }

    public function setFechaSalida(\DateTimeInterface $fecha_salida): static
    {
        $this->fecha_salida = $fecha_salida;

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

    public function getHabitacionIdFk(): ?Habitaciones
    {
        return $this->habitacion_id_fk;
    }

    public function setHabitacionIdFk(?Habitaciones $habitacion_id_fk): static
    {
        $this->habitacion_id_fk = $habitacion_id_fk;

        return $this;
    }

    public function getReviews(): ?Reviews
    {
        return $this->reviews;
    }

    public function setReviews(?Reviews $reviews): static
    {
        // unset the owning side of the relation if necessary
        if ($reviews === null && $this->reviews !== null) {
            $this->reviews->setReservaIdFk(null);
        }

        // set the owning side of the relation if necessary
        if ($reviews !== null && $reviews->getReservaIdFk() !== $this) {
            $reviews->setReservaIdFk($this);
        }

        $this->reviews = $reviews;

        return $this;
    }
}
