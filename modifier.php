<?php

include "header.php";
require "db.php";

$error = null;
@$nom = strip_tags($_POST["nom"]);
@$prenom = strip_tags($_POST["prenom"]);
@$email = strip_tags($_POST["email"]);
$password = @$_POST["password"];
@$service = strip_tags($_POST["service"]);
@$salaire = strip_tags($_POST["salaire"]);

$statement = $pdo->prepare("SELECT * from employes where id_employes = :id");
$statement->execute([
    "id" => $_GET['id_employes']
]);

$employe = $statement->fetch();
// var_dump($employe);

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

    if (empty($service)) {
        $erreur .= "<p>Veuillez entrer un service</p>";
    }

    if (empty($salaire)) {
        $erreur .= "<p>Veuillez entrer un salaire</p>";
    }
    if (empty($erreur)) {
        try {
            $sql = "UPDATE employes SET nom = :nom, prenom = :prenom, email = :email, service = :service, salaire = :salaire WHERE id_employes = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                "nom" => $_POST["nom"],
                "prenom" => $_POST["prenom"],
                "email" => $_POST["email"],
                "service" => $_POST["service"],
                "salaire" => $_POST["salaire"],
                "id" => $_GET["id_employes"]
            ]);
            header("Location: employes.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>


<form action="" method="post">


    <div>
        <label class="form-label mt-4">nom</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="nom" value="<?php echo @$employe['nom'] ?>">
    </div>

    <div>
        <label class="form-label mt-4">prenom</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="prenom" value="<?php echo @$employe['prenom'] ?>">
    </div>

    <div>
        <label class="form-label mt-4">service</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="service" value="<?php echo @$employe['service'] ?>">
    </div>
    <div>
        <label class="form-label mt-4">salaire</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="salaire" value="<?php echo @$employe['salaire'] ?>">
    </div>
    <div>
        <label class="form-label mt-4">Email</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo @$employe['email'] ?>">
    </div>
    <button type="submit" class="btn btn-outline-success" name="envoyer">Modifier Employer</button>


</form>