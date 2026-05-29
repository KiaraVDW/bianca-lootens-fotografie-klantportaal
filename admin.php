<?php
include("header.php");
include("config.php");

require_login();
require_admin();

if (isset($_GET["delete_request"])) {
    $d = $db->prepare("DELETE FROM shoot_requests WHERE id = ?");
    $d->execute([$_GET["delete_request"]]);

    header("Location: admin.php");
    exit();
}

$users = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
$comments = $db->query("SELECT COUNT(*) FROM comments")->fetchColumn();
$total = $db->query("SELECT COUNT(*) FROM shoot_requests")->fetchColumn();

$req = $db->query("SELECT * FROM shoot_requests ORDER BY created_at DESC")
          ->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container page">
    <section class="portal-hero">
        <p class="overline">Beheer</p>

        <h1>Studio overzicht</h1>

        <p>Beheer aanvragen en berichten.</p>
    </section>

    <section class="stats-grid">
        <article>
            <strong><?php echo $users; ?></strong>
            <span>gebruikers</span>
        </article>

        <article>
            <strong><?php echo $comments; ?></strong>
            <span>berichten</span>
        </article>

        <article>
            <strong><?php echo $total; ?></strong>
            <span>aanvragen</span>
        </article>
    </section>

    <section class="panel">
        <div class="panel-header">
            <h2>Aanvragen</h2>

            <a href="admin_comments.php" class="button light">
                Recensies beheren
            </a>
        </div>

        <div class="table-wrap">
            <table>
                <tr>
                    <th>Naam</th>
                    <th>E-mail</th>
                    <th>Type</th>
                    <th>Formule</th>
                    <th>Datum</th>
                    <th>Status</th>
                    <th>Actie</th>
                </tr>

                <?php foreach ($req as $r) { ?>
                    <tr>
                        <td><?php echo clean($r["name"]); ?></td>

                        <td><?php echo clean($r["email"]); ?></td>

                        <td><?php echo clean($r["shoot_type"]); ?></td>

                        <td>
                            <?php
                            if (isset($r["package_type"]) && $r["package_type"] != "") {
                                echo clean($r["package_type"]);
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td><?php echo clean($r["shoot_date"]); ?></td>

                        <td>
                            <span class="status">
                                <?php echo clean($r["status"]); ?>
                            </span>
                        </td>

                        <td>
                            <a
                                class="button small primary"
                                href="edit_request.php?id=<?php echo $r["id"]; ?>"
                            >
                                Beheer
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </section>
</main>

<?php include("footer.php"); ?>