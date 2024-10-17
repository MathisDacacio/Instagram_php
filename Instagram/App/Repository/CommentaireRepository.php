<?php
namespace App\Repository;

use App\Entity\Commentaires;
use PDO;

class CommentaireRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addCommentaire(Commentaires $commentaire) {
        $stmt = $this->pdo->prepare('INSERT INTO commentaires (user_id, article_id, content, created_at) VALUES (:user_id, :article_id, :content, :created_at)');
        
        // Utiliser une exception pour gérer les erreurs SQL
        try {
            $stmt->execute([
                'user_id' => $commentaire->getUserId(),
                'article_id' => $commentaire->getArticleId(),
                'content' => $commentaire->getContent(),
                'created_at' => $commentaire->getCreatedAt() ?: date('Y-m-d H:i:s') // Date actuelle si non fournie
            ]);
        } catch (\PDOException $e) {
            // Gérer l'erreur (enregistrer dans un log, afficher un message, etc.)
            throw new \Exception("Erreur lors de l'ajout du commentaire : " . $e->getMessage());
        }
    }

    public function removeCommentaire($id) {
        $stmt = $this->pdo->prepare('DELETE FROM commentaires WHERE id = :id');
        
        try {
            $stmt->execute(['id' => $id]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la suppression du commentaire : " . $e->getMessage());
        }
    }

    public function updateCommentaire(Commentaires $commentaire) {
        $stmt = $this->pdo->prepare('UPDATE commentaires SET content = :content WHERE id = :id');
        
        try {
            $stmt->execute([
                'content' => $commentaire->getContent(),
                'id' => $commentaire->getId(),
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour du commentaire : " . $e->getMessage());
        }
    }
}
?>
