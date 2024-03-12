<?php

namespace App\Entity;

use App\Repository\ReviewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewsRepository::class)]
class Reviews
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $reviews_id_pk = null;

    #[ORM\Column(length: 255)]
    private ?string $comentario = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $nota_valoracion = null;

    #[ORM\Column]
    private ?bool $activo = null;

    #[ORM\OneToOne(inversedBy: 'reviews', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'reserva_id_fk', referencedColumnName: 'reserva_id_pk')]
    private ?Reservas $reserva_id_fk = null;

    public function getReviewsIdPk(): ?int
    {
        return $this->reviews_id_pk;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): static
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getNotaValoracion(): ?int
    {
        return $this->nota_valoracion;
    }

    public function setNotaValoracion(int $nota_valoracion): static
    {
        $this->nota_valoracion = $nota_valoracion;

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

    public function getReservaIdFk(): ?Reservas
    {
        return $this->reserva_id_fk;
    }

    public function setReservaIdFk(?Reservas $reserva_id_fk): static
    {
        $this->reserva_id_fk = $reserva_id_fk;

        return $this;
    }
}
