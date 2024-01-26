<?php
// Autoriser les requêtes CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

require_once '../database/connect.php';

// Récupérer les données envoyées par l'application Angular
$data = json_decode(file_get_contents('php://input'), true);

// Variables pour les données du lutteur
$nom = $data['nom'];
$poids = $data['poids'];
$taille = $data['taille'];
$pays = $data['pays'];

// Réponse par défaut
$response = array('success' => false, 'message' => 'Erreur lors de l\'ajout du lutteur');

try {
    // Effectuer l'opération d'ajout du lutteur dans la base de données
    // Variables pour les données du lutteur
    $nom = $data['nom'];
    $poids = $data['poids'];
    $taille = $data['taille'];
    $pays = $data['pays'];

    $query = "INSERT INTO lutteurs (nom, poids, taille, pays) VALUES (:nom, :poids, :taille, :pays)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':nom' => $nom, ':poids' => $poids, ':taille' => $taille, ':pays' => $pays]);
    // Vérifier si l'opération a réussi
    if ($stmt->rowCount() > 0) {
        $response['success'] = true;
        $response['message'] = 'Lutteur ajouté avec succès';
    }
} catch (Exception $e) {
    // Gérer les erreurs
    $response['message'] = 'Erreur lors de l\'ajout du lutteur : ' . $e->getMessage();
}

// Renvoyer la réponse au client
echo json_encode($response);

