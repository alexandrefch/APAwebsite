<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScheduleRepository::class)
 */
class Schedule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $beginDateTime;

    /**
     * @ORM\Column(type="time")
     */
    private $duration;

    /**
     * @ORM\ManyToMany(targetEntity=Patient::class, inversedBy="schedules")
     */
    private $patients;

    /**
     * @ORM\OneToMany(targetEntity=PatientFeedback::class, mappedBy="schedule")
     */
    private $patientFeedbacks;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
        $this->patientFeedbacks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeginDateTime(): ?\DateTimeInterface
    {
        return $this->beginDateTime;
    }

    public function setBeginDateTime(\DateTimeInterface $beginDateTime): self
    {
        $this->beginDateTime = $beginDateTime;

        return $this;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(\DateTimeInterface $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection|Patient[]
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    public function addPatient(Patient $patient): self
    {
        if (!$this->patients->contains($patient)) {
            $this->patients[] = $patient;
        }

        return $this;
    }

    public function removePatient(Patient $patient): self
    {
        $this->patients->removeElement($patient);

        return $this;
    }

    /**
     * @return Collection|PatientFeedback[]
     */
    public function getPatientFeedbacks(): Collection
    {
        return $this->patientFeedbacks;
    }

    public function addPatientFeedback(PatientFeedback $patientFeedback): self
    {
        if (!$this->patientFeedbacks->contains($patientFeedback)) {
            $this->patientFeedbacks[] = $patientFeedback;
            $patientFeedback->setSchedule($this);
        }

        return $this;
    }

    public function removePatientFeedback(PatientFeedback $patientFeedback): self
    {
        if ($this->patientFeedbacks->removeElement($patientFeedback)) {
            // set the owning side to null (unless already changed)
            if ($patientFeedback->getSchedule() === $this) {
                $patientFeedback->setSchedule(null);
            }
        }

        return $this;
    }

}
