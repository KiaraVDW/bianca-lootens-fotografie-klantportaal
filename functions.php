<?php
function is_logged_in() {
    return isset($_SESSION["user_id"]);
}

function is_admin() {
    return isset($_SESSION["role"]) && $_SESSION["role"] === "admin";
}

function clean($value) {
    return htmlspecialchars($value ?? "", ENT_QUOTES, "UTF-8");
}

function require_login() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit();
    }
}

function require_admin() {
    if (!is_admin()) {
        header("Location: dashboard.php");
        exit();
    }
}

function active_page($page) {
    if (basename($_SERVER["PHP_SELF"]) === $page) {
        return "active";
    }

    return "";
}
?>