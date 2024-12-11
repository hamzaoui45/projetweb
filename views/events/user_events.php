<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriPlate - Agriculture & Food Marketplace</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .card h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card p {
            margin: 5px 0;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<header>
    <div class="header-container">
        <div class="logo">
            <img src="bbb.png" alt="AgriPlate Logo" width="120">
        </div>
        <nav>
            <a href="index.html">Home</a>
            <a href="products.html">Products</a>
            <a href="sellers.html">Sellers</a>
            <a href="index.php?action=participate">Events</a>

        </nav>
        <div class="auth-buttons">
            <a href="login.html">Log In</a>
            <a href="signup.html">Sign Up</a>

        </div>
        <div class="cart" onclick="toggleCart()">
            <img src="" alt="Cart Icon">
            <div class="cart-dropdown" id="cartDropdown">
                <p>Your cart is empty.</p>
            </div>
        </div>
    </div>
</header>
<body>


<section>
        <div class="slideshow">
            <div class="slides" id="slides">
                <img src="istockphoto-140453734-170667a.jpg" alt="Product 1">
                <img src="Le-Bec-Hellouin-hotbeds450.jpg" alt="Product 2">
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

    <h1>Mes événements</h1>
    <div class="card-container">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <div class="card">
                    <h2><?= htmlspecialchars($event['titre']); ?></h2>
                    <p><strong>Date :</strong> <?= htmlspecialchars($event['date']); ?></p>
                    <p><strong>Longitude :</strong> <?= htmlspecialchars($event['longi']); ?></p>
                    <p><strong>Latitude :</strong> <?= htmlspecialchars($event['lat']); ?></p>
                    <!-- Bouton pour ajouter des produits à l'événement -->
                    <a href="index.php?action=add_product_to_event&event_id=<?= $event['id']; ?>" class="button">Ajouter des
                        produits</a>
                    <!-- Bouton pour voir les produits -->
                    <a href="index.php?action=view_event_products&event_id=<?= $event['id']; ?>" class="button">Voir</a>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun événement trouvé.</p>
        <?php endif; ?>
    </div>
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
