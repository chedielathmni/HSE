<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserGroupRepository")
 */
class UserGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groupName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canManageUsers;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canManageProducts;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canManageGroups;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupName(): ?string
    {
        return $this->groupName;
    }

    public function setGroupName(string $groupName): self
    {
        $this->groupName = $groupName;

        return $this;
    }

    public function getCanManageUsers(): ?bool
    {
        return $this->canManageUsers;
    }

    public function setCanManageUsers(bool $canManageUsers): self
    {
        $this->canManageUsers = $canManageUsers;

        return $this;
    }

    public function getCanManageProducts(): ?bool
    {
        return $this->canManageProducts;
    }

    public function setCanManageProducts(bool $canManageProducts): self
    {
        $this->canManageProducts = $canManageProducts;

        return $this;
    }

    public function getCanManageGroups(): ?bool
    {
        return $this->canManageGroups;
    }

    public function setCanManageGroups(bool $canManageGroups): self
    {
        $this->canManageGroups = $canManageGroups;

        return $this;
    }
}
