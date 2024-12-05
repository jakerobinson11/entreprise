<?php
require "db.php";


var_dump($_GET);

try {
    $stat = $pdo->prepare("DELETE FROM employes WHERE id_employes = :id");
    $stat->execute([
        "id" => $_GET["id_employes"]
    ]);
    header("location:employes.php");
    exit;
} catch (PDOException $e) {
    echo $e->getMessage();
}
