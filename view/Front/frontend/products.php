<?php
include '../../../Controller/ProduitC.php';

$ProduitC = new ProduitC();

$listProduit = $ProduitC->AfficherProduits();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriPlate - Agriculture & Food Marketplace</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo">
            <img src="462562198_1103487334732019_7215644507738509228_n (1).png"AgriPlate Logo" width="120">
        </div>
        <nav>
            <a href="index.html">Home</a>
            <a href="products.php">Products</a>
            <a href="panier.php">Panier</a>
            <a href="sellers.html">Sellers</a>
        </nav>
        <div class="auth-buttons">
            <a href="login.html">Log In</a>
            <a href="signup.html">Sign Up</a>

        </div>
        
    </div>
</header>

<main>
    <!-- Slideshow Section -->
    <section>
        <div class="slideshow">
            <div class="slides" id="slides">
                <img src="istockphoto-1127189054-612x612.jpg" alt="Product 1">
                <img src="istockphoto-140453734-612x612.jpg" alt="Product 2">
                <img src="Le-Bec-Hellouin-hotbeds450.jpg" alt="Product 3">
            </div>
            <div class="slideshow-controls">
                <button class="prev" onclick="prevSlide()">&#10094;</button>
                <button class="next" onclick="nextSlide()">&#10095;</button>
            </div>

            <!-- Welcome Text Overlay -->
            <div class="welcome-overlay">
                <h1>Welcome to AgriPlate</h1>
                <p>Your online marketplace connecting farmers and consumers directly.</p>
            </div>
        </div>
    </section>

    <!-- Featured Tunisian Farmers Section -->
    <section>
        <h2>Featured Tunisian Farmers</h2>
        <div class="farmers">
        <?php    
        foreach($listProduit as $produit){
        ?>
            <div class="farmer-box">
                <img src="c:/Users/hamza/Downloads/-1x-1.webp" alt="Farmer Ali">
                <h3><?php echo $produit['nomProduit']; ?></h3>
                <p><?php echo $produit['prix']; ?></p>
                <a href="add_to_cart.php?idProduit=<?php echo $produit['idProduit']; ?>" 
													class="sli-btn sli-btn-cart">
													<i class="fas fa-shopping-bag"></i> Add To Cart
													</a>
            </div>
           <?php }?>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us">
        <h2>About Us</h2>
        <p>AgriPlate is an innovative platform dedicated to connecting farmers with consumers, ensuring fresh, locally grown produce reaches your doorstep. We believe in supporting local agriculture and empowering farmers to expand their reach while offering quality products directly to you.</p>
    </section>
</main>

<footer>
    <p>© 2024 AgriPlate. All Rights Reserved. <a href="#">Privacy Policy</a></p>
</footer>

<script>
    // Cart Toggle Function
    function toggleCart() {
        const cartDropdown = document.getElementById('cartDropdown');
        cartDropdown.classList.toggle('show');
    }

    // Slideshow Functions
    let currentIndex = 0;
    const slides = document.getElementById('slides');
    const images = slides.getElementsByTagName('img');

    function prevSlide() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateSlidePosition();
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % images.length;
        updateSlidePosition();
    }

    function updateSlidePosition() {
        slides.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
</script>

</body>
</html>
