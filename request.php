<?php
include("header.php");
include("config.php");

$message = "";
$error = "";

if (isset($_POST["send_request"])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $shoot_type = trim($_POST["shoot_type"]);
    $package_type = trim($_POST["package_type"]);
    $shoot_date = trim($_POST["shoot_date"]);
    $message_text = trim($_POST["message"]);

    if ($name === "" || $email === "" || $shoot_type === "" || $package_type === "" || $shoot_date === "" || $message_text === "") {
        $error = "Vul alle velden in.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Geef een geldig e-mailadres in.";
    } else {
        $user_id = null;
        if (is_logged_in()) {
            $user_id = $_SESSION["user_id"];
        }

        $query = $db->prepare("INSERT INTO shoot_requests (user_id, name, email, shoot_type, package_type, shoot_date, message, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'Nieuw')");
        $query->execute([$user_id, $name, $email, $shoot_type, $package_type, $shoot_date, $message_text]);

        $message = "Je aanvraag werd verzonden.";
    }
}
?>
<main class="container form-page two-column">
    <section class="form-card">
        <p class="overline">Boeking</p>
        <h1>Vraag een shoot aan</h1>

        <?php if ($message !== "") { echo "<p class='success'>" . clean($message) . "</p>"; } ?>
        <?php if ($error !== "") { echo "<p class='error'>" . clean($error) . "</p>"; } ?>

        <form method="post" action="request.php">
            <label for="name">Naam</label>
            <input type="text" id="name" name="name" value="<?php if (is_logged_in()) { echo clean($_SESSION["name"]); } ?>" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="<?php if (is_logged_in()) { echo clean($_SESSION["email"]); } ?>" required>

            <label for="shoot_type">Type shoot</label>
            <select id="shoot_type" name="shoot_type" required>
                <option value="">Maak je keuze</option>
                <option value="Huisdieren">Huisdieren</option>
                <option value="Familie en vrienden">Familie en vrienden</option>
                <option value="Portret">Portret</option>
                <option value="Huwelijken en events">Huwelijken en events</option>
                <option value="Baby en kinderen">Baby en kinderen</option>
                <option value="Zwangerschap">Zwangerschap</option>
                <option value="Bandpics">Bandpics</option>
                <option value="Concertfotografie">Concertfotografie</option>
            </select>

            <label for="package_type">Gewenste formule</label>
            <select id="package_type" name="package_type" onchange="updatePrice()" required>
                <option value="">Kies een formule</option>
                <option value="Fotoshoot studio">Fotoshoot studio</option>
                <option value="Fotoshoot op locatie">Fotoshoot op locatie</option>
                <option value="Groei-abonnement">Groei-abonnement</option>
                <option value="Huwelijk of event">Huwelijk of event</option>
                <option value="Concert of bandreportage">Concert of bandreportage</option>
            </select>

            <label for="shoot_date">Gewenste datum</label>
            <input type="date" id="shoot_date" name="shoot_date" required>

            <label for="message">Bericht</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <input type="submit" name="send_request" value="Aanvraag verzenden" class="button primary full">
        </form>
    </section>

    <aside class="price-card">
        <p class="overline">Indicatie</p>
        <h2>Richtprijs</h2>
        <div id="price-estimate">Kies eerst een formule</div>
        <p>Deze prijs is enkel een indicatie. De definitieve prijs wordt besproken na contact.</p>
    </aside>
</main>
<?php include("footer.php"); ?>
