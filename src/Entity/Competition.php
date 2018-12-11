<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionRepository")
 */
class Competition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $eventDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfPlayers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statusId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creatorId;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $userId;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="competitions")
     */
    private $tagId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Encounter", mappedBy="competitionId", orphanRemoval=true)
     */
    private $encounters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competitor", mappedBy="competitionId", orphanRemoval=true)
     */
    private $competitors;

    public function __construct()
    {
        $this->userId = new ArrayCollection();
        $this->tagId = new ArrayCollection();
        $this->encounters = new ArrayCollection();
        $this->competitors = new ArrayCollection();
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->eventDate;
    }

    public function setEventDate(?\DateTimeInterface $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNumberOfPlayers(): ?int
    {
        return $this->numberOfPlayers;
    }

    public function setNumberOfPlayers(int $numberOfPlayers): self
    {
        $this->numberOfPlayers = $numberOfPlayers;

        return $this;
    }

    public function getStatusId(): ?Status
    {
        return $this->statusId;
    }

    public function setStatusId(?Status $statusId): self
    {
        $this->statusId = $statusId;

        return $this;
    }

    public function getTypeId(): ?Type
    {
        return $this->typeId;
    }

    public function setTypeId(?Type $typeId): self
    {
        $this->typeId = $typeId;

        return $this;
    }

    public function getCreatorId(): ?User
    {
        return $this->creatorId;
    }

    public function setCreatorId(?User $creatorId): self
    {
        $this->creatorId = $creatorId;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserId(): Collection
    {
        return $this->userId;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->userId->contains($userId)) {
            $this->userId[] = $userId;
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->userId->contains($userId)) {
            $this->userId->removeElement($userId);
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTagId(): Collection
    {
        return $this->tagId;
    }

    public function addTagId(Tag $tagId): self
    {
        if (!$this->tagId->contains($tagId)) {
            $this->tagId[] = $tagId;
        }

        return $this;
    }

    public function removeTagId(Tag $tagId): self
    {
        if ($this->tagId->contains($tagId)) {
            $this->tagId->removeElement($tagId);
        }

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
            $encounter->setCompetitionId($this);
        }

        return $this;
    }

    public function removeEncounter(Encounter $encounter): self
    {
        if ($this->encounters->contains($encounter)) {
            $this->encounters->removeElement($encounter);
            // set the owning side to null (unless already changed)
            if ($encounter->getCompetitionId() === $this) {
                $encounter->setCompetitionId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Competitor[]
     */
    public function getCompetitors(): Collection
    {
        return $this->competitors;
    }

    public function addCompetitor(Competitor $competitor): self
    {
        if (!$this->competitors->contains($competitor)) {
            $this->competitors[] = $competitor;
            $competitor->setCompetitionId($this);
        }

        return $this;
    }

    public function removeCompetitor(Competitor $competitor): self
    {
        if ($this->competitors->contains($competitor)) {
            $this->competitors->removeElement($competitor);
            // set the owning side to null (unless already changed)
            if ($competitor->getCompetitionId() === $this) {
                $competitor->setCompetitionId(null);
            }
        }

        return $this;
    }
}
