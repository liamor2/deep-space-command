<?php

namespace App\Entity;

use App\Repository\EmployeesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeesRepository::class)]
class Employees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $science = null;

    #[ORM\Column]
    private ?int $pilote = null;

    #[ORM\Column]
    private ?int $engineer = null;

    /**
     * @var Collection<int, Agencies>
     */
    #[ORM\OneToMany(targetEntity: Agencies::class, mappedBy: 'employees', orphanRemoval: true)]
    private Collection $agency_id;

    /**
     * @var Collection<int, Missions>
     */
    #[ORM\OneToMany(targetEntity: Missions::class, mappedBy: 'employees')]
    private Collection $mission_id;

    public function __construct()
    {
        $this->agency_id = new ArrayCollection();
        $this->mission_id = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getScience(): ?int
    {
        return $this->science;
    }

    public function setScience(int $science): static
    {
        $this->science = $science;

        return $this;
    }

    public function getPilote(): ?int
    {
        return $this->pilote;
    }

    public function setPilote(int $pilote): static
    {
        $this->pilote = $pilote;

        return $this;
    }

    public function getEngineer(): ?int
    {
        return $this->engineer;
    }

    public function setEngineer(int $engineer): static
    {
        $this->engineer = $engineer;

        return $this;
    }

    /**
     * @return Collection<int, Agencies>
     */
    public function getAgencyId(): Collection
    {
        return $this->agency_id;
    }

    public function addAgencyId(Agencies $agencyId): static
    {
        if (!$this->agency_id->contains($agencyId)) {
            $this->agency_id->add($agencyId);
            $agencyId->setEmployees($this);
        }

        return $this;
    }

    public function removeAgencyId(Agencies $agencyId): static
    {
        if ($this->agency_id->removeElement($agencyId)) {
            // set the owning side to null (unless already changed)
            if ($agencyId->getEmployees() === $this) {
                $agencyId->setEmployees(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Missions>
     */
    public function getMissionId(): Collection
    {
        return $this->mission_id;
    }

    public function addMissionId(Missions $missionId): static
    {
        if (!$this->mission_id->contains($missionId)) {
            $this->mission_id->add($missionId);
            $missionId->setEmployees($this);
        }

        return $this;
    }

    public function removeMissionId(Missions $missionId): static
    {
        if ($this->mission_id->removeElement($missionId)) {
            // set the owning side to null (unless already changed)
            if ($missionId->getEmployees() === $this) {
                $missionId->setEmployees(null);
            }
        }

        return $this;
    }
}
