<?php
// Az engedélyezett felhasználónevek tömbje.
$felhasznalonev = ["admin", "titkar", "istvan"];
// Az azonos indexű felhasználók jelszavai; a példa egyszerű szövegként tárolja őket.
$jelszo = ["123456", "T1234", "87654321"];
// A párhuzamos név- és jelszótömb összekapcsolásához használt index.
$index = 0;
// A sikeres ellenőrzés jelzője: kezdetben 0, egyezéskor 1.
$valid = 0;
// Az eredményt vagy hibákat tartalmazó, kezdetben üres üzenet.
$error = "";
// A feldolgozott felhasználónév kezdeti értéke.
$username = "";

// Ellenőrzi, hogy mindkét POST-mező létezik és nem üres; az empty a 0 szöveget is üresnek tekinti.
function user_check(){
    if(isset($_POST["username"]) && !empty($_POST["username"]) &&
        isset($_POST["password"]) && !empty($_POST["password"])){
        return true;
    }else{
        return false;
    }
} // return   v. true  v. false

// Feldolgozza a két bemenetet, majd név–jelszó sorrendben visszaadja őket egy tömbben.
function user_cleaner($u, $p){
    $user = trim($u); // space törlése
    // A jelszó eleji és végi üres karaktereket eltávolítja.
    $pass = trim($p);
    // Átalakítja a felhasználónév HTML speciális karaktereit.
    $user = htmlspecialchars($user);
    // A jelszó karaktereit is HTML-formára alakítja, ami megváltoztathatja az összehasonlított értéket.
    $pass = htmlspecialchars($pass);
    // Létrehozza a visszaadandó tömböt.
    $info = [];
    // Első elemként hozzáadja a feldolgozott felhasználónevet.
    array_push($info, $user);
    // Második elemként hozzáadja a feldolgozott jelszót.
    array_push($info, $pass);
    // Visszaadja a két feldolgozott értéket.
    return $info;
}

// Form küldésének ellenőrzése
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Csak kitöltöttnek minősített mezőket ad át a feldolgozó függvénynek.
    if(user_check() == 1){
        // print_r(user_cleaner($username, $pass));
        // felhasználói adatok tisztítása
        $user_tomb = user_cleaner($_POST["username"], $_POST["password"]);
        // visszatérő tömb értékeinek kivétele !!!
        $username = $user_tomb[0];
        $pass = $user_tomb[1];
    }else{
        // Eltárolja a hiányzó beviteli adatokra vonatkozó hibaüzenetet.
        $error = "Nem töltötted ki a felhasználónév vagy a jelszó mezőt!";
    }



    // Végignézi a felhasználóneveket, és az indexük alapján ellenőrzi a hozzájuk tartozó jelszót.
    foreach($felhasznalonev as $f){
        if($username == $f && $pass == $jelszo[$index]){ // &&  ||
            // Sikerüzenetet fűz hozzá egy kezdő szóközzel; ez eltér az alább vizsgált, szóköz nélküli szövegtől.
            $error .= " Sikeres belépés!";
        //header("location: divat.php");
            // A sikeres ellenőrzés jelzője: kezdetben 0, egyezéskor 1.
            $valid = 1;
        }
        // A következő jelszó indexére lép.
        $index++;
    }

    if($valid == 0){ // $valid != 1
        // Sikertelen ellenőrzéskor hozzáfűzi a hibaüzenetet; hiányzó mezőknél is idáig jut.
        $error .= " Hibás felhasználónév vagy jelszó!";
    }
}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Belépés</title>
</head>
<body>

    <h2>Bejelentkezés</h2>

    <!-- POST-kéréssel a login1.php fájlnak küldi az űrlapot. -->
    <form action="login1.php" method="post">
        <label style="font-size: 20px;">Felhasználónév:</label><br>
        <!-- Kötelező felhasználónévmező. -->
        <input type="text" name="username" required><br><br>

        <label style="font-size: 20px;">Jelszó:</label><br>
        <!-- Kötelező, maszkolt jelszómező. -->
        <input type="password" name="password" required><br><br>

        <!-- Kék hátterű, fehér feliratú beküldőgomb. -->
        <input style="background: blue; color: white;" type="submit" value="Belépés">

        <!-- A sikerüzenetet pontos szövegegyezéssel vizsgálja; a korábban hozzáfűzött kezdő szóköz miatt siker esetén is a piros ág fut le. -->
        <?php if($error == "Sikeres belépés!"){ ?>
            <!-- Zöld színnel jeleníti meg az üzenetet, ha a feltétel teljesül. -->
            <h4 style="color: green;"><?php echo $error; ?></h4>
        <?php }else{ ?>
            <!-- Egyéb esetben piros színnel írja ki az üzenetet. -->
            <h4 style="color: red;"><?php echo $error; ?></h4>
        <?php } ?>

    </form>

</body>
</html>