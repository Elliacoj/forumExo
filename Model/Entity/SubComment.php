<?php


namespace App\Model\Entity;


class SubComment {
    private ?int $id;
    private ?string $content;
    private ?User $userFK;
    private ?Comment $commentFk;
    private ?string $report;

    /**
     * SubComment constructor.
     * @param int|null $id
     * @param string|null $comment
     * @param User|null $userFK
     * @param Comment|null $commentFk
     * @param string|null $report
     */
    public function __construct(int $id = null, string $content = null, User $userFK = null, Comment $commentFk = null, string $report = null)
    {
        $this->id = $id;
        $this->content = $content;
        $this->userFK = $userFK;
        $this->commentFk = $commentFk;
        $this->report = $report;
    }

    /**
     * Return the id of Sub comment
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the content of Sub comment
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set the content of Sub comment
     * @param string|null $content
     * @return SubComment
     */
    public function setContent(?string $content): SubComment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Return the user fk of Sub comment
     * @return User|null
     */
    public function getUserFK(): ?User
    {
        return $this->userFK;
    }

    /**
     * Set the user fk of Sub comment
     * @param User|null $userFK
     * @return SubComment
     */
    public function setUserFK(?User $userFK): SubComment
    {
        $this->userFK = $userFK;
        return $this;
    }

    /**
     * Return the comment fk of Sub comment
     * @return Comment|null
     */
    public function getCommentFk(): ?Comment
    {
        return $this->commentFk;
    }

    /**
     * Set the comment fk of Sub comment
     * @param Comment|null $commentFk
     * @return SubComment
     */
    public function setCommentFk(?Comment $commentFk): SubComment
    {
        $this->commentFk = $commentFk;
        return $this;
    }

    /**
     * Return the report of Sub comment
     * @return string|null
     */
    public function getReport(): ?string
    {
        return $this->report;
    }

    /**
     * Set the report of Sub comment
     * @param string|null $report
     * @return SubComment
     */
    public function setReport(?string $report): SubComment
    {
        $this->report = $report;
        return $this;
    }
}