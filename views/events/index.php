<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>AgriPlate DASHBOARD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Favicons -->
    <link href="assets/logo.png" rel="icon">
    <link href="assets/logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        /* Styles CSS pour la présentation de la page */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            text-decoration: underline;
        }

        .button {
            padding: 5px 10px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .button.red {
            background-color: #f44336;
        }

        /* Masquer la modale par défaut */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 20%; /* Déplace la modale 10% vers la droite de l'écran */
    top: 0;
    width: 80%; /* Ajustez la largeur si nécessaire */
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}


        .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        height: 80%;
        position: relative;
        overflow-y: auto; /* Permet le défilement si nécessaire */
    }

    .map-container {
    height: 300px;  /* Hauteur suffisante */
    width: 300px;   /* Largeur définie */
    border: 2px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 20px;
}

#map {
    height: 100%;
    width: 100%;
}

.map-container:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ombre au survol */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

    </style>
</head>


<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="../admin/assets/logo.png" alt="">
            <span class="d-none d-lg-block">AgriPlate DASHBOARD</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Lookin for something ?" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">4</span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have 4 new notifications
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    <li class="dropdown-footer">
                        <a href="#">Show all notifications</a>
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-success badge-number">3</span>
                </a><!-- End Messages Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header">
                        You have 3 new messages
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li class="dropdown-footer">
                        <a href="#">Show all messages</a>
                    </li>
                </ul><!-- End Messages Dropdown Items -->

            </li><!-- End Messages Nav -->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src=c:\Users\hamza\Downloads\admin\admin\admin\assets\img\adminpicture.jpg alt="Profile"
                        class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">BY.IBRAHIM</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>Hamza ben yahia</h6>
                        <span>ADMINISTRATEUR</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->







        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="index.php?action=index">
                <i class="bi bi-gem"></i><span>Event gesture</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
        </li>

</aside><!-- End Sidebar-->


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Events</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Events</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <h1>Liste des événements</h1>
    <!-- Bouton pour afficher la modale -->
    <button id="openModalButton" class="button">
        <i class="fas fa-plus"></i> Créer un événement
    </button>


    <?php if ($events->rowCount() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th id="dateHeader">Date</th>
                    <script>
    document.addEventListener("DOMContentLoaded", function () {
    let isAscending = true; // Track the current sorting order (true = ascending, false = descending)

    // Fonction de tri des événements par date
    document.getElementById("dateHeader").addEventListener("click", function () {
        const table = document.querySelector("table tbody");
        const rows = Array.from(table.rows);

        // Trier les lignes en fonction de la date
        rows.sort(function (rowA, rowB) {
            const dateA = new Date(rowA.cells[2].textContent);
            const dateB = new Date(rowB.cells[2].textContent);

            // Si la direction est croissante, trier normalement (dateA - dateB)
            // Si la direction est décroissante, inverser l'ordre (dateB - dateA)
            return isAscending ? dateA - dateB : dateB - dateA;
        });

        // Réorganiser les lignes triées dans le tableau
        rows.forEach(function (row) {
            table.appendChild(row);
        });

        // Inverser la direction pour le prochain clic
        isAscending = !isAscending;
    });
});

</script>

                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $events->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['id']); ?></td>
                        <td><?= htmlspecialchars($event['titre']); ?></td>
                        <td><?= htmlspecialchars($event['date']); ?></td>
                        <td><?= htmlspecialchars($event['longi']); ?></td>
                        <td><?= htmlspecialchars($event['lat']); ?></td>
                        <td>
                            <a href="index.php?action=edit&id=<?= $event['id']; ?>" class="button">Modifier</a>
                            <a href="index.php?action=delete&id=<?= $event['id']; ?>" class="button red"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun événement trouvé.</p>
    <?php endif; ?>
    <h2>Statistiques des événements</h2>

<div style="width: 70%; margin: auto;">
    <canvas id="eventsByMonthChart"></canvas>
</div>

<div style="width: 70%; margin: auto; margin-top: 30px;">
    <canvas id="eventsByTypeChart"></canvas>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Données fictives pour l'exemple
        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const eventsPerMonth = [12, 15, 9, 18, 24, 5, 8, 13, 20, 30, 10, 16];

        const types = ["Souk", "Not defined", "Not defined", "Not defined"];
        const eventsPerType = [10, 25, 15, 8];

        // Graphique linéaire : Événements par mois
        const ctx1 = document.getElementById("eventsByMonthChart").getContext("2d");
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: months,
                datasets: [{
                    label: "Événements par mois",
                    data: eventsPerMonth,
                    borderColor: "rgba(75, 192, 192, 1)",
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: "top" },
                }
            }
        });

        // Graphique cylindrique (barres) : Événements par type
        const ctx2 = document.getElementById("eventsByTypeChart").getContext("2d");
        new Chart(ctx2, {
            type: "bar",
            data: {
                labels: types,
                datasets: [{
                    label: "Événements par type",
                    data: eventsPerType,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)"
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)"
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: "top" },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>


    <!-- Modale pour créer un événement -->
    <div id="createEventModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>

        <h2>Créer un événement</h2>
        <form id="createEventForm" method="POST" action="index.php?action=create">
            <label for="titre">Titre de l'événement :</label>
            <input type="text" id="titre" name="titre" placeholder="Entrez le titre de l'événement" >

            <label for="date">Date de l'événement :</label>
            <input type="date" id="date" name="date" >

            <label for="longi">Longitude :</label>
            <input type="text" id="longi" name="longi" placeholder="Entrez la longitude" >

            <label for="lat">Latitude :</label>
            <input type="text" id="lat" name="lat" placeholder="Entrez la latitude" >

            <!-- Carte interactive -->
            <div class="map-container">
                <div id="map" ></div>
            </div>

            <button type="submit" class="button">Créer l'événement</button>
        </form>
    </div>
</div>

<!-- Bouton pour ouvrir la modale -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("createEventModal");
        const openModalButton = document.getElementById("openModalButton");
        const closeModalButton = document.querySelector(".close");
        const form = document.getElementById('createEventForm');
        const titreInput = document.getElementById('titre');
        const dateInput = document.getElementById('date');
        const latInput = document.getElementById('lat');
        const longInput = document.getElementById('longi');

        // Ouvrir la modale
        openModalButton.addEventListener("click", function() {
            modal.style.display = "block";
            initMap();  // Initialiser la carte quand la modale s'ouvre
        });

        // Fermer la modale
        closeModalButton.addEventListener("click", function() {
            modal.style.display = "none";
        });

        // Fermer la modale si l'utilisateur clique à l'extérieur
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        // Fonction d'initialisation de la carte Leaflet
        function initMap() {
        const map = L.map('map').setView([36.8065, 10.1815], 13); // Initial position

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Add zoom control
        L.control.zoom().addTo(map);

        // Add a marker to the map
        const marker = L.marker([36.8065, 10.1815], { draggable: true }).addTo(map);

        // Input elements for coordinates
        const latInput = document.getElementById('lat');
        const longInput = document.getElementById('longi');

        // Function to update the input values
        function updateCoordinates(latLng) {
            latInput.value = latLng.lat.toFixed(6);
            longInput.value = latLng.lng.toFixed(6);
        }

        // Update inputs when the marker is moved
        marker.on('move', function (e) {
            updateCoordinates(e.latlng);
        });

        // Update inputs when the map is clicked
        map.on('click', function (e) {
            marker.setLatLng(e.latlng);
            updateCoordinates(e.latlng);
        });

        // Ensure the map resizes correctly
        map.invalidateSize();
    }


        // Validation du formulaire avant l'envoi
        form.addEventListener('submit', function (event) {
            let valid = true;

            // Vérifier que tous les champs sont remplis
            if (!titreInput.value.trim()) {
                alert("Le titre est obligatoire.");
                valid = false;
            }
            if (!dateInput.value) {
                alert("La date est obligatoire.");
                valid = false;
            } else {
                // Vérifier que la date n'est pas dans le passé
                const selectedDate = new Date(dateInput.value);
                const currentDate = new Date();

                // Si la date sélectionnée est dans le passé
                if (selectedDate <= currentDate) {
                    alert("La date de l'événement doit être dans le futur.");
                    valid = false;
                }
            }
            if (!latInput.value.trim() || !longInput.value.trim()) {
                alert("Les coordonnées (latitude et longitude) sont obligatoires.");
                valid = false;
            }

            // Si tout est valide, continuer
            if (!valid) {
                event.preventDefault();  // Empêche la soumission du formulaire si quelque chose manque
            }
        });
    });
</script>


</body>

</html>