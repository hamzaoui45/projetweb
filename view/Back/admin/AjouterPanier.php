<?php
  include '../../../controller/ProduitC.php';
  include '../../../controller/PanierC.php';

    $Panier = null ;
    $ProduitC = new ProduitC();
    $PanierC = new PanierC();

    if(isset($_POST['idProduit'])&&
       isset($_POST['quantite'])&&
       isset($_POST['prix'])&&
       isset($_POST['prixTotal'])
    ) 
    {
        if(!empty($_POST['idProduit'])&&
           !empty($_POST['quantite'])&&
           !empty($_POST['prix'])&&
           !empty($_POST['prixTotal']))
           {

            $Panier = new Panier(
                $_POST['idProduit'],
                1,
                $_POST['quantite'],
                $_POST['prix'],
                $_POST['prixTotal'],
                
            );
            $PanierC->AjouterPanier($Panier);
            header('Location: AfficherPaniers.php'); 
           }
    }

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
<style>
  .error-message {
    color: red;
    font-size: 0.8em;
    margin-top: 0.2em;
  }
     </style>
       <script src="Controle.js"></script>
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

            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-7">
                        <div class="rounded h-100 p-4">
                            <center><h4 class="mb-4">Ajouter Produit</h4></center>
                            <form method="POST" class="forms-sample" name="form" id="form" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="categorie" class="form-label">Produit</label>
                                    <select class="form-select" name="idProduit" id="idProduit" onchange="updatePrice()">
                                        <?php
                                        function AfficherProduits() {
                                            $sql = "SELECT * FROM Produit";
                                            $db = config::getConnexion();
                                            try {
                                                $liste = $db->query($sql);
                                                return $liste;
                                            } catch (Exception $e) {
                                                die('Erreur:' . $e->getMessage());
                                            }
                                        }
                                        $listProduits = $ProduitC->AfficherProduits();
                                        foreach ($listProduits as $Produit) {
                                        ?>
                                            <option value="<?php echo $Produit['idProduit']; ?>" data-price="<?php echo $Produit['prix']; ?>">
                                                <?php echo $Produit['nomProduit']; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="Quantite" class="form-label">Quantite</label>
                                    <input type="number" class="form-control" name="quantite" id="quantite" min="1" required oninput="calculateTotalPrice()">
                                </div>

                                <div class="mb-3">
                                    <label for="prix" class="form-label">Prix</label>
                                    <input type="text" class="form-control" name="prix" id="prix" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="prixTotal" class="form-label">Prix Total</label>
                                    <span id="prixTotalDisplay">0 €</span>
                                    <input type="hidden" name="prixTotal" id="prixTotal">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="AfficherProduits.php" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
  <script>
    function updatePrice() {
        const selectedProduct = document.querySelector('#idProduit');
        const price = selectedProduct.options[selectedProduct.selectedIndex].dataset.price;
        document.querySelector('#prix').value = price;
        calculateTotalPrice();
    }

    function calculateTotalPrice() {
        const price = parseFloat(document.querySelector('#prix').value) || 0;
        const quantity = parseInt(document.querySelector('#quantite').value) || 0;
        const totalPrice = price * quantity;

        // Update the span for display
        document.querySelector('#prixTotalDisplay').innerText = totalPrice.toFixed(2) + ' €';

        // Update the hidden input for submission
        document.querySelector('#prixTotal').value = totalPrice.toFixed(2);
    }

    // Initialize price on page load
    window.onload = updatePrice;
</script>
</body>

</html>