<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<h1>Catalogus</h1>

<form method="GET" action="">
    <input type="text" name="zoek" placeholder="Zoek op titel of auteur">
    <button type="submit">Zoek</button>
</form>

<?php
$zoekterm = "";
if(isset($_GET['zoek']) && !empty($_GET['zoek'])){
    $zoekterm = $_GET['zoek'];
    $stmt = $conn->prepare("SELECT * FROM boeken WHERE Titel LIKE ? OR Auteur LIKE ?");
    $stmt->execute(["%$zoekterm%", "%$zoekterm%"]);
    $boeken = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $populaireBoeken = $boeken;
    $nieuweBoeken = [];
} else {
    $stmt = $conn->query("SELECT * FROM boeken");
    $boeken = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $populaireBoeken = array_slice($boeken, 0, ceil(count($boeken)/2));
    $nieuweBoeken = array_slice($boeken, ceil(count($boeken)/2));
}
?>

<div class="catalogus">

    <div class="boeken-kolom">
        <h3>Populaire boeken</h3>

        <?php if(count($populaireBoeken) > 0): ?>
            <?php foreach($populaireBoeken as $boek): ?>
                <?php 
                    $titel = isset($boek['Titel']) ? htmlspecialchars($boek['Titel']) : 'Onbekend';
                    $auteur = isset($boek['Auteur']) ? htmlspecialchars($boek['Auteur']) : 'Onbekend';
                    $genre = isset($boek['Genre']) ? htmlspecialchars($boek['Genre']) : '';
                    $jaar = isset($boek['Publicatiejaar']) ? htmlspecialchars($boek['Publicatiejaar']) : '';
                ?>
                <div class="boek">
                    <?php echo $titel; ?> - <em><?php echo $auteur; ?></em>
                    <?php if($genre != '') echo "($genre)"; ?>
                    <?php if($jaar != '') echo " - $jaar"; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="boek">Geen boeken gevonden.</div>
        <?php endif; ?>
    </div>

    <div class="boeken-kolom">
        <h3>Nieuwe boeken</h3>

        <?php if(count($nieuweBoeken) > 0): ?>
            <?php foreach($nieuweBoeken as $boek): ?>
                <?php 
                    $titel = isset($boek['Titel']) ? htmlspecialchars($boek['Titel']) : 'Onbekend';
                    $auteur = isset($boek['Auteur']) ? htmlspecialchars($boek['Auteur']) : 'Onbekend';
                    $genre = isset($boek['Genre']) ? htmlspecialchars($boek['Genre']) : '';
                    $jaar = isset($boek['Publicatiejaar']) ? htmlspecialchars($boek['Publicatiejaar']) : '';
                ?>
                <div class="boek">
                    <?php echo $titel; ?> - <em><?php echo $auteur; ?></em>
                    <?php if($genre != '') echo "($genre)"; ?>
                    <?php if($jaar != '') echo " - $jaar"; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="boek">Geen boeken gevonden.</div>
        <?php endif; ?>
    </div>

</div>

<?php include 'footer.php'; ?>