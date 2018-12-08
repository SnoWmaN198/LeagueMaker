<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitorRepository")
 */
class Competitor
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="competitors")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="competitors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Encounter", inversedBy="competitors")
     */
    private $encounters;

    public function __construct()
    {
        $this->encounters = new ArrayCollection();
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

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCompetitionId(): ?Competition
    {
        return $this->competition_id;
    }

    public function setCompetitionId(?Competition $competition_id): self
    {
        $this->competition_id = $competition_id;

        return $this;
    }

    /**
     * @return Collection|Encounter[]
     */
    public function getEncounters(): Collection
    {
        return $this->encounters;
    }

    public function addEncounter(Encounter $encounter): self
    {
        if (!$this->encounters->contains($encounter)) {
            $this->encounters[] = $encounter;
        }

        return $this;
    }

    public function removeEncounter(Encounter $encounter): self
    {
        if ($this->encounters->contains($encounter)) {
            $this->encounters->removeElement($encounter);
        }

        return $this;
    }
}
