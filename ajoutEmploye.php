<?php

include "header.php";
require "db.php";
$error = null;
@$nom = strip_tags($_POST["nom"]);
@$prenom = strip_tags($_POST["prenom"]);
@$email = strip_tags($_POST["email"]);
@$password = $_POST["password"];
@$service = strip_tags($_POST["service"]);
@$salaire = strip_tags($_POST["salaire"]);

if (isset($_POST['envoyer'])) {
    if (empty($nom)) {
        $erreur .= "<p>Le Nom est obligatoire</p>";
    } elseif (strlen($nom) < 2 || strlen($nom) > 50) {
        $erreur .= "<p>Le Nom n'est pas conforme</p>";
    }

    if (empty($prenom)) {
        $erreur .= "<p>Veuillez entrer votre prenom</p>";
    } elseif (strlen($prenom) < 2 || strlen($prenom) > 50) {
        $erreur .= "<p>Veuillez entrer un prenom valide</p>";
    }

    if (empty($email)) {
        $erreur .= "<p>Veuillez entrer un email valide</p>";
    }

    if (empty($password)) {
        $erreur .= "<p>Veuillez entrer un mot de passe valide</p>";
    }

    if (empty($service)) {
        $erreur .= "<p>Veuillez entrer un service</p>";
    }

    if (empty($salaire)) {
        $erreur .= "<p>Veuillez entrer un salaire</p>";
    }
    if (empty($erreur)) {
        try {
            $statement = $pdo->prepare("INSERT INTO employes (email, password, nom, prenom, service, salaire) VALUES (:email, :password, :nom, :prenom, :service, :salaire)");
            $statement->execute([
                'email' => $email,
                'password' => $password,
                'nom' => $nom,
                'prenom' => $prenom,
                'service' => $service,
                'salaire' => $salaire
            ]);
            header("location: employes.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajout Employe</title>
</head>

<body>
    <form id="formulaire" action="" method="post">
        <div>
            <label class="form-label mt-4">Email</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email">
        </div>
        <div>
            <label class="form-label mt-4">Mot de passe</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" name="password">

        </div>

        <div>
            <label class="form-label mt-4">Nom</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" name="nom">
        </div>

        <div>
            <label class="form-label mt-4">Prenom</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" name="prenom">
        </div>

        <div>
            <label class="form-label mt-4">Service</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" name="service">
        </div>
        <div>
            <label class="form-label mt-4">Salaire</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" name="salaire">
        </div>
        <button type="submit" class="btn btn-primary" name="envoyer">Ajouter Employe</button>
    </form>

    <?php if (!empty($erreur)) { ?>
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Warning!</h4>
            <p class="mb-0"></p>
            <?php echo $erreur; ?>
        </div>
    <?php } ?>
</body>

</html>