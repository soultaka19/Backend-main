<?php
    include '../Database/connect.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM lutteurs WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        
        echo "Lutteur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du lutteur: " . $conn->error;
    }

    $conn->close();

