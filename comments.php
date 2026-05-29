<?php
include("header.php");
include("config.php");

$message = "";
$error = "";

if (isset($_POST["add_comment"])) {
    $name = trim($_POST["name"]);
    $comment = trim($_POST["comment"]);

    if ($name == "" || $comment == "") {
        $error = "Vul je naam en reactie in.";
    } else {
        if (is_logged_in()) {
            $uid = $_SESSION["user_id"];
        } else {
            $uid = null;
        }

        $q = $db->prepare("INSERT INTO comments (user_id, name, comment) VALUES (?, ?, ?)");
        $q->execute([$uid, $name, $comment]);

        $message = "Je bericht werd toegevoegd.";
    }
}

$comments = $db->query("SELECT * FROM comments ORDER BY created_at DESC")
               ->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container page">
    <section class="page-title">
        <p class="overline">Recensies</p>

        <h1>Recensies van klanten</h1>

        <p>Laat hier je eerlijke mening achter.</p>
    </section>

    <section class="form-card wide">
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
                value="<?php if (is_logged_in()) echo clean($_SESSION["name"]); ?>"
                required
            >

            <label>Bericht</label>

            <textarea
                id="comment"
                name="comment"
                rows="5"
                maxlength="300"
                onkeyup="countCharacters()"
                required
            ></textarea>

            <p id="char-counter">0 / 300 tekens</p>

            <input
                type="submit"
                name="add_comment"
                value="Bericht plaatsen"
                class="button primary"
            >
        </form>
    </section>

    <section class="comment-grid">
        <?php foreach ($comments as $c) { ?>
            <article class="comment-card">
                <h2><?php echo clean($c["name"]); ?></h2>

                <p><?php echo nl2br(clean($c["comment"])); ?></p>

                <small><?php echo clean($c["created_at"]); ?></small>
            </article>
        <?php } ?>
    </section>
</main>

<?php include("footer.php"); ?>