<?php
session_start();

require_once("config/config.php");

$bdd = new bdd();
$bdd->connect();
$message;


if (isset($_POST['ajouter'])) {

    $pseudo = htmlspecialchars(stripslashes(trim($_POST['pseudo2'])));
    $pass = htmlspecialchars($_POST['pass2']);

    $newUser = new Users();
    $newUser->setPseudo($pseudo);
    $newUser->setPassword(password_hash($pass, PASSWORD_ARGON2ID));

    $bdd->addUser($newUser);
}


$users = $bdd->getAll();

if (isset($_POST['connexion'])) {

    $pseudo = htmlspecialchars(stripslashes(trim($_POST['pseudo1'])));
    $pass = htmlspecialchars($_POST['pass1']);

    if (!empty($_POST['pseudo1']) && !empty($_POST['pass1'])) {
        $user = $bdd->connexion(["user" => $pseudo, "pass" => $pass]);
        if ($user) {
            $_SESSION["user"] = $user;
        }
        $message = NULL;
    } else {
        $message = "Une case est vide";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>bdd-test</title>
</head>

<body>
    <header class="h-24 bg-red-900">

    </header>
    <main class="flex flex-col items-center mt-24">
        <h1 class="text-xl mb-2">Formulaire de connexion:</h1>
        <form action="" method="post" class="flex gap-4 flex-col border-2 border-black rounded-lg p-5 mb-1">
            <input class="border-2 border-black rounded-lg p-1" type="text" name="pseudo1" id="" placeholder="Pseudo">
            <input class="border-2 border-black rounded-lg p-1" type="password" name="pass1" id="" placeholder="Mot-de-passe">
            <button class="border-2 border-black rounded-lg p-1" type="submit" name="connexion">Connexion</button>
        </form>
        <?php
        if (isset($message)) {
            print $message;}

        if (isset($_SESSION["user"])) { ?>
            <a class="border-2 border-black rounded-lg p-2" href="logout.php">Déconnexion</a>
        <?php } ?>
        <h1 class="text-xl mt-24 mb-2">Formulaire de d'inscription:</h1>
        <form action="" method="post" class="flex gap-4 flex-col border-2 border-black rounded-lg p-5">
            <input class="border-2 border-black rounded-lg p-1" type="text" name="pseudo2" id="" placeholder="Pseudo">
            <input class="border-2 border-black rounded-lg p-1" type="password" name="pass2" id="" placeholder="Mot-de-passe">
            <button class="border-2 border-black rounded-lg p-1" type="submit" name="ajouter">Ajouter</button>
        </form>

    </main>
</body>

</html>