<?php

// Az API tesztfelhasználókat ad vissza; az oldal ezek adataiból állít össze egy kitalált járatot.
$url = "https://jsonplaceholder.typicode.com/users";

// Létrehozza a cURL-kezelőt a megadott címhez.
$ch = curl_init($url);
    // A választ szövegként adja vissza, közvetlen kiírás helyett.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Kikapcsolja a TLS-tanúsítvány ellenőrzését, ami gyengíti a HTTPS-kapcsolat biztonságát.
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Elküldi a kérést, és eltárolja a választ; cURL-hibánál az eredmény false.
$response = curl_exec($ch);

// print_r($response);

// Ellenőrzi a cURL-hibát, és hiba esetén üzenettel leállítja a programot.
if (curl_errno($ch)) {
    die("cURL hiba: " . curl_error($ch));
}

// Lezárja a cURL-kezelőt.
curl_close($ch);

// A JSON-választ asszociatív PHP-tömbbé alakítja.
$data = json_decode($response, true);
// echo "<pre>";
// print_r($data);

// Leállítja a programot, ha a feldolgozott adat üres vagy logikailag hamis érték.
if(!$data) {
    die("Nem sikerült adatot lekérni!");
}

// Véletlenszerű kulcs alapján kiválaszt egy felhasználót a tömbből.
$randomFlight = $data[array_rand($data)];
// Kitalált járatszámot készít FL- előtaggal és egy 100–999 közötti egész számmal.
$flightNumber = "FL-".rand(100, 999);

?>


<!DOCTYPE html>
<html>
<head>
<!-- UTF-8 karakterkódolás az ékezetes szövegek megjelenítéséhez. -->
<meta charset="UTF-8">
<title>Random járat</title>
<style>
/* Az oldal betűtípusa, sötét háttere, fehér szövege és középre igazítása. */
body { font-family: Arial; background:#1c1c1c; color:white; text-align:center; }
/* A kártya háttere, belső térköze, szélessége, középre helyezése és lekerekítése. */
.card { background:#333; padding:20px; margin:50px auto; width:400px; border-radius:10px; }
/* Belső térközt ad a gomb felirata köré. */
button { padding:10px 20px; }
</style>
</head>
<body>

<!-- A kitalált járat adatait megjelenítő kártya. -->
<div class="card">
    <h1>:airplane: Véletlen járat</h1>
    <!-- Kiírja az előállított járatszámot; a rövid PHP echo jelölés: <?= ... ?>. -->
    <p><strong>Járatszám:</strong> <?= $flightNumber ?></p>
    <!-- A felhasználó cégnevét, városát és e-mail-címét használja. A htmlspecialchars átalakítja a HTML speciális karaktereit. -->
    <p><strong>Légitársaság:</strong> <?= htmlspecialchars($randomFlight['company']['name']) ?></p>
    <p><strong>Indulási város:</strong> <?= htmlspecialchars($randomFlight['address']['city']) ?></p>
    <p><strong>Kapcsolat:</strong> <?= htmlspecialchars($randomFlight['email']) ?></p>

    <br>
    <!-- A gomb GET-kéréssel újratölti az oldalt, így új véletlen kiválasztás történik. -->
    <form method="get">
        <button type="submit">Új járat</button>
    </form>
</div>

</body>
</html>