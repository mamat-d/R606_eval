<?php
require_once __DIR__ . '/vendor/autoload.php';

use Mathi\R606Eval\Database;

try {
    $p = Database::getDB();
} catch (PDOException $e) {
    echo 'Erreur lors de la connexion à la BDD : ' . $e->getMessage();
    exit();
}

$message = '';

// Traitement de l'ajout d'une nouvelle entrée
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
    $text = trim($_POST['text']);

    if (!empty($text)) {
        try {
            Database::addEntry($text);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } catch (Exception $e) {
            $message = '<p style="color: red; font-weight: bold;">Erreur lors de l\'ajout : ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
    } else {
        $message = '<p style="color: orange; font-weight: bold;">Veuillez saisir du texte.</p>';
    }
}

try {
    $d = $p->query("SELECT id,text FROM db_table")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo 'Erreur lors du chargement des données : ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>R6.06 Maintenance applicative</title>
</head>

<body>
    <header>
        <h1>R6.06 Maintenance applicative</h1>
        <h2 style="color: crimson">Evaluation</h2>
        <p style="color: crimson">Modifiez ce projet à l'aide des outils vus ensemble pour améliorer la maintenabilité de ce projet et déployez le sur le serveur mis à votre disposition</p>
        <p style="color: crimson">Vous êtes libre de modifier ce que vous souhaitez sur le projet, chaque amélioration (ou début d'amélioration) sera prise en compte dans la notation</p>
        <p style="color: crimson; font-weight: bold; border: solid 2px crimson; padding: 5px; width: fit-content;">Pensez à inviter cdiiv sur votre projet Github</p>
    </header>

    <?php if ($message): ?>
        <?= $message ?>
    <?php endif; ?>

    <section style="margin: 20px 0; padding: 15px; border: 2px solid #333; background-color: #f5f5f5;">
        <h3>Ajouter une nouvelle entrée</h3>
        <form method="POST" action="">
            <label for="text">Texte :</label>
            <input type="text" id="text" name="text" required style="width: 300px; padding: 5px; margin-left: 10px;">
            <button type="submit" style="padding: 5px 15px; margin-left: 10px; cursor: pointer;">Ajouter</button>
        </form>
    </section>

    <h3>Liste des entrées</h3>
    <table>
        <thead style="font-weight: bold;">
            <tr>
                <td style="border: solid black 1px">Id</td>
                <td style="border: solid black 1px">Text</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;
            while (true) {
                if (!key_exists($i, $d)) break; ?>
                <tr>
                    <td style="border: solid black 1px"><?= $d[$i]['id'] ?></td>
                    <td style="border: solid black 1px"><?= $d[$i]['text'] ?></td>
                </tr>
            <?php $i++;
            } ?>
        </tbody>
    </table>
</body>

</html>