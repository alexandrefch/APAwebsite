<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userProfil;

    /**
     * @ORM\OneToMany(targetEntity=Prescription::class, mappedBy="patient")
     */
    private $prescriptions;

    /**
     * @ORM\ManyToMany(targetEntity=Schedule::class, mappedBy="patient")
     */
    private $schedules;

    /**
     * @ORM\OneToMany(targetEntity=PatientFeedback::class, mappedBy="patient")
     */
    private $patientFeedbacks;

    public function __construct()
    {
        $this->prescriptions = new ArrayCollection();
        $this->schedules = new ArrayCollection();
        $this->patientFeedbacks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserProfil(): ?User
    {
        return $this->userProfil;
    }

    public function setUserProfil(User $userProfil): self
    {
        $this->userProfil = $userProfil;

        return $this;
    }

    /**
     * @return Collection|Prescription[]
     */
    public function getPrescriptions(): Collection
    {
        return $this->prescriptions;
    }

    public function addPrescription(Prescription $prescription): self
    {
        if (!$this->prescriptions->contains($prescription)) {
            $this->prescriptions[] = $prescription;
            $prescription->setPatient($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): self
    {
        if ($this->prescriptions->removeElement($prescription)) {
            // set the owning side to null (unless already changed)
            if ($prescription->getPatient() === $this) {
                $prescription->setPatient(null);
            }
        }

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
            $schedule->addPatient($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->removeElement($schedule)) {
            $schedule->removePatient($this);
        }

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
            $patientFeedback->setPatient($this);
        }

        return $this;
    }

    public function removePatientFeedback(PatientFeedback $patientFeedback): self
    {
        if ($this->patientFeedbacks->removeElement($patientFeedback)) {
            // set the owning side to null (unless already changed)
            if ($patientFeedback->getPatient() === $this) {
                $patientFeedback->setPatient(null);
            }
        }

        return $this;
    }
}
