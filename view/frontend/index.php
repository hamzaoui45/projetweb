<?php
    session_start();
    $_SESSION["default_token"] ='allow';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriPlate - Agriculture & Food Marketplace</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Dropdown Styling */
        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-icon {
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 10;
            min-width: 150px;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .dropdown-menu a:hover {
            background-color: #f2f2f2;
        }

        .dropdown-menu.show {
            display: block;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-content button {
            margin: 5px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #f0f0f0;
        }

        .modal-content button:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo">
            <img src="logo.png" alt="AgriPlate Logo" width="120">
        </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="products.html">Products</a>
            <a href="sellers.html">Sellers</a>
        </nav>
        <?php if (isset($_SESSION['User'])) { ?>
            <div class="user-dropdown">
                <span id="username-display"><?php echo htmlspecialchars($_SESSION['User']['nom']); ?></span>
                <img src="images/icon.webp" alt="User Icon" class="user-icon" width="40" onclick="toggleUserMenu()">
                <div class="dropdown-menu" id="userDropdown">
                    <a href="cart.html">View Cart</a>
                    <?php if ($_SESSION['User']['role'] == 'Farmer') { ?>
                        <a href="../admin/index.php">Dashboard</a>
                    <?php } ?>
                    <a href="updateuser.php">Edit Profile</a>
                    <a href="logout.php" onclick="confirmSignOut()">Sign Out</a>
                </div>
            </div>
        <?php } else { ?>
            <div class="auth-buttons">
                <a href="login.html">Log In</a>
                <a href="signup.html">Sign Up</a>
            </div>
        <?php } ?>

    </div>
</header>

<main>
    <!-- Slideshow Section -->
    <section>
        <div class="slideshow">
            <div class="slides" id="slides">
                <img src="istockphoto-1127189054-612x612.jpg" alt="Product 1">
                <img src="istockphoto-140453734-612x612.jpg" alt="Product 2">
                <img src="Le-Bec-Hellouin-hotbeds450.jpg"  alt="Product 3">
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
            <div class="farmer-box">
                <img src="c:/Users/hamza/Downloads/-1x-1.webp" alt="Farmer Ali">
                <h3>Farmer Ali</h3>
                <p>Specializes in growing organic olive trees and producing high-quality olive oil from the Tunisian countryside.</p>
            </div>
            <div class="farmer-box">
                <img src="c:/Users/hamza/Downloads/GettyImages-72873786-web.jpg" alt="Farmer Noura">
                <h3>Farmer Noura</h3>
                <p>Known for her premium dates from the oasis of Kebili, providing some of the finest Deglet Nour dates in the world.</p>
            </div>
            <div class="farmer-box">
                <img src="C:\xampp\htdocs\projet web\view\frontend\834129898578_166490569900764.jpg" alt="Farmer Habib">
                <h3>Farmer Habib</h3>
                <p>Produces fresh, sustainable vegetables and herbs grown without pesticides in the fertile soil of Sidi Bouzid.</p>
            </div>
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

<!-- Sign Out Modal -->
<div id="signOutModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to sign out?</p>
        <button onclick="proceedSignOut()">Yes</button>
        <button onclick="closeModal()">No</button>
    </div>
</div>

<script>
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

    // User Dropdown Toggle
    function toggleUserMenu() {
        const userDropdown = document.getElementById('userDropdown');
        userDropdown.classList.toggle('show');
    }

    // Modal Functions
    function confirmSignOut() {
        const modal = document.getElementById('signOutModal');
        modal.style.display = 'block';
    }

    function proceedSignOut() {
        // Redirect to index.html
        window.location.href = "../frontend/index.php";
    }

    function closeModal() {
        const modal = document.getElementById('signOutModal');
        modal.style.display = 'none';
    }

    // Close dropdown when clicking outside
    window.onclick = function (event) {
        const userDropdown = document.getElementById('userDropdown');
        const modal = document.getElementById('signOutModal');
        if (!event.target.matches('.user-icon')) {
            if (userDropdown.classList.contains('show')) {
                userDropdown.classList.remove('show');
            }
        }
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
</script>

</body>
</html>