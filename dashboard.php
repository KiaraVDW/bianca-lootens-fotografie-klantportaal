<?php
include("header.php");
include("config.php");

require_login();

$q = $db->prepare("SELECT * FROM shoot_requests WHERE user_id = ? ORDER BY created_at DESC");
$q->execute([$_SESSION["user_id"]]);
$req = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container page">
    <section class="portal-hero">
        <p class="overline">Klantportaal</p>

        <h1>Welkom, <?php echo clean($_SESSION["name"]); ?></h1>

        <p>Bekijk je aanvragen of laat een recensie achter.</p>

        <div class="button-row">
            <a href="request.php" class="button primary">
                Nieuwe aanvraag
            </a>

            <a href="comments.php" class="button light">
                Recensies
            </a>

            <?php if (is_admin()) { ?>
                <a href="admin.php" class="button dark">
                    Beheer
                </a>
            <?php } ?>
        </div>
    </section>

    <section class="panel">
        <h2>Mijn aanvragen</h2>

        <?php if (count($req) == 0) { ?>
            <p>Je hebt nog geen aanvragen geplaatst.</p>
        <?php } else { ?>
            <div class="table-wrap">
                <table>
                    <tr>
                        <th>Type</th>
                        <th>Formule</th>
                        <th>Datum</th>
                        <th>Status</th>
                        <th>Aangemaakt</th>
                    </tr>

                    <?php foreach ($req as $r) { ?>
                        <tr>
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

                            <td><?php echo clean($r["created_at"]); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
    </section>
</main>

<?php include("footer.php"); ?>