<?php include 'header.php'; ?>

<section class="home">

    <aside class="opening">
        <h3>Openingstijden</h3>

        <div class="tijden">
            <div>Maandag</div><div>09:00 - 17:00</div>
            <div>Dinsdag</div><div>09:00 - 17:00</div>
            <div>Woensdag</div><div>09:00 - 17:00</div>
            <div>Donderdag</div><div>09:00 - 19:00</div>
            <div>Vrijdag</div><div>09:00 - 17:00</div>
            <div>Zaterdag</div><div>10:00 - 14:00</div>
            <div>Zondag</div><div>Gesloten</div>
        </div>

    </aside>

    <div class="content">

        <div class="hero">Welkom bij de Bibliotheek</div>

        
        <form method="GET" action="">
            <input type="text" name="zoek" placeholder="Zoek een boek..." class="zoekbalk">
            <button type="submit">Zoek</button>
        </form>

        <?php
        
        $boeken = [
            "De Ontdekking van de Hemel - Harry Mulisch",
            "1984 - George Orwell",
            "Harry Potter en de Steen der Wijzen - J.K. Rowling",
            "Het Achterhuis - Anne Frank",
            "De Zeven Zussen - Lucinda Riley",
            "Sapiens - Yuval Noah Harari",
            "De Alchemist - Paulo Coelho",
            "De Koran van de Nacht - Yasmina Khadra"
        ];

        
        $zoekresultaten = $boeken;
        if(isset($_GET['zoek']) && !empty($_GET['zoek'])) {
            $term = strtolower($_GET['zoek']);
            $zoekresultaten = array_filter($boeken, function($boek) use ($term) {
                return strpos(strtolower($boek), $term) !== false;
            });
        }
        ?>

        <div class="boeken">
            <h2>Boeken</h2>

            <?php if(count($zoekresultaten) > 0): ?>
                <?php foreach($zoekresultaten as $boek): ?>
                    <div class="boek"><?php echo $boek; ?></div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="boek">Geen boeken gevonden.</div>
            <?php endif; ?>
        </div>

    </div>

</section>

<?php include 'footer.php'; ?>