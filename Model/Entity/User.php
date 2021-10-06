<?php

namespace App\Model\Entity;

class User {
    private ?int $id;
    private ?string $username;
    private ?string $password;
    private ?string $mail;
    private ?int $activated;

    /**
     * User constructor.
     * @param int|null $id
     * @param string|null $username
     * @param string|null $password
     * @param string|null $mail
     * @param int|null $activated
     */
    public function __construct(int $id = null, string $username = null, string $password = null, string $mail = null, int $activated = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->mail = $mail;
        $this->activated = $activated;
    }

    /**
     * Return the id of User
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the username of User
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the username of User
     * @param string|null $username
     * @return User
     */
    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Return the password of User
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the password of User
     * @param string|null $password
     * @return User
     */
    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Return the mail of User
     * @return string|null
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * Set the mail of User
     * @param string|null $mail
     * @return User
     */
    public function setMail(?string $mail): User
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * Return the activated of User
     * @return int|null
     */
    public function getActivated(): ?int
    {
        return $this->activated;
    }

    /**
     * Set the activated of User
     * @param int|null $activated
     * @return User
     */
    public function setActivated(?int $activated): User
    {
        $this->activated = $activated;
        return $this;
    }
}