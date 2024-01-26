<?
// Autoriser les requêtes CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Récupérer les données envoyées par l'application Angular
$data = json_decode(file_get_contents('php://input'), true);
// Supposons que l'id_lutteur du lutteur soit stocké dans la variable $id_lutteur
$id_lutteur = $data['id_lutteur'];

require_once '../database/connect.php';

try {
    // Préparer la requête pour récupérer le lutteur avec l'id_lutteur spécifié
    $query = "SELECT * FROM lutteurs WHERE id_lutteur = :id_lutteur";
    $stmt = $pdo->prepare($query);

    // Exécuter la requête
    $stmt->execute([':id_lutteur' => $id_lutteur]);

    // Récupérer le lutteur
    $lutteur = $stmt->fetch();

    // Vérifier si le lutteur a été trouvé
    if ($lutteur) {
        $response['success'] = true;
        $response['message'] = 'Lutteur récupéré avec succès';
        $response['lutteur'] = $lutteur;
    } else {
        $response['message'] = 'Aucun lutteur trouvé avec cet id_lutteur';
    }
} catch (Exception $e) {
    // Gérer les erreurs
    $response['message'] = 'Erreur lors de la récupération du lutteur : ' . $e->getMessage();
}

// Renvoyer la réponse au client
echo json_encode($response);