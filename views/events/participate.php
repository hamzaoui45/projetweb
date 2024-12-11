<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriPlate - Agriculture & Food Marketplace</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card h3 {
            margin: 0 0 10px;
        }

        .card p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .button {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .button:hover {
            background-color: #45a049;
        }

        .button-icon {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .button-icon:hover {
            background-color: #45a049;
        }

        .button-icon .icon {
            width: 20px;
            /* Adjust size as needed */
            height: 20px;
            margin-right: 10px;
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

            <div class="welcome-overlay">
                <h1>Welcome to AgriPlate</h1>
                <p>Your online marketplace connecting farmers and consumers directly.</p>
            </div>
        </div>
    </section>

    <h1 style="width: 100%; text-align: center; margin-bottom: 20px;">Participer à un événement</h1>
    <a href="index.php?action=user_events" class="button-icon">
        <img src="event.png" alt="My Events Icon" class="icon"> My Events
    </a>

    <?php
// Assuming $eventsWithAddresses is populated correctly (fetch from DB or array)
$eventsPerPage = 6;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($currentPage - 1) * $eventsPerPage;
$totalEvents = count($eventsWithAddresses); 
$totalPages = ceil($totalEvents / $eventsPerPage);
$eventsOnPage = array_slice($eventsWithAddresses, $start, $eventsPerPage);
?>

<div class="grid-container" id="event-grid">
    <?php
    if (empty($eventsOnPage)) {
        echo '<p>No events found.</p>';
    } else {
        foreach ($eventsOnPage as $event):
            $randomImage = 'ph' . rand(1, 3) . '.jpg';
    ?>
    <div class="card" id="card">
        <p><img src="<?= $randomImage; ?>" alt="cover" style="width: 100px; height: 100px;"></p>
        <h3><?= htmlspecialchars($event['titre']); ?></h3>
        <p><strong>Date :</strong> <?= htmlspecialchars($event['date']); ?></p>
        <p><strong>Place :</strong> <?= htmlspecialchars($event['address']); ?></p>

        <form action="index.php?action=join_event" method="POST">
            <input type="hidden" name="event_id" value="<?= $event['id']; ?>">
            <button type="submit" class="button">participate</button>
        </form>
    </div>
    <?php endforeach; } ?>
</div>

<!-- Pagination Controls -->
<div class="pagination">
    <?php if ($currentPage > 1): ?>
        <a href="index.php?action=participate&page=<?= $currentPage - 1; ?>" class="button">Previous</a>
    <?php endif; ?>

    <span>Page <?= $currentPage; ?> of <?= $totalPages; ?></span>

    <?php if ($currentPage < $totalPages): ?>
        <a href="index.php?action=participate&page=<?= $currentPage + 1; ?>" class="button">Next</a>
    <?php endif; ?>
</div>


    <section class="about-us">
        <h2>About Us</h2>
        <p>AgriPlate is an innovative platform dedicated to connecting farmers with consumers, ensuring fresh, locally
            grown produce reaches your doorstep. We believe in supporting local agriculture and empowering farmers to
            expand their reach while offering quality products directly to you.</p>
    </section>

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
