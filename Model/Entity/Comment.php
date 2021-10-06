<?php


namespace App\Model\Entity;


class Comment {
    private ?int $id;
    private ?string $content;
    private ?User $userFk;
    private ?Topic $topicFk;
    private ?int $report;

    /**
     * Comment constructor.
     * @param int|null $id
     * @param string|null $content
     * @param User|null $userFk
     * @param Topic|null $topicFk
     * @param int|null $report
     */
    public function __construct(int $id = null, string $content = null, User $userFk = null, Topic $topicFk = null, int $report = null)
    {
        $this->id = $id;
        $this->content = $content;
        $this->userFk = $userFk;
        $this->topicFk = $topicFk;
        $this->report = $report;
    }

    /**
     * Return the id of Comment
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the content of Comment
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set the content of Comment
     * @param string|null $content
     * @return Comment
     */
    public function setContent(?string $content): Comment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Return the user fk of Comment
     * @return User|null
     */
    public function getUserFk(): ?User
    {
        return $this->userFk;
    }

    /**
     * Set the user fk of Comment
     * @param User|null $userFk
     * @return Comment
     */
    public function setUserFk(?User $userFk): Comment
    {
        $this->userFk = $userFk;
        return $this;
    }

    /**
     * Return the topic fk of Comment
     * @return Topic|null
     */
    public function getTopicFk(): ?Topic
    {
        return $this->topicFk;
    }

    /**
     * Set the topic fk of Comment
     * @param Topic|null $topicFk
     * @return Comment
     */
    public function setTopicFk(?Topic $topicFk): Comment
    {
        $this->topicFk = $topicFk;
        return $this;
    }

    /**
     * Return the report of Comment
     * @return int|null
     */
    public function getReport(): ?int
    {
        return $this->report;
    }

    /**
     * Set the report of Comment
     * @param int|null $report
     * @return Comment
     */
    public function setReport(?int $report): Comment
    {
        $this->report = $report;
        return $this;
    }
}