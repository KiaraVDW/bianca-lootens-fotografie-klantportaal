<?php include("header.php"); ?>
<main class="container page">
    <section class="page-title">
        <p class="overline">Portfolio</p>
        <h1>Fotografie met gevoel</h1>
        <p>Een selectie uit mijn portfolio</p>
    </section>

    <section class="portfolio-list">
        <?php
        $items = [
            ['huisdieren1.jpg', 'Huisdieren', 'Toffe beelden van honden, katten en andere trouwe vrienden.'],
            ['familie1.png', 'Familie & vrienden', 'Ontspannen momenten met mensen die belangrijk zijn.'],
            ['portret.jpg', 'Portret', 'Portretten met een persoonlijke uitstraling.'],
            ['huwelijk.png', 'Huwelijken & events', 'Reportages voor bijzondere dagen en events.'],
            ['kinderen.jpg', 'Baby & kinderen', 'Mooie beelden van kleine momenten die snel voorbijgaan.'],
            ['zwangerschappen.png', 'Zwangerschap', 'Een rustige reeks rond verwachting en nieuw leven.'],
            ['bandpics.jpg', 'Bandpics', 'Promobeelden voor bands, artiesten en releases.'],
            ['concert1.jpg', 'Concertfotografie', 'Sfeer en muziek vastgelegd op het juiste moment.']
        ];

        foreach ($items as $i => $it) {
            $rev = $i % 2 ? ' reverse' : '';
            echo '<article class="portfolio-row' . $rev . '">';
            echo '<img src="assets/img/portfolio/' . $it[0] . '" alt="' . clean($it[1]) . '">';
            echo '<div><h2>' . clean($it[1]) . '</h2><p>' . clean($it[2]) . '</p></div>';
            echo '</article>';
        }
        ?>
    </section>
</main>
<?php include("footer.php"); ?>
