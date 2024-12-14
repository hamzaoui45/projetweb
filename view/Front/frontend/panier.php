<?php
include '../../../controller/ProduitC.php';
include '../../../controller/PanierC.php';

$PanierC = new PanierC();
$ProduitC = new ProduitC();
$idUser = 1; // Static user ID for demonstration
$cartItems = $PanierC->AfficherPanier();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriPlate - Agriculture & Food Marketplace</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
        <div class="cart-list">
    <form>
    <table class="table cart-table">
    <thead>
        <tr>
            <th class="product-thumbnail">Image</th>
            <th class="product-name">Product</th>
            <th class="product-price">Price</th>
            <th class="product-quantity">Quantity</th>
            <th class="product-subtotal">Total</th>
            <th class="product-remove">Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                $idProduit = $ProduitC->RecupererProduit($item['idProduit']);
                $nomProduit = $idProduit['nomProduit'];
                ?>
                <tr class="cart-item" data-prix-total="<?php echo $item['prixTotal']; ?>" data-id-panier="<?php echo $item['idPanier']; ?>">
                    <td class="product-thumbnail">
                        <a class="bg-image" style="background-image: url('path/to/image.jpg');"></a>
                    </td>
                    <td class="product-name"><strong><?php echo $nomProduit; ?></strong></td>
                    <td class="product-price"><span class="amount"><?php echo $item['prix']; ?> €</span></td>
                    <td class="product-quantity">
                        <div>
                            <div class="dec qtybutton" data-id="<?php echo $item['idProduit']; ?>" data-price="<?php echo $item['prix']; ?>">-</div>
                            <input type="text" value="<?php echo $item['quantite']; ?>" class="cart-plus-minus-box" id="quantity-<?php echo $item['idProduit']; ?>" readonly>
                            <div class="inc qtybutton" data-id="<?php echo $item['idProduit']; ?>" data-price="<?php echo $item['prix']; ?>">+</div>
                        </div>
                    </td>
                    <td class="product-subtotal">
                        <span class="amount"><strong><?php echo $item['prixTotal']; ?> €</strong></span>
                    </td>
                    <td class="product-remove">
                        <a class="remove" href="remove_from_cart.php?idProduit=<?php echo $item['idProduit']; ?>"><i class="fas fa-times"></i></a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="6" class="text-center">Your cart is empty!</td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="6" class="text-end">
                <a href="products.php" class="btn btn-default hide-from-sm">Continue Shopping</a>
            </td>
        </tr>
    </tbody>
</table>

<!-- The "Add Command" Button -->
<div class="text-end">
    <a id="add-command-btn" class="btn btn-primary btn-sm" href="addCommand.php">Ajouter commande</a>
</div>


    </form>
</div>
					<!-- End cart list -->
    </section>

    <script>
    document.querySelectorAll('.qtybutton').forEach(button => {
        button.addEventListener('click', function () {
            const idProduit = this.getAttribute('data-id');
            const price = parseFloat(this.getAttribute('data-price'));
            const quantityInput = document.getElementById('quantity-' + idProduit);
            const subtotalElement = this.closest('tr').querySelector('.product-subtotal .amount');
            
            let currentQuantity = parseInt(quantityInput.value);
            if (this.classList.contains('inc')) {
                currentQuantity += 1;
            } else if (this.classList.contains('dec') && currentQuantity > 1) {
                currentQuantity -= 1;
            }

            quantityInput.value = currentQuantity;
            const newTotal = (currentQuantity * price).toFixed(2);
            subtotalElement.textContent = `${newTotal} €`;

            // Update quantity and total on the server
            updateCart(idProduit, currentQuantity);
        });
    });

    function updateCart(idProduit, quantity) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText); // Debug: log server response
            }
        };
        xhr.send(`idProduit=${idProduit}&quantity=${quantity}`);
    }
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Calculate the total price of the cart
    let prixTotal = 0;

    // Loop through each cart item row
    document.querySelectorAll('.cart-item').forEach(function(item) {
        // Get the 'prixTotal' from the data attribute of each cart item
        let itemTotal = parseFloat(item.getAttribute('data-prix-total'));
        prixTotal += itemTotal; // Add to the total
    });

    // Get the button and update the URL with the correct idPanier and prixTotal
    let addCommandBtn = document.getElementById('add-command-btn');
    let idPanier = document.querySelector('.cart-item').getAttribute('data-id-panier'); // Get idPanier from the first item

    // Update the button's href with the correct total price
    addCommandBtn.href = `addCommand.php?idPanier=${idPanier}&prixTotal=${prixTotal.toFixed(2)}`;
});
</script>


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


<style>

.btn-primary {
    padding: 10px 20px;
    background-color: #28a745;
    color: #fff;
    border: none;
    text-transform: uppercase;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #218838;
    color: #fff;
}


    /* General table styling */
.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.cart-table thead {
    background-color: #f8f9fa;
    text-transform: uppercase;
    font-weight: bold;
}

.cart-table th, 
.cart-table td {
    text-align: center;
    padding: 15px;
    border: 1px solid #ddd;
}

.cart-table th {
    color: #343a40;
    font-size: 14px;
}

.cart-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Thumbnail styling */
.product-thumbnail {
    width: 80px;
    height: 80px;
}

.product-thumbnail a {
    display: block;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    border-radius: 8px;
}

/* Quantity controls */
.qtybutton {
    cursor: pointer;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 5px;
    user-select: none;
}

.qtybutton:hover {
    background-color: #0056b3;
}

.cart-plus-minus-box {
    text-align: center;
    border: 1px solid #ccc;
    padding: 5px;
    width: 50px;
    border-radius: 5px;
}

/* Total price styling */
.product-subtotal .amount {
    font-size: 16px;
    font-weight: bold;
    color: #28a745;
}

/* Remove button */
.product-remove .remove {
    color: #dc3545;
    font-size: 18px;
    text-decoration: none;
    cursor: pointer;
}

.product-remove .remove:hover {
    color: #a71d2a;
}

/* Empty cart message */
.cart-table tbody tr td.text-center {
    font-size: 16px;
    font-weight: bold;
    color: #6c757d;
}

/* Continue Shopping button */
.btn-default {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    text-transform: uppercase;
    font-weight: bold;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
}

.btn-default:hover {
    background-color: #0056b3;
    color: #fff;
}

</style>

</body>
</html>
