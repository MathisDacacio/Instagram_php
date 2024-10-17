<?php
    require 'autoload.php';
    
    use App\Repository\ArticleRepository;

    session_start();
    
    $articleRepo = new ArticleRepository();
    $articles = $articleRepo->findAll();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    $admin = $_SESSION['admin'];

    // Si l'utilisateur est connecté, on récupère son nom
    $userName = $_SESSION['username'];
?>
    <p> Welcome <?php echo $userName ?>
    <br/>
    <a href="logout.php">Deconnexion</a>
    <br/>
    <a href="read.php?id=<?= $_SESSION['user_id'] ?>">Mon profil</a>
    <br/><br/><br/>
    <a href="create_article.php">Créer un article</a>
    <br/>
    <h1>Liste des articles</h1>
    <br/>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
                <h2><?= htmlspecialchars($article->getTitle()) ?></h2>
                <h3>
                <?php if ($article->getImage()): ?>
                    <img src="<?= htmlspecialchars($article->getImage()) ?>" alt="Image de l'article" width="200">
                <?php endif; ?>
                <br/>
                <a href="article.php?id=<?= $article->getId() ?>">Lire l'article</a>
            </li>
        <?php endforeach; ?>
        
        <?php if ($admin == true): ?>
        <a href="list_users.php">Liste des utilisateurs</a>
        <br><br>
        <?php endif; ?>
    </ul>
    