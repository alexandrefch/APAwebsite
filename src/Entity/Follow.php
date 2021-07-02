<?php

namespace App\Entity;

use App\Repository\FollowRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FollowRepository::class)
 */
class Follow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="follows")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\Column(type="date")
     */
    private $since;

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

    public function getSince(): ?\DateTimeInterface
    {
        return $this->since;
    }

    public function setSince(\DateTimeInterface $since): self
    {
        $this->since = $since;

        return $this;
    }
}
