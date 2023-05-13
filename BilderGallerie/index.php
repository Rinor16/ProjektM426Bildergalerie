<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Bildergalerie</title>
</head>
<body>
    <h1>Bildergalerie</h1>

    <?php
    session_start();
    require 'functions.php';

    // Datenbankverbindung herstellen
    $conn = establishConnection();

    // Datenbank und Tabellen erstellen, falls sie nicht existieren
    createDatabaseIfNotExists($conn);
    createAbteilungTableIfNotExists($conn);
    createAuftraggeberTableIfNotExists($conn);
    createMitarbeiterTableIfNotExists($conn);
    createProjektTableIfNotExists($conn);
    createLoginTableIfNotExists($conn);

    // Bild hinzufügen und in die Datenbank hochladen
    if (isset($_POST['upload'])) {
        $uploadedImage = $_FILES['image']['name'];
        uploadImage($conn, $uploadedImage);
        echo "Bild erfolgreich hochgeladen.";
    }
    ?>

    <!-- Bild hochladen -->
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <input type="submit" name="upload" value="Bild hochladen">
    </form>

    <!-- Weitere HTML-Elemente hier ... -->

    <?php
    // Datenbankverbindung schließen
    closeConnection($conn);
    ?>

</body>
</html>