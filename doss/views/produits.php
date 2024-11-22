<?php include 'views/layout/header.php'; ?>
<h1 class="produits_texte"> COMMANDE EN LIGNE</h1>
<hr>
<section class="section_produits">
    <div class="produits">
        <?php foreach ($produits as $produit): ?>
            <div class="carte">
                <div class="img">
                    <img src="assets/images/produits/<?php echo $produit['image']; ?>" alt="Produit">
                </div>
                <div class="desc"><?php echo $produit['description']; ?></div>
                <div class="titre"><?php echo $produit['nom']; ?></div>
                <div class="box">
                    <span class="prix" data-prix="<?php echo $produit['prix']; ?>"><?php echo $produit['prix']; ?> DINAR</span>
                    <button class="achat" 
                            onclick="addToCart('<?php echo $produit['nom']; ?>', <?php echo $produit['prix']; ?>)">
                        Add to cart
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php include 'views/layout/footer.php'; ?>


