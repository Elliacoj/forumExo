<?php


namespace App\Model\Entity;


class SubComment {
    private ?int $id;
    private ?string $comment;
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
    public function __construct(int $id = null, string $comment = null, User $userFK = null, Comment $commentFk = null, string $report = null)
    {
        $this->id = $id;
        $this->comment = $comment;
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
     * Return the comment of Sub comment
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * Set the comment of Sub comment
     * @param string|null $comment
     * @return SubComment
     */
    public function setComment(?string $comment): SubComment
    {
        $this->comment = $comment;
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