<?php
namespace App\Repository;

use App\Entity\Likes;
use PDO;

class LikeRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addLike(Likes $like) {
        $stmt = $this->pdo->prepare('INSERT INTO likes (user_id, article_id, liked_at) VALUES (:user_id, :article_id, :liked_at)');
        $stmt->execute([
            'user_id' => $like->getUserId(),
            'article_id' => $like->getArticleId(),
            'liked_at' => $like->getLikedAt()
        ]);
    }

    public function removeLike($userId, $articleId) {
        $stmt = $this->pdo->prepare('DELETE FROM likes WHERE user_id = :user_id AND article_id = :article_id');
        $stmt->execute([
            'user_id' => $userId,
            'article_id' => $articleId
        ]);
    }

    public function getLikesByArticleId($articleId) {
        $stmt = $this->pdo->prepare('SELECT * FROM likes WHERE article_id = :article_id');
        $stmt->execute(['article_id' => $articleId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Likes::class);
    }

    public function getLikesByUserId($userId) {
        $stmt = $this->pdo->prepare('SELECT * FROM likes WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Likes::class);
    }
}
?>