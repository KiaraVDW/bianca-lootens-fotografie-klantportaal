<?php
include("header.php");
include("config.php");

require_login();
require_admin();

$id = $_GET["id"];

$q = $db->prepare("SELECT * FROM shoot_requests WHERE id = ?");
$q->execute([$id]);
$r = $q->fetch(PDO::FETCH_ASSOC);

if (!$r) {
    die("Aanvraag niet gevonden.");
}

if (isset($_POST["save_request"])) {
    $u = $db->prepare("UPDATE shoot_requests SET status = ?, admin_note = ? WHERE id = ?");
    $u->execute([
        $_POST["status"],
        trim($_POST["admin_note"]),
        $id
    ]);

    header("Location: admin.php");
    exit();
}
?>

<main class="container form-page">
    <section class="form-card">
        <p class="overline">Aanvraag</p>

        <h1><?php echo clean($r["name"]); ?></h1>

        <div class="note-box">
            <p>
                <strong>E-mail:</strong>
                <?php echo clean($r["email"]); ?>
            </p>

            <p>
                <strong>Type:</strong>
                <?php echo clean($r["shoot_type"]); ?>
            </p>

            <p>
                <strong>Datum:</strong>
                <?php echo clean($r["shoot_date"]); ?>
            </p>

            <p>
                <strong>Bericht:</strong><br>
                <?php echo nl2br(clean($r["message"])); ?>
            </p>
        </div>

        <form method="post">
            <label>Status</label>

            <select name="status">
                <option <?php if ($r["status"] == "Nieuw") echo "selected"; ?>>
                    Nieuw
                </option>

                <option <?php if ($r["status"] == "Gelezen") echo "selected"; ?>>
                    Gelezen
                </option>

                <option <?php if ($r["status"] == "In behandeling") echo "selected"; ?>>
                    In behandeling
                </option>

                <option <?php if ($r["status"] == "Afgewerkt") echo "selected"; ?>>
                    Afgewerkt
                </option>
            </select>

            <label>Interne notitie</label>

            <textarea name="admin_note" rows="5"><?php echo clean($r["admin_note"]); ?></textarea>

            <input
                type="submit"
                name="save_request"
                value="Opslaan"
                class="button primary full"
            >
        </form>
    </section>
</main>

<?php include("footer.php"); ?>