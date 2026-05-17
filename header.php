<?php
$current_page = basename($_SERVER['PHP_SELF']);
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/pandan';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pandàn: Lasa, Kultura, at Tradisyon</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/style.css">

</head>
<body>

<nav class="navbar">
    <div class="nav-container">

        <a href="<?php echo $base_url; ?>/index.php" class="nav-logo">
    <div class="logo-icon">
        <img src="<?php echo $base_url; ?>/assets/images/official_logo.png" 
             alt="Pandàn Logo">
    </div>
    <div class="logo-text">
        <span class="logo-name">Pandàn</span>
        <span class="logo-tagline">Luisiana's Pride</span>
    </div>
</a>

<ul class="nav-links">
    <li><a href="<?php echo $base_url; ?>/index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"><strong>HOME</strong></a></li>
    <li><a href="<?php echo $base_url; ?>/pages/kultura.php" class="<?php echo ($current_page == 'kultura.php') ? 'active' : ''; ?>"><strong>CULTURE</strong></a></li>
    <li><a href="<?php echo $base_url; ?>/pages/products.php" class="<?php echo ($current_page == 'products.php') ? 'active' : ''; ?>"><strong>PRODUCTS</strong></a></li>
    <li><a href="<?php echo $base_url; ?>/pages/contact.php" class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>"><strong>CONTACT</strong></a></li>
</ul>

        <div class="nav-actions">
            <button class="nav-icon-btn" title="Search">
                <i class="fas fa-search"></i>
            </button>
            <button class="nav-icon-btn" title="Wishlist">
                <i class="fas fa-heart"></i>
                <span class="nav-badge"></span>
            </button>
            <button class="nav-icon-btn" title="Cart">
                <i class="fas fa-shopping-cart"></i>
                <span class="nav-badge cart-badge"></span>
            </button>
            <a href="<?php echo $base_url; ?>/auth/login.php" class="btn-login">Login</a>
        </div>

    </div>
</nav>
