<?php

$dev_mod = 0; // fejlesztő

// adatbázis kapcsolat
$conn = new mysqli("localhost", "root", "", "media_gyakorlo");
// A kapcsolat karakterkódolását utf8mb4-re állítja az ékezetek és más Unicode-karakterek kezeléséhez.
$conn->set_charset("utf8mb4");

// Kapcsolódási hiba esetén hibaüzenettel leállítja a programot.
if($conn->connect_error){
    die("Adatbázis kapcsolat hiba !");
}

// Fejlesztői módban visszajelzést ír ki a sikeres kapcsolódásról.
if($dev_mod == 1) echo "Sikeres adatbázis kapcsolat!<br>";



// Letölti a dalokat az API-ból, majd a kapott találatokkal újratölti a dalok táblát.
function frissitAdatbazis($dev_mod, $conn){
    // API
    $url = "https://itunes.apple.com/search?term=pop&limit=20&entity=song";
    // Letölti az API-válasz szövegét a megadott címről.
    $json = file_get_contents($url);

    //if($dev_mod == 1) print_r($json);

    // A JSON-választ PHP-tömbbé alakítja; a true paraméter asszociatív tömböket kér.
    $data = json_decode($json, true);
    
    // Fejlesztői módban előformázott HTML-blokkot nyit a tömb áttekinthető megjelenítéséhez.
    if($dev_mod == 1) echo "<pre>";
    // Fejlesztői módban megjeleníti a feldolgozott API-választ.
    if($dev_mod == 1) print_r($data);

    // Csak akkor dolgozza fel a találatokat, ha létezik a results mező.
    if(isset($data['results'])){
        $conn->query("TRUNCATE TABLE dalok"); // törli a tábla tartalmát
        // Egyenként feldolgozza az API által visszaadott dalokat.
        foreach($data['results'] as $dal){
            // Kinyeri és SQL-szöveghez escape-eli a dal adatait. Paraméterezett beszúrásnál ez az escape-elés felesleges, és módosíthatja a tárolt szöveget.
            $cim = $conn->real_escape_string($dal['trackName']);
            $eloado = $conn->real_escape_string($dal['artistName']);
            $mufaj = $conn->real_escape_string($dal['primaryGenreName']);
            $borito = $conn->real_escape_string($dal['artworkUrl100']);
            $minta = $conn->real_escape_string($dal['previewUrl']);

            // Paraméterezett beszúrás: az öt kérdőjel helyére kerülnek a dal adatai.
            $sql = "INSERT INTO dalok (cim, eloado, mufaj, boritokep, minta_url) VALUES (?,?,?,?,?)";
            // Előkészíti az SQL-utasítást a végrehajtáshoz.
            $stmt = $conn->prepare($sql);
            // Az öt változót szöveges paraméterként köti az utasításhoz; minden s egy szöveges értéket jelöl.
            $stmt->bind_param("sssss", $cim, $eloado, $mufaj, $borito, $minta);
            // Beszúrja az aktuális dal adatait az adatbázisba.
            $stmt->execute();
        }

    // Hiányzó results mező esetén ez az üres ág nem végez műveletet.
    }else{

    }
}

// Minden oldalbetöltéskor elindítja az adatbázis frissítését.
frissitAdatbazis($dev_mod, $conn);

// Kiolvassa a search URL-paramétert; hiányzó paraméter esetén ez a közvetlen hozzáférés figyelmeztetést okozhat.
$kereses = $_GET["search"];
// Alapértelmezésként az összes dalt lekérő SQL-utasítás.
$sql = "SELECT * FROM dalok";
// Nem üres keresőkifejezés esetén további szűrést fűz a lekérdezéshez.
if($kereses){
    // A címben vagy az előadó nevében keres részszöveget. A közvetlen behelyettesítés SQL-injekcióra ad lehetőséget.
    $sql .= " WHERE cim LIKE '%$kereses%' OR eloado LIKE '%$kereses%'";
}
// Végrehajtja a lekérdezést; a találatokat a HTML-rész jeleníti meg.
$eredmenyek = $conn->query($sql);

?>

<!-- HTML5-dokumentum; az oldal nyelve magyar, a karakterkódolása UTF-8. -->
<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
            <title>Média API Gyakorló</title>
                <style>
                    /* Az oldal alapvető betűtípusa, háttere, térközei és szövegmegjelenése. */
                    body { font-family: sans-serif; background: #F0F2F5; padding: 20px; }
                    /* A keresőmezőt tartalmazó doboz háttere és térközei. */
                    .search-box { margin-bottom: 20px; background: white; padding: 15px; border-radius: 8px; }
                    /* Rugalmas rács: a rendelkezésre álló szélességhez igazodó, legalább 200 pixeles oszlopokkal. */
                    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
                    /* A kártyák mérete, háttere, lekerekítése és árnyéka. */
                    .card { background: white; padding: 10px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
                    /* A kártyán megjelenő kép méretezése és megjelenése. */
                    .card img { border-radius: 5px; width: 100px; }
                    /* A hanglejátszó kitölti a kártya szélességét, és felső térközt kap. */
                    audio { width: 100%; margin-top: 10px; }
                </style>
    </head>
    
    <body>

        <!-- Az oldal főcíme. -->
        <h1>Saját Média Gyűjtemény</h1>

        <!-- Keresőűrlap: GET-kéréssel a search paraméterben küldi el a keresőkifejezést. -->
        <div class="search-box">
            <form method="GET">
                <!-- A korábbi keresést visszaírja a mezőbe; a htmlspecialchars a HTML speciális karaktereit átalakítja. -->
                <input type="text" name="search" placeholder="Keresés dalra vagy előadóra..." value="<?= htmlspecialchars($kereses) ?>">
                    <button type="submit">Keresés</button>
                <!-- Az index.php oldalra navigál keresési paraméter nélkül. -->
                <a href="index.php">Összes mutatása</a>
            </form>
        </div>

        <!-- A lekérdezett dalok kártyáinak tárolója. -->
        <div class="grid">
            <!-- Sorban asszociatív tömbként beolvassa a találatokat, és mindegyikhez kártyát készít. -->
            <?php while($sor = $eredmenyek->fetch_assoc()): ?>
                <div class="card">
                    <!-- Megjeleníti a dal borítóját, címét, előadóját és műfaját az adatbázis adataiból. -->
                    <img src="<?= $sor['boritokep'] ?>" alt="Borító">
                    <h4><?= $sor['cim'] ?></h4>
                    <p><i><?= $sor['eloado'] ?></i></p>
                    <small><?= $sor['mufaj'] ?></small>
                    <!-- Beépített vezérlőkkel ellátott lejátszó az MPEG-hangmintához. -->
                    <audio controls>
                    <source src="<?= $sor['minta_url'] ?>" type="audio/mpeg">
                    </audio>
                </div>
            <?php endwhile; ?>
        </div>
    </body>
</html>