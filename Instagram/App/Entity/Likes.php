<?php
namespace App\Entity;

class Likes {
    private $userId;
    private $articleId;
    private $likedAt;

    public function __construct($userId, $articleId, $likedAt = null) {
        $this->userId = $userId;
        $this->articleId = $articleId;
        $this->likedAt = $likedAt ?? date('Y-m-d H:i:s');
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getArticleId() {
        return $this->articleId;
    }

    public function getLikedAt() {
        return $this->likedAt;
    }
}
?>

