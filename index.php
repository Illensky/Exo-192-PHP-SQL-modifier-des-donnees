<?php
/**
 * 1. Le dossier SQL contient l'export de ma table user.
 * 2. Trouvez comment importer cette table dans une des bases de données que vous avez créées, si vous le souhaitez vous pouvez en créer une nouvelle pour cet exercice.
 * 3. Assurez vous que les données soient bien présentes dans la table.
 * 4. Créez votre objet de connexion à la base de données comme nous l'avons vu
 * 5. Insérez un nouvel utilisateur dans la base de données user
 * 6. Modifiez cet utilisateur directement après avoir envoyé les données ( on imagine que vous vous êtes trompé )
 */

// TODO Votre code ici.

require __DIR__ . '/Classes/Config.php';
require __DIR__ . '/Classes/DBSingleton.php';

try {
    $pdo = DBSingleton::PDO();

    $stm = $pdo->prepare("
        INSERT INTO user (nom, prenom, rue, numero, code_postal, ville, pays, mail)
        VALUES (:nom, :prenom, :rue, :numero, :code_postal, :ville, :pays, :mail)
    ");

    $nom = 'Laroche';
    $prenom = 'Alexis';
    $rue = 'Rue d\'hirson';
    $numero = 3;
    $code_postal = '02830';
    $ville = 'Saint-Michel';
    $pays = 'France';
    $mail = 'alexis.laroche.02240@gmail.com';

    $stm->bindParam(':nom', $nom);
    $stm->bindParam(':prenom', $prenom);
    $stm->bindParam(':rue', $rue);
    $stm->bindParam(':numero', $numero);
    $stm->bindParam(':code_postal', $code_postal);
    $stm->bindParam(':ville', $ville);
    $stm->bindParam(':pays', $pays);
    $stm->bindParam(':mail', $mail);

    $stm->execute();

    $stm = $pdo->prepare("
        UPDATE user SET nom = :nom WHERE id = :id
    ");

    $nom = "Lerocher";
    $id = 4;

    $stm->bindParam(':nom', $nom);
    $stm->bindParam(':id', $id);

    $stm->execute();
}
catch (PDOException $e) {
    echo "Une erreur est survenue : " . $e->getMessage();
}



/**
 * Théorie
 * --------
 * Pour obtenir l'ID du dernier élément inséré en base de données, vous pouvez utiliser la méthode: $bdd->lastInsertId()
 *
 * $result = $bdd->execute();
 * if($result) {
 *     $id = $bdd->lastInsertId();
 * }
 */