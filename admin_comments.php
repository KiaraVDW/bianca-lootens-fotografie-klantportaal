<?php
include("header.php");
include("config.php");

require_login();
require_admin();

if (isset($_GET["delete"])) {
    $d = $db->prepare("DELETE FROM comments WHERE id = ?");
    $d->execute([$_GET["delete"]]);

    header("Location: admin_comments.php");
    exit();
}

$comments = $db->query("SELECT * FROM comments ORDER BY created_at DESC")
               ->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container page">
    <section class="page-title">
        <p class="overline">Beheer</p>

        <h1>Recensies beheren</h1>
    </section>

    <section class="comment-grid">
        <?php foreach ($comments as $c) { ?>
            <article class="comment-card">
                <h2><?php echo clean($c["name"]); ?></h2>

                <p><?php echo nl2br(clean($c["comment"])); ?></p>

                <small><?php echo clean($c["created_at"]); ?></small>

                <div class="button-row">
                    <a
                        href="edit_comment.php?id=<?php echo $c["id"]; ?>"
                        class="button small primary"
                    >
                        Aanpassen
                    </a>

                    <a
                        href="admin_comments.php?delete=<?php echo $c["id"]; ?>"
                        class="button small dark"
                        onclick="return confirm('Ben je zeker?')"
                    >
                        Verwijderen
                    </a>
                </div>
            </article>
        <?php } ?>
    </section>
</main>

<?php include("footer.php"); ?>