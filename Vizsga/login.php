<?php
// Az adatbázis-kiszolgáló címe.
$host = "localhost";
// Az adatbázis-kapcsolat felhasználóneve.
$user = "root";
// Az adatbázis-felhasználó jelszava; itt üres.
$password = "";
// A használni kívánt adatbázis neve.
$database = "php_vizsga";

// MySQL-kapcsolatot hoz létre a megadott adatokkal.
$conn = new mysqli($host, $user, $password, $database);

// Kapcsolódási hiba esetén kiírja a hiba részleteit, és leállítja a programot.
if ($conn->connect_error) {
    die("Adatbázis-kapcsolati hiba: " . $conn->connect_error);
}

// Kezdetben nincs megjelenítendő visszajelzés.
$message = "";
// A visszajelzés kezdeti CSS-osztálya; hiba esetén error lesz.
$messageClass = "success";

// Csak az űrlap POST-kérésekor ellenőrzi a belépési adatokat.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Kiolvassa a felhasználónevet, hiány esetén üres szöveget használ, és levágja a szélső üres karaktereket.
    $username = trim($_POST["username"] ?? "");
    // Kiolvassa a jelszót, és a szélső üres karaktereket ebből is eltávolítja.
    $pass = trim($_POST["pass"] ?? "");

    // Paraméterezett lekérdezést készít a név és jelszó összevetésére. A jelszót közvetlenül hasonlítja össze, nem jelszóhash-t ellenőriz.
    $stmt = $conn->prepare("SELECT ID FROM users WHERE username = ? AND pass = ?");
    // A két kérdőjelhez két szöveges paramétert köt; az ss a típusokat jelöli.
    $stmt->bind_param("ss", $username, $pass);
    // Végrehajtja az előkészített lekérdezést.
    $stmt->execute();
    // Lekéri a lekérdezés eredményhalmazát.
    $result = $stmt->get_result();

    // Pontosan egy találatot tekint sikeres azonosításnak.
    $success = ($result->num_rows === 1);

    // Beállítja a sikerhez vagy hibához tartozó üzenetet és naplózási állapotot; bejelentkezési munkamenetet nem hoz létre.
    if ($success) {
        $message = "Sikeres bejelentkezés!";
        $status = "SIKERES";
    } else {
        $message = "Hibás felhasználónév vagy jelszó!";
        $messageClass = "error";
        $status = "SIKERTELEN";
    }

    // Dátumból, állapotból és felhasználónévből naplósort állít össze, rendszerfüggő sortöréssel.
    $log = date("Y-m-d H:i:s")
         . " | " . $status
         . " | felhasználó: " . $username
         . PHP_EOL;

    // Hozzáfűzi a naplósort a login.log fájlhoz; szükség esetén létrehozza a fájlt.
    file_put_contents("login.log", $log, FILE_APPEND);

    // Lezárja az előkészített SQL-utasítást.
    $stmt->close();
}

// Lezárja az adatbázis-kapcsolatot.
$conn->close();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
    <style>
        /* Világos színsémát, alapbetűtípust, szövegszínt és hátteret állít be. */
        :root {
            color-scheme: light;
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            color: #17324d;
            background: #dce9f5;
        }

        /* A megadott méretekbe a szegély és a belső térköz is beleszámít. */
        * {
            box-sizing: border-box;
        }

        /* Képernyőmagasságú, középre rendezett oldalt és rétegzett színátmenetes hátteret hoz létre. */
        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
            background:
                radial-gradient(circle at 15% 20%, rgba(255, 255, 255, 0.8), transparent 32%),
                radial-gradient(circle at 85% 80%, rgba(255, 214, 165, 0.65), transparent 30%),
                linear-gradient(135deg, #8ec5fc 0%, #e0c3fc 100%);
        }

        /* A belépőpanel megjelenése; a mobilos szabály csak a belső térközt csökkenti. */
        .login-panel {
            width: min(100%, 420px);
            padding: 42px 38px;
            text-align: center;
            background: rgba(255, 255, 255, 0.84);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 18px;
            box-shadow: 0 20px 55px rgba(48, 71, 94, 0.22);
            backdrop-filter: blur(10px);
        }

        /* A főcím méretét és térközeit adja meg. */
        h1 {
            margin: 0 0 28px;
            font-size: 2rem;
            letter-spacing: 0;
        }

        /* Rácsos elrendezésben, térközökkel rendezi az űrlap tartalmát. */
        form {
            display: grid;
            gap: 18px;
            text-align: left;
        }

        /* A mezőfeliratot és a hozzá tartozó mezőt egymás alá rendezi. */
        label {
            display: grid;
            gap: 8px;
            font-weight: 700;
        }

        /* Teljes szélességű, lekerekített mezők, finom szegély- és árnyékátmenettel. */
        input {
            width: 100%;
            padding: 13px 14px;
            color: #17324d;
            font: inherit;
            background: #f8fbff;
            border: 1px solid #b9cde0;
            border-radius: 9px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        /* Kiemeli az éppen aktív beviteli mezőt. */
        input:focus {
            border-color: #4b83c4;
            box-shadow: 0 0 0 3px rgba(75, 131, 196, 0.2);
        }

        /* A beküldőgomb színeit, méretét, lekerekítését és átmeneteit állítja be. */
        button {
            margin-top: 4px;
            padding: 13px 18px;
            color: #fff;
            font: inherit;
            font-weight: 700;
            background: #286090;
            border: 0;
            border-radius: 9px;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        /* Egérrel fölé mutatva sötétíti és kissé megemeli a gombot. */
        button:hover {
            background: #1d496f;
            transform: translateY(-1px);
        }

        /* Az alap visszajelzés zöld színű dobozának stílusa. */
        .message {
            margin: -10px 0 24px;
            padding: 11px 14px;
            color: #245b3b;
            background: #e4f5e9;
            border: 1px solid #b8dfc3;
            border-radius: 9px;
        }

        /* Hibánál piros árnyalatokra cseréli a visszajelzés színeit. */
        .message.error {
            color: #8a2635;
            background: #fde4e7;
            border-color: #f2b8c0;
        }

        /* Legfeljebb 480 pixeles nézetszélességnél módosítja a panel térközét. */
        @media (max-width: 480px) {
            /* A belépőpanel megjelenése; a mobilos szabály csak a belső térközt csökkenti. */
            .login-panel {
                padding: 32px 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Az oldal belépőpanelt tartalmazó fő része. -->
    <main class="login-panel">
        <h1>Bejelentkezés</h1>

        <!-- Csak nem üres üzenet esetén jelenít meg visszajelzést. -->
        <?php if ($message !== ""): ?>
            <!-- Beilleszti az állapot CSS-osztályát, és HTML-karakterátalakítással írja ki az üzenetet. -->
            <p class="message <?php echo $messageClass; ?>"><?php echo htmlspecialchars($message, ENT_QUOTES, "UTF-8"); ?></p>
        <?php endif; ?>

        <!-- A belépési adatokat POST-kéréssel az aktuális oldalra küldi. -->
        <form method="post" action="">
            <label>
                Felhasználónév:
                <!-- Kötelező felhasználónévmező, amelyet a PHP username néven olvas ki. -->
                <input type="text" name="username" required>
            </label>

            <label>
                Jelszó:
                <!-- Maszkolt, kötelező jelszómező, amelyet a PHP pass néven olvas ki. -->
                <input type="password" name="pass" required>
            </label>

            <!-- Elküldi az űrlapot. -->
            <button type="submit">Belépés</button>
        </form>
    </main>
</body>
</html>