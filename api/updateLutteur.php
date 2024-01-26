<?
// Autoriser les requêtes CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Supposons que les nouvelles informations du lutteur soient stockées dans la variable $data
$data = json_decode(file_get_contents('php://input'), true);

$id_lutteur = $data['id_lutteur'];
$nom = $data['nom'];
$poids = $data['poids'];
$taille = $data['taille'];
$pays = $data['pays'];
// Ajoutez d'autres champs si nécessaire

try {
    // Préparer la requête pour mettre à jour le lutteur avec l'ID spécifié
    $query = "UPDATE lutteurs SET nom = :nom, poids = :poids, taille = :taille, pays = :pays WHERE id_lutteur = :id_lutteur";
    $stmt = $pdo->prepare($query);

    // Exécuter la requête
    $stmt->execute([':nom' => $nom, ':poids' => $poids, ':taille' => $taille, ':pays' => $pays,':id_lutteur' => $id_lutteur]);

    // Vérifier si le lutteur a été mis à jour
    if ($stmt->rowCount() > 0) {
        $response['success'] = true;
        $response['message'] = 'Lutteur mis à jour avec succès';
    } else {
        $response['message'] = 'Aucune modification n\'a été apportée au lutteur';
    }
} catch (Exception $e) {
    // Gérer les erreurs
    $response['message'] = 'Erreur lors de la mise à jour du lutteur : ' . $e->getMessage();
}

// Renvoyer la réponse au client
echo json_encode($response);