<?php

namespace App\Entity;

use App\Repository\SupplementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupplementRepository::class)]
class Supplement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $on_duration_days = null;

    #[ORM\Column]
    private ?int $off_duration_days = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $precautions = null;

    #[ORM\Column]
    private array $dosage_schedule = [];

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'supplement', orphanRemoval: true)]
    private Collection $comment;

    public function __construct()
    {
        $this->comment = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getOnDurationDays(): ?int
    {
        return $this->on_duration_days;
    }

    public function setOnDurationDays(int $on_duration_days): static
    {
        $this->on_duration_days = $on_duration_days;

        return $this;
    }

    public function getOffDurationDays(): ?int
    {
        return $this->off_duration_days;
    }

    public function setOffDurationDays(int $off_duration_days): static
    {
        $this->off_duration_days = $off_duration_days;

        return $this;
    }

    public function getPrecautions(): ?string
    {
        return $this->precautions;
    }

    public function setPrecautions(string $precautions): static
    {
        $this->precautions = $precautions;

        return $this;
    }

    public function getDosageSchedule(): array
    {
        return $this->dosage_schedule;
    }

    public function setDosageSchedule(array $dosage_schedule): static
    {
        $this->dosage_schedule = $dosage_schedule;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comment->contains($comment)) {
            $this->comment->add($comment);
            $comment->setSupplement($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getSupplement() === $this) {
                $comment->setSupplement(null);
            }
        }

        return $this;
    }
}
