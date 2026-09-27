<?php

// A feltöltési célmappa relatív útvonala; a mappának léteznie kell.
$uploadDir = 'uploads/';
$quota = 10 * 1024 * 1024; // 10 MB

// Összeadja a mappa közvetlen bejegyzéseinek méretét; az almappákat nem járja be rekurzívan.
function getUsedSpace($dir) {
    // A bájtokban mért összméret kezdeti értéke.
    $total = 0;

    // Listázza a mappát, és kihagyja a . és .. könyvtárhivatkozásokat.
    foreach (array_diff(scandir($dir), ['.', '..']) as $file){
        // Az aktuális bejegyzés méretét hozzáadja az összeghez.
        $total += filesize($dir . $file);
    }
    // Visszaadja az összesített méretet bájtban.
    return $total;
}

// Kezdetben nincs megjelenítendő állapotüzenet.
$message = '';

// Csak POST-kérés és a file feltöltési mező megléte esetén dolgozza fel a feltöltést.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    // Átveszi a feltöltés adatait: név, ideiglenes útvonal, méret és hibakód.
    $file = $_FILES['file'];
    // Levágja az egyedi fájlnév eleji és végi üres karaktereket; a filename mezőt közvetlenül olvassa.
    $customName = trim($_POST['filename']);

    // A nulla hibakód sikeres PHP-feltöltést jelez.
    if($file['error'] === 0 ){
        // Lekéri a célmappa jelenlegi összméretét.
        $used = getUsedSpace($uploadDir);
        // A feltöltött fájl mérete bájtban.
        $newFileSize = $file['size'];
        
        // Ellenőrzi, hogy az új fájllal együtt túllépné-e a tárhelykeretet.
        if ($used + $newFileSize > $quota) {
            // Eltárolja a tárhelyhiány üzenetét.
            $message = 'Nincs elég hely.';
        }else {
            // kiterjesztés kinyerése
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

            // Ha megadtak egyedi nevet, azt használja alapnévként.
            if (!empty($customName)) {
                // Átveszi az egyedi nevet; ez a kód nem szűri ki belőle az útvonalrészeket.
                $fileName = $customName;
                // Ha van eredeti kiterjesztés, ponttal hozzáfűzi az egyedi névhez.
                if($ext){
                    $fileName .= '.' . $ext;
                }
            }else {
                // Egyedi név nélkül az eredeti név utolsó útvonalelemét használja.
                $fileName = basename($file['name']);
            }

            // Összefűzi a célmappát és a fájlnevet.
            $targetPath = $uploadDir.$fileName;

            // Az ideiglenes feltöltést a célhelyre mozgatja; azonos nevű meglévő fájlt felülírhat.
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // Eltárolja a sikeres mentés üzenetét.
                $message = 'Fájl sikeresen feltöltve.';
            } else {
                // Eltárolja a sikertelen mozgatás üzenetét.
                $message = 'Hiba történt a feltöltés során.';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
        <title>Fájl feltöltő</title>
            <style>
                /* Az oldal alapbetűtípusa, háttérszíne és külső tartalom körüli belső térköze. */
                body {
                font-family: Arial;
                background: #F4F6F9;
                padding: 40px;
                }

                /* Középre rendezett, legfeljebb 900 pixeles, fehér, lekerekített és árnyékos tartalomdoboz. */
                .container {
                max-width: 900px;
                margin: auto;
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                }

                /* Középre igazítja a címsorokat. */
                h1, h2 {
                text-align: center;
                }

                /* Az űrlap elemeit függőlegesen rendezi, köztük térközzel. */
                form {
                display: flex;
                flex-direction: column;
                gap: 10px;
                margin-bottom: 20px;
                }

                /* Belső térközt és lekerekítést ad a mezőknek és gomboknak. */
                input, button {
                padding: 10px;
                border-radius: 5px;
                }

                /* Kék hátterű, fehér feliratú gombot hoz létre kattintást jelző egérmutatóval. */
                button {
                background: #007BFF;
                color: white;
                border: none;
                cursor: pointer;
                }

                /* Az egérmutató alatti gomb hátterét sötétíti. */
                button:hover {
                background: #0056B3;
                }

                /* A tárhelyadatokat világos hátterű dobozba helyezi. */
                .info {
                margin-bottom: 15px;
                padding: 10px;
                background: #eef;
                border-radius: 5px;
                }

                /* Félkövér állapotüzenet alsó térközzel. */
                .message {
                margin-bottom: 10px;
                font-weight: bold;
                }

                /* Teljes szélességű táblázat összevont cellaszegélyekkel. */
                table {
                width: 100%;
                border-collapse: collapse;
                }

                /* Térközt és alsó elválasztó vonalat ad a celláknak. */
                th, td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
                }

                /* Világos hátteret ad a fejléccelláknak. */
                th {
                background: #F1F1F1;
                }

                /* Zöld, félkövér, aláhúzás nélküli letöltési hivatkozás. */
                .download {
                color: #28A745;
                text-decoration: none;
                font-weight: bold;
                }
            </style>
</head>

<body>
        <div class="container">
        <h1>Fájl feltöltés</h1>

        <!-- Csak nem üres állapotüzenet esetén jeleníti meg az üzenetdoboz tartalmát. -->
        <?php if ($message): ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>

        <!-- A méreteket 1024-gyel osztva, két tizedesre kerekítve jeleníti meg. A usedSpace változó ebben a fájlban nincs inicializálva. -->
        <div class="info">
            Felhasznált tárhely:
            <strong><?= round($usedSpace / 1024, 2) ?> KB</strong> /
            <strong><?= round($quota / 1024, 2) ?> KB</strong>
        </div>

            <!-- Fájlfeltöltő űrlap: POST-metódus és a fájladatok továbbításához szükséges multipart kódolás. -->
            <form method="post" enctype="multipart/form-data">
                <!-- Opcionális egyedi alapnév a feltöltött fájlhoz. -->
                <input type="text" name="filename" placeholder="Egyedi fájlnév (opcionális)">
                <!-- Kötelező fájlválasztó; a szerver a file kulcs alatt kapja meg az adatokat. -->
                <input type="file" name="file" required>
                <button type="submit">Feltöltés</button>
            </form>

            <h2>Feltöltött fájlok</h2>

            <!-- A feltöltött fájlok neve, mérete, típusa, módosítási ideje és letöltési hivatkozása. -->
            <table>
                <tr>
                    <th>Név</th>
                    <th>Méret (KB)</th>
                    <th>Típus</th>
                    <th>Dátum</th>
                    <th>Letöltés</th>
                </tr>

                <!-- Bejárná a fájllistát, de a files változó ebben a fájlban nincs inicializálva. -->
                <?php foreach ($files as $file):
                    // Összeállítja az aktuális fájl útvonalát.
                    $filePath = $uploadDir . $file;
                    // A fájlméretet 1024 bájtos egységekre váltja, két tizedesre kerekítve.
                    $size = round(filesize($filePath) / 1024, 2);
                    // A fájl tartalma alapján meghatározza a MIME-típust.
                    $type = mime_content_type($filePath);
                    // Az utolsó módosítás időpontját év-hónap-nap óra:perc formára alakítja.
                    $date = date("Y-m-d H:i", filemtime($filePath));
                ?>
                <tr>
                    <!-- A fájlnevet a HTML speciális karaktereinek átalakításával jeleníti meg. -->
                    <td><?= htmlspecialchars($file) ?></td>
                    <td><?= $size ?></td>
                    <td><?= $type ?></td>
                    <td><?= $date ?></td>
                    <td>
                    <!-- A fájlra mutató hivatkozás; a download attribútum letöltést kér a böngészőtől. -->
                    <a class="download" href="<?= $filePath ?>" download>Letöltés</a>
                    </td>
                </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>