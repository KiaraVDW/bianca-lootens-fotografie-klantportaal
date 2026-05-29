<?php
include("header.php");
include("config.php");

$error = "";

if (isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $q = $db->prepare("SELECT * FROM users WHERE email = ?");
    $q->execute([$email]);
    $user = $q->fetch(PDO::FETCH_ASSOC);

    if ($user && (password_verify($password, $user["password"]) || $password === $user["password"])) {
        if ($password === $user["password"]) {
            $h = password_hash($password, PASSWORD_DEFAULT);

            $u = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
            $u->execute([$h, $user["id"]]);
        }

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["role"] = $user["role"];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "E-mail of wachtwoord is niet correct.";
    }
}
?>

<main class="container form-page">
    <section class="form-card">
        <p class="overline">Klantportaal</p>

        <h1>Login</h1>

        <?php if ($error != "") { ?>
            <p class="error">
                <?php echo clean($error); ?>
            </p>
        <?php } ?>

        <form method="post">
            <label>E-mail</label>

            <input
                type="email"
                name="email"
                required
            >

            <label>Wachtwoord</label>

            <input
                type="password"
                name="password"
                required
            >

            <input
                type="submit"
                name="login"
                value="Inloggen"
                class="button primary full"
            >
        </form>

        <div class="note-box">
            <strong>Admin</strong><br>
            admin@dvsoundlight.be / admin123

            <br><br>

            <strong>Klant</strong><br>
            klant@dvsoundlight.be / klant123
        </div>
    </section>
</main>

<?php include("footer.php"); ?>