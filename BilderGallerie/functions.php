<?php
// Funktion zur Herstellung der Datenbankverbindung
function establishConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "firma";

    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
    }

    return $conn;
}

// Funktion zum Erstellen der Datenbank, falls sie nicht existiert
function createDatabaseIfNotExists($conn) {
    $dbname = "firma";

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->query($sql);
    $conn->select_db($dbname);
}



// Funktion zum Erstellen der Tabelle auftraggeber, falls sie nicht existiert
function createAuftraggeberTableIfNotExists($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS auftraggeber (
        auftraggeber_id INT(6) NOT NULL AUTO_INCREMENT,
        bezeichnung VARCHAR(100) NOT NULL,
        kurzname VARCHAR(50) NOT NULL,
        adr_strasse VARCHAR(100),
        adr_plz VARCHAR(10),
        adr_ort VARCHAR(50),
        tel VARCHAR(20),
        fax VARCHAR(20),
        email VARCHAR(100),
        sonderkonditionen VARCHAR(100),
        CONSTRAINT pk_auftraggeber PRIMARY KEY (auftraggeber_id)
    ) ENGINE=InnoDB";

    $conn->query($sql);
}



// Funktion zum Erstellen der Tabelle login, falls sie nicht existiert
function createLoginTableIfNotExists($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS login (
        benutzername VARCHAR(50) NOT NULL,
        passwort VARCHAR(50) NOT NULL,
        usertype INT(6) NOT NULL,
        PRIMARY KEY (benutzername)
    ) ENGINE=InnoDB";

    $conn->query($sql);
}

// Funktion zum Erstellen der Tabelle bilder, falls sie nicht existiert
function createBilderTableIfNotExists($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS bilder (
        bild_id INT(6) NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        CONSTRAINT pk_bilder PRIMARY KEY (bild_id)
    ) ENGINE=InnoDB";

    $conn->query($sql);
}

// Funktion zum Hochladen eines Bildes in die Datenbank
function uploadImage($conn, $imageName) {
    $tableName = "bilder";

    $sql = "INSERT INTO $tableName (name) VALUES ('$imageName')";
    $conn->query($sql);
}

// Funktion zum Abrufen der Bilder aus der Datenbank
function getImages() {
    global $conn, $tableName;
    $sql = "SELECT name FROM $tableName";
    $result = $conn->query($sql);
    $images = '';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imageName = $row['name'];
            $images .= '<img src="images/' . $imageName . '" alt="' . $imageName . '">';
        }
    }

    return $images;
}


// Funktion zur Schließung der Datenbankverbindung
function closeConnection($conn) {
    $conn->close();
}
?>
