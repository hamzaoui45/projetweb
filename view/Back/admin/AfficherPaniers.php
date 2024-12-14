<?php
include '../../../Controller/PanierC.php';
include '../../../controller/ProduitC.php';

$PanierC = new PanierC();
$ProduitC = new ProduitC();

$listPaniers = $PanierC->AfficherPanier();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Client gesture</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../admin/assets/logo.png" rel="icon">
  <link href="../admin/assets/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../admin/assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../admin/assets/logo.png" alt="">
        <span class="d-none d-lg-block">Agriplate DASHBOARD</span>
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
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
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
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src=c:\Users\hamza\Downloads\admin\admin\admin\assets\img\adminpicture.jpg alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">BY.hamza</BY></span>
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
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Users gesture</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="clientgesture.html">
              <i class="bi bi-circle"></i><span>Client</span>
            </a>
          </li>
          <li>
            <a href="farmergesture.html">
              <i class="bi bi-circle"></i><span>Farmer</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Product gesture</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="addproducts.html">
              <i class="bi bi-circle"></i><span>Add product</span>
            </a>
          </li>
          <li>
            <a href="deleteproduct.html">
              <i class="bi bi-circle"></i><span>Delete product</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Data Tables</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Command gesture</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="statuscmd.html">
              <i class="bi bi-circle"></i><span>Status</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Blog/Vlog gesture</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="blog.html">
              <i class="bi bi-circle"></i><span>Blog</span>
            </a>
          </li>
          <li>
            <a href="vlog.html">
              <i class="bi bi-circle"></i><span>Vlog</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->
        
      <li class="nav-item">
        <a class="nav-link collapsed"  data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Event gesture</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      </li>
     
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

             <!-- Table Start -->
             <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-12">

                        <div class=" rounded h-100 p-4">
                        <a href="AjouterPanier.php" class="btn btn-primary">Ajouter Panier</a>
                        <a href="AfficherCommandes.php" class="btn btn-success">Listes Commandes</a>
                        <br><br>
                            <h4 class="mb-4">Liste des Paniers</h4>
                            <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID PANIER</th>
                                    <th scope="col">PRODUIT</th>
                                    <th scope="col">USER</th>
                                    <th scope="col">QUANTITÉ</th>
                                    <th scope="col">PRIX</th>
                                    <th scope="col">TOTAL DU PANIER</th>
                                    <th scope="col">COMMANDE</th>
                                    <th scope="col">SUPPRIMER</th>
                                </tr>
                            </thead>
                            <tbody>
                                                <?php
                                    foreach($listPaniers as $panier){
                                ?>
                                    <tr>
                                            <th scope="row"><?php echo $panier['idPanier'];?></th>
                                            <td><?php
                                            $produit = $ProduitC->RecupererProduit($panier['idProduit']);
                                            $nomProduit = $produit['nomProduit'];
                                            echo $nomProduit
                                            ;?>
                                            </td>
                                            <td><?php echo $panier['idUser'];?></td>
                                            <td><?php echo $panier['quantite'];?></td>
                                            <td><?php echo $panier['prix'];?> €</td>
                                            <td><?php echo $panier['prixTotal'];?> €</td>
                                            <td>
                                              <a  class="btn btn-primary btn-sm"   href="AjouterCommande.php?idPanier=<?php echo $panier['idPanier']; ?>">Ajouter commande</a>
                                            </td>
                                            <td>
                                            <a  class="btn btn-danger btn-sm"   href="SupprimerPanier.php?idPanier=<?php echo $panier['idPanier']; ?>">Supprimer</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                        ?>
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>AgriPlate</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="#">CodeCrafters</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>