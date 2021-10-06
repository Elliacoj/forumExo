<?php


namespace App\Model\Entity;


class Topic {
    private ?int $id;
    private ?string $title;
    private ?string $content;
    private ?User $userFk;
    private ?Category $categoryFk;
    private ?string $datetime;
    private ?int $status;
    private ?int $modify;

    /**
     * Topic constructor.
     * @param int|null $id
     * @param string|null $title
     * @param string|null $content
     * @param User|null $userFk
     * @param Category|null $categoryFk
     * @param string|null $datetime
     * @param int|null $status
     * @param int|null $modify
     */
    public function __construct(int $id = null, string $title = null, string $content = null, User $userFk = null, Category $categoryFk = null,
                                string $datetime = null, int $status = null, int $modify = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->userFk = $userFk;
        $this->categoryFk = $categoryFk;
        $this->datetime = $datetime;
        $this->status = $status;
        $this->modify = $modify;
    }

    /**
     * Return the id of Topic
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the title of Topic
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the title of Topic
     * @param string|null $title
     * @return Topic
     */
    public function setTitle(?string $title): Topic
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Return the content of Topic
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set the content of Topic
     * @param string|null $content
     * @return Topic
     */
    public function setContent(?string $content): Topic
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Return the user fk of Topic
     * @return User|null
     */
    public function getUserFk(): ?User
    {
        return $this->userFk;
    }

    /**
     * Set the user fk of Topic
     * @param User|null $userFk
     * @return Topic
     */
    public function setUserFk(?User $userFk): Topic
    {
        $this->userFk = $userFk;
        return $this;
    }

    /**
     * Return the category fk of Topic
     * @return Category|null
     */
    public function getCategoryFk(): ?Category
    {
        return $this->categoryFk;
    }

    /**
     * Set the category fk of Topic
     * @param Category|null $categoryFk
     * @return Topic
     */
    public function setCategoryFk(?Category $categoryFk): Topic
    {
        $this->categoryFk = $categoryFk;
        return $this;
    }

    /**
     * Return the datetime of Topic
     * @return string|null
     */
    public function getDatetime(): ?string
    {
        return $this->datetime;
    }

    /**
     * Set the datetime of Topic
     * @param string|null $datetime
     * @return Topic
     */
    public function setDatetime(?string $datetime): Topic
    {
        $this->datetime = $datetime;
        return $this;
    }

    /**
     * Return the status of Topic
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * Set the status of Topic
     * @param int|null $status
     * @return Topic
     */
    public function setStatus(?int $status): Topic
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Return the modify of Topic
     * @return int|null
     */
    public function getModify(): ?int
    {
        return $this->modify;
    }

    /**
     * Set the modify of Topic
     * @param int|null $modify
     * @return Topic
     */
    public function setModify(?int $modify): Topic
    {
        $this->modify = $modify;
        return $this;
    }
}