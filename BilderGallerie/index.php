<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Bildergalerie</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Funktion zum Aktualisieren der Bildergalerie
            function updateGallery() {
                $.ajax({
                    url: 'get_gallery.php', // Datei zum Abrufen der Bildergalerie-Daten
                    type: 'GET',
                    success: function(response) {
                        $('#bildergalerie').html(response); // Aktualisiere den Inhalt der Bildergalerie
                    },
                    error: function() {
                        alert('Fehler beim Abrufen der Bildergalerie.');
                    }
                });
            }

            // Rufe die Bildergalerie beim Laden der Seite auf
            updateGallery();

            // Handler für das Hochladen des Bildes
            $('#upload-form').submit(function(event) {
                event.preventDefault(); // Verhindere das Standardverhalten des Formulars

                var formData = new FormData(this);

                $.ajax({
                    url: 'upload_image.php', // Datei zum Hochladen des Bildes
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        updateGallery(); // Aktualisiere die Bildergalerie nach dem Hochladen
                        $('#upload-form')[0].reset(); // Zurücksetzen des Formulars
                    },
                    error: function() {
                        alert('Fehler beim Hochladen des Bildes.');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h1>Bildergalerie</h1>

    <!-- Formular zum Hochladen des Bildes -->
    <form id="upload-form" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <button type="submit">Bild hochladen</button>
    </form>

    <!-- Bildergalerie -->
    <div id="bildergalerie">
        <!-- Hier wird die Bildergalerie dynamisch aktualisiert -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Funktion zum Aktualisieren der Bildergalerie
            function updateGallery() {
                $.ajax({
                    url: 'get_gallery.php', // Datei zum Abrufen der Bildergalerie-Daten
                    type: 'GET',
                    success: function(response) {
                        $('#bildergalerie').html(response); // Aktualisiere den Inhalt der Bildergalerie
                    },
                    error: function() {
                        alert('Fehler beim Abrufen der Bildergalerie.');
                    }
                });
            }

            // Rufe die Bildergalerie beim Laden der Seite auf
            updateGallery();

            // Handler für das Hochladen des Bildes
            $('#upload-form').submit(function(event) {
                event.preventDefault(); // Verhindere das Standardverhalten des Formulars

                var formData = new FormData(this);

                $.ajax({
                    url: 'upload_image.php', // Datei zum Hochladen des Bildes
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        updateGallery(); // Aktualisiere die Bildergalerie nach dem Hochladen
                        $('#upload-form')[0].reset(); // Zurücksetzen des Formulars
                    },
                    error: function() {
                        alert('Fehler beim Hochladen des Bildes.');
                    }
                });
            });
        });
    </script>
</body>
</html>