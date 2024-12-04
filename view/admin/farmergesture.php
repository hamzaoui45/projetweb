<?php
include 'includes/header.php';
include 'includes/sidebar.php';
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


  <main id="main" class="main">
    <h2 class="iframe-title">Embedded Content</h2>
    <iframe 
        name="iframe"
       src="../userlist.php" 
       class="custom-iframe" 
       title="Custom Embedded Content">
    </iframe>
 </main>
 <style>
    /* Styling the iframe container */
    .main {
       display: flex;
       flex-direction: column;
       align-items: center;
       margin: 20px;
       padding: 10px;
       background-color: #f9f9f9;
       border: 1px solid #ddd;
       border-radius: 8px;
    }
 
    /* Styling the iframe title */
    .iframe-title {
       font-size: 1.5rem;
       font-weight: bold;
       color: #333;
       margin-bottom: 10px;
    }
 
    /* Styling the iframe itself */
    .custom-iframe {
       width: 90%; /* Adjust to your needs */
       max-width: 800px; /* Prevent it from being too wide */
       height: 500px;
       border: 2px solid #ccc;
       border-radius: 8px;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
 
    .custom-iframe:hover {
       border-color: #0078d7; /* Add a highlight effect on hover */
    }
 </style>
 
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