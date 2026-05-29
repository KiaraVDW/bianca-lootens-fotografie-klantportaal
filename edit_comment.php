<?php
include("header.php");
include("config.php");

require_login();
require_admin();

$id = $_GET["id"];

$q = $db->prepare("SELECT * FROM comments WHERE id = ?");
$q->execute([$id]);
$c = $q->fetch(PDO::FETCH_ASSOC);

if (!$c) {
    die("Bericht niet gevonden.");
}

if (isset($_POST["save_comment"])) {
    $u = $db->prepare("UPDATE comments SET name = ?, comment = ? WHERE id = ?");
    $u->execute([
        trim($_POST["name"]),
        trim($_POST["comment"]),
        $id
    ]);

    header("Location: admin_comments.php");
    exit();
}
?>

<main class="container form-page">
    <section class="form-card">
        <p class="overline">Bericht</p>

        <h1>Aanpassen</h1>

        <form method="post">
            <label>Naam</label>

            <input
                type="text"
                name="name"
                value="<?php echo clean($c["name"]); ?>"
                required
            >

            <label>Bericht</label>

            <textarea name="comment" rows="6" required><?php echo clean($c["comment"]); ?></textarea>

            <input
                type="submit"
                name="save_comment"
                value="Opslaan"
                class="button primary full"
            >
        </form>
    </section>
</main>

<?php include("footer.php"); ?>