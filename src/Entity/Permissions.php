<?php

namespace App\Entity;

use App\Repository\PermissionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermissionsRepository::class)]
class Permissions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Roles>
     */
    #[ORM\ManyToMany(targetEntity: Roles::class, inversedBy: 'permissions')]
    private Collection $role_permission;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'permissions')]
    private ?self $parent_id = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent_id')]
    private Collection $permissions;

    public function __construct()
    {
        $this->role_permission = new ArrayCollection();
        $this->permissions = new ArrayCollection();
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
     * @return Collection<int, Roles>
     */
    public function getRolePermission(): Collection
    {
        return $this->role_permission;
    }

    public function addRolePermission(Roles $rolePermission): static
    {
        if (!$this->role_permission->contains($rolePermission)) {
            $this->role_permission->add($rolePermission);
        }

        return $this;
    }

    public function removeRolePermission(Roles $rolePermission): static
    {
        $this->role_permission->removeElement($rolePermission);

        return $this;
    }

    public function getParentId(): ?self
    {
        return $this->parent_id;
    }

    public function setParentId(?self $parent_id): static
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(self $permission): static
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
            $permission->setParentId($this);
        }

        return $this;
    }

    public function removePermission(self $permission): static
    {
        if ($this->permissions->removeElement($permission)) {
            // set the owning side to null (unless already changed)
            if ($permission->getParentId() === $this) {
                $permission->setParentId(null);
            }
        }

        return $this;
    }
}
