<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoctorRepository::class)
 */
class Doctor
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
    private $userProfile;

    /**
     * @ORM\OneToMany(targetEntity=Prescription::class, mappedBy="doctor")
     */
    private $prescriptions;

    /**
     * @ORM\ManyToMany(targetEntity=Patient::class, inversedBy="doctors")
     */
    private $patients;

    public function __construct()
    {
        $this->prescriptions = new ArrayCollection();
        $this->patients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserProfile(): ?User
    {
        return $this->userProfile;
    }

    public function setUserProfile(User $userProfile): self
    {
        $this->userProfile = $userProfile;

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
            $prescription->setDoctor($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): self
    {
        if ($this->prescriptions->removeElement($prescription)) {
            // set the owning side to null (unless already changed)
            if ($prescription->getDoctor() === $this) {
                $prescription->setDoctor(null);
            }
        }

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
}
