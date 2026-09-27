<?php

// Létrehozza az angol ábécé kisbetűit tartalmazó tömböt.
$letters = range('a', 'z');
// Véletlenszerű tömbkulcs alapján kiválaszt egy kezdőbetűt.
$randomLetter = $letters[array_rand($letters)];
// Olyan recepteket kér az API-tól, amelyek neve a kiválasztott betűvel kezdődik.
$url = "https://www.themealdb.com/api/json/v1/1/search.php?f=" . $randomLetter;

// Létrehozza a megadott URL-re irányuló cURL-kérést.
$ch = curl_init($url);
    // A választ szövegként adja vissza, közvetlen kiírás helyett.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Kikapcsolja a szerver TLS-tanúsítványának ellenőrzését; ez gyengíti a HTTPS-kapcsolat biztonságát.
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Megadja a kliens azonosítására szolgáló User-Agent fejlécet.
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozzila/5.0");
// Végrehajtja a HTTP-kérést, és eltárolja a választ; cURL-hiba esetén az érték false.
$response = curl_exec($ch);

// Ellenőrzi, hogy történt-e cURL-hiba a kérés közben.
if (curl_errno($ch)) {
    // Kiírja a cURL hibaüzenetét, és leállítja a szkriptet.
    die("cURL hiba: " . curl_error($ch));
}

// A JSON-választ PHP-tömbbé alakítja; a true paraméter asszociatív tömböket kér.
$data = json_decode($response, true);

// Legfeljebb az első hat receptet veszi át. Ehhez a meals mezőnek tömbnek kell lennie; null esetén hibát okoz.
$meals = array_slice($data['meals'], 0, 6);

//echo "<pre>";
//print_r($meals);

?>

<!-- HTML5-dokumentum; az oldal nyelve magyar, a karakterkódolása UTF-8. -->
<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<title>Ingyenes Receptek</title>
<style>
/* Az oldal alapvető betűtípusa, háttere, térközei és szövegmegjelenése. */
body {
font-family: Arial, sans-serif;
background: linear-gradient(to right, #FF9966, #FF5E62);
margin: 0;
padding: 0;
text-align: center;
color: white;
}

/* Függőleges térközt ad az oldal főcímének. */
h1 {
padding: 30px 0;
}

/* Több sorba törő, középre rendezett flex elrendezés a receptkártyákhoz. */
.container {
display: flex;
flex-wrap: wrap;
justify-content: center;
}

/* A kártyák mérete, háttere, lekerekítése és árnyéka. */
.card {
background: white;
color: black;
width: 280px;
margin: 15px;
border-radius: 15px;
overflow: hidden;
box-shadow: 0 10px 20px rgba(0,0,0,0.3);
transition: transform 0.3s ease;
}

/* Az egérmutató alatti kártyát enyhén felnagyítja. */
.card:hover {
transform: scale(1.05);
}

/* A kártyán megjelenő kép méretezése és megjelenése. */
.card img {
width: 100%;
height: 200px;
object-fit: cover;
}

/* Belső térközt ad a kártya szöveges tartalmának. */
.card-content {
padding: 15px;
}

/* A gomb mérete, színei, lekerekítése és egérmutatója. */
button {
margin: 30px;
padding: 12px 25px;
font-size: 16px;
border: none;
border-radius: 8px;
background: #222;
color: white;
cursor: pointer;
}

/* Az egérmutató alatti gomb háttérszínét módosítja. */
button:hover {
background: #444;
}
</style>
</head>
<body>

<!-- Az oldal főcíme. -->
<h1>Véletlenszerű Receptek</h1>

<!-- A receptkártyák közös tárolója. -->
<div class="container">
<!-- Végiglépked a kiválasztott recepteken; minden recepthez egy kártyát jelenít meg. -->
<?php foreach ($meals as $meal): ?>
    <div class="card">
    <!-- A recept képét jeleníti meg; a kép URL-jét HTML-attribútumba illeszthető formára alakítja. -->
    <img src="<?= htmlspecialchars($meal['strMealThumb']) ?>" alt="">
    <!-- A recept nevét, kategóriáját és konyháját jeleníti meg, HTML-karakterek átalakításával. -->
    <div class="card-content">
            <h3><?= htmlspecialchars($meal['strMeal']) ?></h3>
            <p><strong>Kategória:</strong> <?= htmlspecialchars($meal['strCategory']) ?></p>
            <p><strong>Konyha:</strong> <?= htmlspecialchars($meal['strArea']) ?></p>
        </div>
    </div>
<?php endforeach; ?>
</div>

<!-- A gomb újratölti az oldalt, így a szerver ismét véletlen kezdőbetűt választ. -->
<form method="get">
    <button type="submit">Új receptek</button>
</form>

</body>
</html>