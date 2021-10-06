<?php


namespace App\Model\Entity;


class Token {
    private ?int $id;
    private ?string $token;
    private ?User $userFk;
    private ?string $datetime;

    /**
     * Token constructor.
     * @param int|null $id
     * @param string|null $token
     * @param User|null $userFk
     * @param string|null $datetime
     */
    public function __construct(int $id = null, string $token = null, User $userFk = null, string $datetime = null)
    {
        $this->id = $id;
        $this->token = $token;
        $this->userFk = $userFk;
        $this->datetime = $datetime;
    }

    /**
     * Return the id of Token
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the token of Token
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set the token of Token
     * @param string|null $token
     * @return Token
     */
    public function setToken(?string $token): Token
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Return the user fk of Token
     * @return User|null
     */
    public function getUserFk(): ?User
    {
        return $this->userFk;
    }

    /**
     * set the user fk of Token
     * @param User|null $userFk
     * @return Token
     */
    public function setUserFk(?User $userFk): Token
    {
        $this->userFk = $userFk;
        return $this;
    }

    /**
     * Return the datetime of Token
     * @return string|null
     */
    public function getDatetime(): ?string
    {
        return $this->datetime;
    }

    /**
     * Set the datetime of Token
     * @param string|null $datetime
     * @return Token
     */
    public function setDatetime(?string $datetime): Token
    {
        $this->datetime = $datetime;
        return $this;
    }
}