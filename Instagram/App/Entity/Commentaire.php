<?php

namespace App\Entity;

class Commentaires {
    private $id;
    private $userId;
    private $articleId;
    private $content;
    private $createdAt;

    public function __construct($userId, $articleId, $content, $createdAt = null) {
        $this->userId = $userId;
        $this->articleId = $articleId;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getArticleId() {
        return $this->articleId;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setContent($content) {
        $this->content = $content;
    }
}
