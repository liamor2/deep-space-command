<?php

namespace App\Entity;

use App\Repository\RolesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolesRepository::class)]
class Roles
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
    #[ORM\OneToMany(targetEntity: Users::class, mappedBy: 'role_id')]
    private Collection $users;

    /**
     * @var Collection<int, Permissions>
     */
    #[ORM\ManyToMany(targetEntity: Permissions::class, mappedBy: 'role_permission')]
    private Collection $permissions;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'roles')]
    private ?self $parent_id = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent_id')]
    private Collection $roles;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->permissions = new ArrayCollection();
        $this->roles = new ArrayCollection();
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
            $user->setRoleId($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRoleId() === $this) {
                $user->setRoleId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Permissions>
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(Permissions $permission): static
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
            $permission->addRolePermission($this);
        }

        return $this;
    }

    public function removePermission(Permissions $permission): static
    {
        if ($this->permissions->removeElement($permission)) {
            $permission->removeRolePermission($this);
        }

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
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(self $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
            $role->setParentId($this);
        }

        return $this;
    }

    public function removeRole(self $role): static
    {
        if ($this->roles->removeElement($role)) {
            // set the owning side to null (unless already changed)
            if ($role->getParentId() === $this) {
                $role->setParentId(null);
            }
        }

        return $this;
    }
}
