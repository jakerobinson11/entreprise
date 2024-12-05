<?php

include "header.php";

require "db.php";

try {
    $sql = "SELECT * FROM employes";
    $statement = $pdo->query($sql);
    $employes = $statement->fetchAll();
} catch (PDOException $erreur) {
    echo $erreur->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <table class="table table-hover">
        <h3>Liste des employés</h3>
        <thead>
            <tr>
                <th scope="row">Idenfiant</th>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Services</td>
                <td>Salaire</td>
                <td>Email</td>
            </tr>
        </thead>
</head>

<body>
    <tbody>
        <?php foreach ($employes as $employe) { ?>
            <tr class="table-secondary">
                <td><?= $employe['id_employes']    ?> </td>
                <td><?= $employe['nom']    ?> </td>
                <td><?= $employe['prenom']    ?> </td>
                <td><?= $employe['service']    ?> </td>
                <td><?= $employe['salaire']    ?> </td>
                <td><?= $employe['email']    ?> </td>
                <td><a href="modifier.php?id_employes=<?php echo $employe['id_employes']; ?>">Modifier les informations</a></td>
                <td><a href="./supprimer.php?id_employes=<?php echo $employe['id_employes'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');">Supprimer</a> </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
</body>

</html>