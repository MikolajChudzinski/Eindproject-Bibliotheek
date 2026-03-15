<?php include 'header.php'; ?>
<?php include 'db.php';  ?>

<h1>Boek toevoegen</h1>

<?php

if(isset($_POST['submit'])){
    $titel = $_POST['titel'];
    $auteur = $_POST['auteur'];
    $genre = $_POST['genre'];
    $jaar = $_POST['jaar'];

    
    if(!empty($titel) && !empty($auteur)){
        $stmt = $conn->prepare("INSERT INTO boeken (titel, auteur, genre, publicatiejaar) VALUES (?, ?, ?, ?)");
        $stmt->execute([$titel, $auteur, $genre, $jaar]);
        echo "<p style='color:green;'>Boek toegevoegd!</p>";
    } else {
        echo "<p style='color:red;'>Titel en auteur zijn verplicht!</p>";
    }
}
?>


<form method="POST" action="">
    <label>Titel:</label><br>
    <input type="text" name="titel" required><br><br>

    <label>Auteur:</label><br>
    <input type="text" name="auteur" required><br><br>

    <label>Genre:</label><br>
    <input type="text" name="genre"><br><br>

    <label>Publicatiejaar:</label><br>
    <input type="number" name="jaar" min="1000" max="2099"><br><br>

    <button type="submit" name="submit">Toevoegen</button>
</form>

<?php include 'footer.php'; ?>