<?php

namespace App\Entity;

use App\Repository\AgenciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgenciesRepository::class)]
class Agencies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\OneToMany(targetEntity: Users::class, mappedBy: 'agency_id')]
    private Collection $users;

    /**
     * @var Collection<int, Missions>
     */
    #[ORM\OneToMany(targetEntity: Missions::class, mappedBy: 'agency_id', orphanRemoval: true)]
    private Collection $missions;

    #[ORM\ManyToOne(inversedBy: 'agency_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employees $employees = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setAgencyId($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAgencyId() === $this) {
                $user->setAgencyId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Missions>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Missions $mission): static
    {
        if (!$this->missions->contains($mission)) {
            $this->missions->add($mission);
            $mission->setAgencyId($this);
        }

        return $this;
    }

    public function removeMission(Missions $mission): static
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getAgencyId() === $this) {
                $mission->setAgencyId(null);
            }
        }

        return $this;
    }

    public function getEmployees(): ?Employees
    {
        return $this->employees;
    }

    public function setEmployees(?Employees $employees): static
    {
        $this->employees = $employees;

        return $this;
    }
}
