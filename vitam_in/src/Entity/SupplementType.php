<?php

namespace App\Entity;

use App\Repository\SupplementTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupplementTypeRepository::class)]
class SupplementType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Supplement>
     */
    #[ORM\OneToMany(targetEntity: Supplement::class, mappedBy: 'supplementtype')]
    private Collection $supplements;

    public function __construct()
    {
        $this->supplements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Supplement>
     */
    public function getSupplements(): Collection
    {
        return $this->supplements;
    }

    public function addSupplement(Supplement $supplement): static
    {
        if (!$this->supplements->contains($supplement)) {
            $this->supplements->add($supplement);
            $supplement->setSupplementtype($this);
        }

        return $this;
    }

    public function removeSupplement(Supplement $supplement): static
    {
        if ($this->supplements->removeElement($supplement)) {
            // set the owning side to null (unless already changed)
            if ($supplement->getSupplementtype() === $this) {
                $supplement->setSupplementtype(null);
            }
        }

        return $this;
    }
}
