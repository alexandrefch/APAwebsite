<?php

namespace App\Entity;

use App\Repository\PathologyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PathologyRepository::class)
 */
class Pathology
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Activity::class, mappedBy="prevention")
     */
    private $activities;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addIntended(Activity $intended): self
    {
        if (!$this->activities->contains($intended)) {
            $this->activities[] = $intended;
            $intended->addPrevention($this);
        }

        return $this;
    }

    public function removeIntended(Activity $intended): self
    {
        if ($this->activities->removeElement($intended)) {
            $intended->removePrevention($this);
        }

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}
