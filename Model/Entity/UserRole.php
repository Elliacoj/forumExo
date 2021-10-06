<?php


namespace App\Model\Entity;


class UserRole {
    private ?int $id;
    private ?User $userFk;
    private ?Role $roleFk;

    /**
     * UserRole constructor.
     * @param int|null $id
     * @param User|null $userFk
     * @param Role|null $roleFk
     */
    public function __construct(int $id = null, User $userFk = null, Role $roleFk = null)
    {
        $this->id = $id;
        $this->userFk = $userFk;
        $this->roleFk = $roleFk;
    }

    /**
     * Return the id of User Role
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the user fk of User Role
     * @return User|null
     */
    public function getUserFk(): ?User
    {
        return $this->userFk;
    }

    /**
     * Set the user fk of User Role
     * @param User|null $userFk
     * @return UserRole
     */
    public function setUserFk(?User $userFk): UserRole
    {
        $this->userFk = $userFk;
        return $this;
    }

    /**
     * Return the role fk of User Role
     * @return Role|null
     */
    public function getRoleFk(): ?Role
    {
        return $this->roleFk;
    }

    /**
     * Set the role fk of User Role
     * @param Role|null $roleFk
     * @return UserRole
     */
    public function setRoleFk(?Role $roleFk): UserRole
    {
        $this->roleFk = $roleFk;
        return $this;
    }
}