<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include_once("functions.php");
?>
<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
            <title>Bianca Lootens Fotografie</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="assets/css/style.css">
            <script src="assets/js/script.js" defer></script>
    </head>
    <body>
<header class="site-header">
    <div class="container header-grid">
        <a href="index.php" class="brand">
            <span>Bianca Lootens</span>
            <small>DV Sound & Light Fotografie</small>
        </a>
        <button class="menu-button" onclick="toggleMenu()">Menu</button>
        <nav id="main-nav"><a class="<?php echo active_page('index.php'); ?>" href="index.php">Home</a>
        <a class="<?php echo active_page('portfolio.php'); ?>" href="portfolio.php">Portfolio</a>
        <a class="<?php echo active_page('packages.php'); ?>" href="packages.php">Pakketten</a>
        <a class="<?php echo active_page('request.php'); ?>" href="request.php">Aanvraag</a>
        <a class="<?php echo active_page('comments.php'); ?>" href="comments.php">Recensies</a>
            <?php if (is_logged_in()) { ?>
                <a class="<?php echo active_page('dashboard.php'); ?>" href="dashboard.php">Portaal</a>
            <?php if (is_admin()) { ?>
                <a class="<?php echo active_page('admin.php'); ?>" href="admin.php">Beheer</a>
            <?php } ?>
                <a class="nav-button" href="logout.php">Uitloggen</a>
            <?php } else { ?>
                <a class="<?php echo active_page('login.php'); ?>" href="login.php">Login</a>
        <a class="nav-button <?php echo active_page('register.php'); ?>" href="register.php">Registreer</a>
            <?php } ?></nav>
    </div>
</header>