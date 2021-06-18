<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $rate;

    /**
     * @ORM\ManyToMany(targetEntity=PlaceType::class, inversedBy="activities")
     */
    private $practicePlace;

    /**
     * @ORM\ManyToMany(targetEntity=Pathology::class, inversedBy="intended")
     */
    private $prevention;

    /**
     * @ORM\ManyToMany(targetEntity=AudienceType::class, inversedBy="activities")
     */
    private $intended;

    /**
     * @ORM\ManyToOne(targetEntity=Structure::class, inversedBy="activities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $structure;

    /**
     * @ORM\OneToMany(targetEntity=Schedule::class, mappedBy="activity")
     */
    private $schedules;

    /**
     * @ORM\ManyToOne(targetEntity=ActivityType::class, inversedBy="activities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $discipline;

    public function __construct()
    {
        $this->practicePlace = new ArrayCollection();
        $this->prevention = new ArrayCollection();
        $this->intended = new ArrayCollection();
        $this->schedules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(?string $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return Collection|PlaceType[]
     */
    public function getPracticePlace(): Collection
    {
        return $this->practicePlace;
    }

    public function addPracticePlace(PlaceType $practicePlace): self
    {
        if (!$this->practicePlace->contains($practicePlace)) {
            $this->practicePlace[] = $practicePlace;
        }

        return $this;
    }

    public function removePracticePlace(PlaceType $practicePlace): self
    {
        $this->practicePlace->removeElement($practicePlace);

        return $this;
    }

    /**
     * @return Collection|Pathology[]
     */
    public function getPrevention(): Collection
    {
        return $this->prevention;
    }

    public function addPrevention(Pathology $prevention): self
    {
        if (!$this->prevention->contains($prevention)) {
            $this->prevention[] = $prevention;
        }

        return $this;
    }

    public function removePrevention(Pathology $prevention): self
    {
        $this->prevention->removeElement($prevention);

        return $this;
    }

    /**
     * @return Collection|AudienceType[]
     */
    public function getIntended(): Collection
    {
        return $this->intended;
    }

    public function addIntended(AudienceType $intended): self
    {
        if (!$this->intended->contains($intended)) {
            $this->intended[] = $intended;
        }

        return $this;
    }

    public function removeIntended(AudienceType $intended): self
    {
        $this->intended->removeElement($intended);

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * @return Collection|Schedule[]
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule): self
    {
        if (!$this->schedules->contains($schedule)) {
            $this->schedules[] = $schedule;
            $schedule->setActivity($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->removeElement($schedule)) {
            // set the owning side to null (unless already changed)
            if ($schedule->getActivity() === $this) {
                $schedule->setActivity(null);
            }
        }

        return $this;
    }

    public function getDiscipline(): ?ActivityType
    {
        return $this->discipline;
    }

    public function setDiscipline(?ActivityType $discipline): self
    {
        $this->discipline = $discipline;

        return $this;
    }
}
