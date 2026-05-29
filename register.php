<?php
include("header.php");
include("config.php");

$message = "";
$error = "";

if (isset($_POST["register"])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $repeat = $_POST["password_repeat"];

    if ($name == "" || $email == "" || $password == "" || $repeat == "") {
        $error = "Vul alle velden in.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Geef een geldig e-mailadres in.";
    } elseif ($password !== $repeat) {
        $error = "De wachtwoorden zijn niet hetzelfde.";
    } else {
        $check = $db->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            $error = "Er bestaat al een account met dit e-mailadres.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $ins = $db->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'visitor')");
            $ins->execute([$name, $email, $hash]);

            $message = "Je account werd aangemaakt. Je kan nu inloggen.";
        }
    }
}
?>

<main class="container form-page">
    <section class="form-card">
        <p class="overline">Nieuw account</p>

        <h1>Registreer</h1>

        <?php if ($message != "") { ?>
            <p class="success">
                <?php echo clean($message); ?>
            </p>
        <?php } ?>

        <?php if ($error != "") { ?>
            <p class="error">
                <?php echo clean($error); ?>
            </p>
        <?php } ?>

        <form method="post">
            <label>Naam</label>

            <input
                type="text"
                name="name"
                required
            >

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

            <label>Herhaal wachtwoord</label>

            <input
                type="password"
                name="password_repeat"
                required
            >

            <input
                type="submit"
                name="register"
                value="Account maken"
                class="button primary full"
            >
        </form>
    </section>
</main>

<?php include("footer.php"); ?>