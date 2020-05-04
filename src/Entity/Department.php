<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartmentRepository")
 */
class Department
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
    private $departmentName;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     */
    private $manager;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="department")
     */
    private $employees;


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

    /**
     * @ORM\Column(type="boolean")
     */
    private $canManageStock;

    /**
     * @ORM\Column(type="boolean")
     */
    private $administrator;

    /**
     * @ORM\Column(type="boolean")
     */
    private $moderator;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $roles = [];

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartmentName(): ?string
    {
        return $this->departmentName;
    }

    public function setDepartmentName(string $departmentName): self
    {
        $this->departmentName = $departmentName;

        return $this;
    }

    public function getManager(): ?User
    {
        return $this->manager;
    }

    public function setManager(?User $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(User $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees[] = $employee;
            $employee->setDepartment($this);
        }

        return $this;
    }

    public function removeEmployee(User $employee): self
    {
        if ($this->employees->contains($employee)) {
            $this->employees->removeElement($employee);
            // set the owning side to null (unless already changed)
            if ($employee->getDepartment() === $this) {
                $employee->setDepartment(null);
            }
        }

        return $this;
    }

    public function deleteAllEmployees(): self
    {
        $this->employees = null;
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

    public function getCanManageStock(): ?bool
    {
        return $this->canManageStock;
    }

    public function setCanManageStock(bool $canManageStock): self
    {
        $this->canManageStock = $canManageStock;

        return $this;
    }

    
    public function __toString()
    {
        return $this->departmentName;
    }

    public function removeAssociations() {
        foreach($this->getEmployees() as $employee) {
            $this->removeEmployee($employee);
        }
    }

    public function getAdministrator(): ?bool
    {
        return $this->administrator;
    }

    public function setAdministrator(bool $administrator): self
    {
        $this->administrator = $administrator;

        return $this;
    }

    public function getModerator(): ?bool
    {
        return $this->moderator;
    }

    public function setModerator(bool $moderator): self
    {
        $this->moderator = $moderator;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
