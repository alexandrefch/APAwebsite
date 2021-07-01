<?php

namespace App\Entity;

use App\Repository\PrescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrescriptionRepository::class)
 */
class Prescription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="prescriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\Column(type="text")
     */
    private $goal;

    /**
     * @ORM\Column(type="date")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="integer")
     */
    private $min_time_sport_week;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_time_sport_week;

    /**
     * @ORM\ManyToMany(targetEntity=ActivityType::class)
     */
    private $contraindication;

    /**
     * @ORM\ManyToMany(targetEntity=Pathology::class)
     */
    private $cure;

    public function __construct()
    {
        $this->contraindication = new ArrayCollection();
        $this->cure = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoctor(): ?Account
    {
        return $this->doctor;
    }

    public function setDoctor(?Account $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getPatient(): ?Account
    {
        return $this->patient;
    }

    public function setPatient(?Account $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getMinTimeSportWeek(): ?int
    {
        return $this->min_time_sport_week;
    }

    public function setMinTimeSportWeek(int $min_time_sport_week): self
    {
        $this->min_time_sport_week = $min_time_sport_week;

        return $this;
    }

    public function getMaxTimeSportWeek(): ?int
    {
        return $this->max_time_sport_week;
    }

    public function setMaxTimeSportWeek(int $max_time_sport_week): self
    {
        $this->max_time_sport_week = $max_time_sport_week;

        return $this;
    }

    /**
     * @return Collection|ActivityType[]
     */
    public function getContraindication(): Collection
    {
        return $this->contraindication;
    }

    public function addContraindication(ActivityType $contraindication): self
    {
        if (!$this->contraindication->contains($contraindication)) {
            $this->contraindication[] = $contraindication;
        }

        return $this;
    }

    public function removeContraindication(ActivityType $contraindication): self
    {
        $this->contraindication->removeElement($contraindication);

        return $this;
    }

    /**
     * @return Collection|Pathology[]
     */
    public function getCure(): Collection
    {
        return $this->cure;
    }

    public function addCure(Pathology $cure): self
    {
        if (!$this->cure->contains($cure)) {
            $this->cure[] = $cure;
        }

        return $this;
    }

    public function removeCure(Pathology $cure): self
    {
        $this->cure->removeElement($cure);

        return $this;
    }
}
