<?php
// Autoriser les requêtes CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../database/connect.php';

try {
    // Préparer la requête pour récupérer tous les lutteurs
    $query = "SELECT * FROM lutteurs";
    $stmt = $pdo->prepare($query);

    // Exécuter la requête
    $stmt->execute();

    // Récupérer tous les lutteurs
    $lutteurs = $stmt->fetchAll();

    // Vérifier si des lutteurs ont été trouvés
    if ($stmt->rowCount() > 0) {
        $response['success'] = true;
        $response['message'] = 'Liste des lutteurs récupérée avec succès';
        $response['lutteurs'] = $lutteurs;
    } else {
        $response['message'] = 'Aucun lutteur trouvé';
    }
} catch (Exception $e) {
    // Gérer les erreurs
    $response['message'] = 'Erreur lors de la récupération des lutteurs : ' . $e->getMessage();
}

// Renvoyer la réponse au client
echo json_encode($response);