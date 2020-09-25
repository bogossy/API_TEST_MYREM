<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
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
    private $nom_event;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedebut_event;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datefin_event;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Participant::class, inversedBy="events")
     */
    private $Participant;

    /**
     * ORM\ManyToOne(targetEntity=User::class, inversedBy="EventsUser")
     * ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Event_de_user")
     */
    private $EventUser;

    public function __construct()
    {
        $this->Participant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvent(): ?string
    {
        return $this->nom_event;
    }

    public function setNomEvent(string $nom_event): self
    {
        $this->nom_event = $nom_event;

        return $this;
    }

    public function getDatedebutEvent(): ?\DateTimeInterface
    {
        return $this->datedebut_event;
    }

    public function setDatedebutEvent(\DateTimeInterface $datedebut_event): self
    {
        $this->datedebut_event = $datedebut_event;

        return $this;
    }

    public function getDatefinEvent(): ?\DateTimeInterface
    {
        return $this->datefin_event;
    }

    public function setDatefinEvent(\DateTimeInterface $datefin_event): self
    {
        $this->datefin_event = $datefin_event;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipant(): Collection
    {
        return $this->Participant;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->Participant->contains($participant)) {
            $this->Participant[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->Participant->contains($participant)) {
            $this->Participant->removeElement($participant);
        }

        return $this;
    }

    /*public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }*/

    public function getEventUser(): ?User
    {
        return $this->EventUser;
    }

    public function setEventUser(?User $EventUser): self
    {
        $this->EventUser = $EventUser;

        return $this;
    }
}
