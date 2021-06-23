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
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="schedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contributor;

    /**
     * @ORM\ManyToOne(targetEntity=Activity::class, inversedBy="schedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $activity;

    /**
     * @ORM\ManyToMany(targetEntity=Person::class, inversedBy="participates")
     */
    private $participant;

    /**
     * @ORM\Column(type="integer")
     */
    private $weekDay;

    /**
     * @ORM\Column(type="time")
     */
    private $begin;

    public function __construct()
    {
        $this->participant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContributor(): ?person
    {
        return $this->contributor;
    }

    public function setContributor(?person $contributor): self
    {
        $this->contributor = $contributor;

        return $this;
    }

    public function getActivity(): ?activity
    {
        return $this->activity;
    }

    public function setActivity(?activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * @return Collection|person[]
     */
    public function getParticipant(): Collection
    {
        return $this->participant;
    }

    public function addParticipant(person $participant): self
    {
        if (!$this->participant->contains($participant)) {
            $this->participant[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(person $participant): self
    {
        $this->participant->removeElement($participant);

        return $this;
    }

    public function getWeekDay(): ?int
    {
        return $this->weekDay;
    }

    public function setWeekDay(int $weekDay): self
    {
        $this->weekDay = $weekDay;

        return $this;
    }

    public function getBegin(): ?\DateTimeInterface
    {
        return $this->begin;
    }

    public function setBegin(\DateTimeInterface $begin): self
    {
        $this->begin = $begin;

        return $this;
    }
}
