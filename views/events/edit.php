<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>AgriPlate DASHBOARD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

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
        height: 100px; /* Hauteur spécifique pour la carte */
        width: 300px; /* Hauteur spécifique pour la carte */

        border: 2px solid #ddd;
        border-radius: 8px;
        overflow: hidden; /* Empêche le débordement */
        margin-bottom: 20px;
    }

    /* Carte à l'intérieur du conteneur */
    #map {
        height: 100%;
        width: 100%;
    }

    /* Ajustements supplémentaires pour le conteneur */
    .map-container:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ombre au survol */
    }

        /* Bouton de fermeture */
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
        <h1>Events Edit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item "><a href="index.php?action=index">Events</a></li>
                <li class="breadcrumb-item active">Edit</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <form id="editEventForm" method="POST" action="index.php?action=edit&id=<?= $event['id']; ?>">
    <label for="titre">Titre:</label>
    <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($event['titre']) ?>">
    <span class="error" id="titreError"></span>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" value="<?= htmlspecialchars($event['date']) ?>">
    <span class="error" id="dateError"></span>

    <label for="longi">Longitude:</label>
    <input type="text" id="longi" name="longi" value="<?= htmlspecialchars($event['longi']) ?>">
    <span class="error" id="longiError"></span>

    <label for="lat">Latitude:</label>
    <input type="text" id="lat" name="lat" value="<?= htmlspecialchars($event['lat']) ?>">
    <span class="error" id="latError"></span>

    <button type="submit">Modifier</button>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("editEventForm");

        form.addEventListener("submit", function (event) {
            let valid = true;

            // Réinitialiser les messages d'erreur
            document.querySelectorAll('.error').forEach(span => span.textContent = '');

            const titre = document.getElementById("titre").value.trim();
            const date = document.getElementById("date").value;
            const longi = document.getElementById("longi").value.trim();
            const lat = document.getElementById("lat").value.trim();

            // Validation du titre
            if (!titre) {
                document.getElementById("titreError").textContent = "Le champ 'Titre' est obligatoire.";
                valid = false;
            }

            // Validation de la date
            if (!date) {
                document.getElementById("dateError").textContent = "Le champ 'Date' est obligatoire.";
                valid = false;
            } else {
                const selectedDate = new Date(date);
                const currentDate = new Date();
                if (selectedDate < currentDate) {
                    document.getElementById("dateError").textContent = "La date ne peut pas être dans le passé.";
                    valid = false;
                }
            }

            // Validation de la longitude
            if (!longi || isNaN(longi)) {
                document.getElementById("longiError").textContent = "La longitude doit être un nombre valide.";
                valid = false;
            }

            // Validation de la latitude
            if (!lat || isNaN(lat)) {
                document.getElementById("latError").textContent = "La latitude doit être un nombre valide.";
                valid = false;
            }

            // Empêche la soumission si une validation échoue
            if (!valid) {
                event.preventDefault();
            }
        });
    });
</script>

<style>
    .error {
        color: red;
        font-size: 0.9em;
        margin-top: 5px;
        display: block;
    }
</style>

</main><!-- End #main -->

