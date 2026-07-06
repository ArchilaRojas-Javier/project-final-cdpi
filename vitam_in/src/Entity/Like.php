<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $cerated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCeratedAt(): ?\DateTimeImmutable
    {
        return $this->cerated_at;
    }

    public function setCeratedAt(\DateTimeImmutable $cerated_at): static
    {
        $this->cerated_at = $cerated_at;

        return $this;
    }
}
