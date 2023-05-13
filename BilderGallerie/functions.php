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

// Funktion zum Erstellen der Tabelle abteilung, falls sie nicht existiert
function createAbteilungTableIfNotExists($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS abteilung (
        abteilung_id INT(6) NOT NULL AUTO_INCREMENT,
        bezeichnung VARCHAR(100),
        aufgaben VARCHAR(100),
        CONSTRAINT pk_abteilung PRIMARY KEY (abteilung_id)
    ) ENGINE=InnoDB";

    $conn->query($sql);
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

// Funktion zum Erstellen der Tabelle mitarbeiter, falls sie nicht existiert
function createMitarbeiterTableIfNotExists($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS mitarbeiter (
        person_id INT(6) NOT NULL AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        vorname VARCHAR(50) NOT NULL,
        tel VARCHAR(20),
        email VARCHAR(100),
        gehalt FLOAT(10,2),
        stellung VARCHAR(50),
        fk_abteilung_id INT(6) NOT NULL,
        CONSTRAINT pk_mitarbeiter PRIMARY KEY (person_id),
        CONSTRAINT fk_abteilung FOREIGN KEY (fk_abteilung_id) REFERENCES abteilung (abteilung_id)
    ) ENGINE=InnoDB";

    $conn->query($sql);
}

// Funktion zum Erstellen der Tabelle projekt, falls sie nicht existiert
function createProjektTableIfNotExists($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS projekt (
        projekt_id INT(6) NOT NULL AUTO_INCREMENT,
        bezeichnung VARCHAR(100) NOT NULL,
        beschreibung VARCHAR(200),
        beginn DATE,
        ende DATE,
        auftragsvolumen FLOAT(15,2),
        fk_auftraggeber_id INT(6),
        fk_projektleiter_id INT(6),
        CONSTRAINT pk_projekt PRIMARY KEY (projekt_id),
        CONSTRAINT fk_projektleiter FOREIGN KEY (fk_projektleiter_id) REFERENCES mitarbeiter (person_id),
        CONSTRAINT fk_auftraggeber FOREIGN KEY (fk_auftraggeber_id) REFERENCES auftraggeber (auftraggeber_id)
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

// Funktion zur Schließung der Datenbankverbindung
function closeConnection($conn) {
    $conn->close();
}
?>
