<?php

namespace App\Model\Entity;

class Role {
    private ?int $id;
    private ?string $name;

    /**
     * Role constructor.
     * @param int|null $id
     * @param string|null $name
     */
    public function __construct(int $id = null, string $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Return the id of Role
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the name of Role
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of Role
     * @param string|null $name
     * @return Role
     */
    public function setName(?string $name): Role
    {
        $this->name = $name;
        return $this;
    }
}