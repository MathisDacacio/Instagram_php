`
<?php
    session_start();
    
    require 'autoload.php';

    use App\Repository\UserRepository;
    use App\Entity\User;

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    // Si l'utilisateur est connecté, on récupère son nom
    $userName = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    if (isset($_SESSION['admin']) || $_SESSION['admin'] === true || ($_SESSION['user_id'] === $_GET['id'])) {

        $id = $_GET['id'];

        $userRepo = new UserRepository();
        $user = $userRepo->read($id);

        if ($user instanceof User) {
            unlink($user->getMediaObject());
            $userRepo->delete($user->getId());
            header('Location: index.php');
            exit;
        } else {
            header('Location: index.php');
            exit;
        }
    } else {
        header('Location: index.php');
        exit;
    }