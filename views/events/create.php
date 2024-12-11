<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>


        form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        #map {
            height: 400px;
            width: 100%;
            margin-bottom: 15px;
        }
        a {
            text-decoration: none;
            color: blue;
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h1 style="text-align: center;">Créer un événement</h1>

    <form method="POST" action="index.php?action=create">
        <label for="titre">Titre de l'événement :</label>
        <input type="text" id="titre" name="titre" placeholder="Entrez le titre de l'événement" >

        <label for="date">Date de l'événement :</label>
        <input type="date" id="date" name="date" >

        <label for="longi">longiitude :</label>
        <input type="text" id="longi" name="longi" placeholder="Entrez la longiitude" >

        <label for="lat">Latitude :</label>
        <input type="text" id="lat" name="lat" placeholder="Entrez la latitude" >

        <!-- Carte interactive -->
        <div id="map"></div>

        <button type="submit">Créer l'événement</button>
        <a href="index.php?action=index">Retour à la liste des événements</a>
    </form>

    <!-- Ajout du script JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialiser la carte
            const map = L.map('map').setView([36.8065, 10.1815], 13); // Coordonnées par défaut : Tunis

            // Ajouter une couche de tuiles (tiles) OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Initialiser un marqueur par défaut
            const defaultLat = 36.8065;
            const defaultLng = 10.1815;
            const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

            // Mettre à jour les champs cachés avec les coordonnées initiales
            document.getElementById('lat').value = defaultLat;
            document.getElementById('longi').value = defaultLng;

            // Mettre à jour les coordonnées lorsque le marqueur est déplacé
            marker.on('move', function(e) {
                const { lat, lng } = e.target.getLatLng();
                document.getElementById('lat').value = lat;
                document.getElementById('longi').value = lng;
            });

            // Mettre à jour la position du marqueur et les champs cachés lorsque la carte est cliquée
            map.on('click', function(e) {
                const { lat, lng } = e.latlng;
                marker.setLatLng(e.latlng); // Déplacer le marqueur
                document.getElementById('lat').value = lat;
                document.getElementById('longi').value = lng;
            });

            // Validation de la date pour vérifier qu'elle est dans le futur
            const dateInput = document.getElementById('date');
            dateInput.addEventListener('change', function() {
                const selectedDate = new Date(dateInput.value);
                const currentDate = new Date();

                // Comparer la date sélectionnée avec la date actuelle
                if (selectedDate <= currentDate) {
                    alert("La date doit être dans le futur !");
                    dateInput.value = '';  // Réinitialiser le champ de la date
                }
            });

            // Validation du formulaire avant la soumission
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const selectedDate = new Date(dateInput.value);
                const currentDate = new Date();

                if (selectedDate <= currentDate) {
                    alert("La date doit être dans le futur !");
                    event.preventDefault();  // Empêche la soumission du formulaire si la date est invalide
                }
            });
        });
    </script>

</body>
</html>
