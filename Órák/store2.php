<?php

// adatbázis kapcsolat létrehozása
$server = "localhost";
$username = "root";
$password = "";
$db = "raktar";

$conn = new mysqli($server, $username, $password, $db);

// Kapcsolódási hiba esetén üzenettel leállítja a programot.
if($conn->connect_error){
    die("Adatbázis kapcsolat hiba !");
}

// Visszajelzi a sikeres adatbázis-kapcsolatot.
echo "Sikeres adatbázis kapcsolat !<br>";

// DB lekérdezés
$sql = "SELECT * FROM store1 WHERE db > 5";
// Végrehajtja a lekérdezést, amely az ötnél nagyobb darabszámú tételeket választja ki.
$result = $conn->query($sql);
// A lekérdezés eredményobjektumát írja ki, nem magukat az adatsorokat.
print_r($result);
echo "<br>";

$tomb = []; // Gyűjtő tömb
// DB kiírása
if($result->num_rows > 0){
    // A következő találatot asszociatív tömbként olvassa be; a sorok végén a ciklus leáll.
    while($row = $result->fetch_assoc()){
        // adatok mentése
        $tomb_row = [];
        array_push($tomb_row, $row["ID"], $row["megnevezes"], $row["model"], $row["db"],
                    $row["leltar_id"], $row["foglalt"], $row["ar"]);
        // Összefűzi és kiírja a találat mezőit, majd HTML-sortörést ad hozzá.
        echo $row["ID"]." : ".$row["megnevezes"]." - ".$row["model"]." - ".$row["db"]." - ".
        $row["leltar_id"]." - ".$row["foglalt"]." - ".$row["ar"]. "<br>";
        // altömb mentése a gyűjtő tömbbe
        array_push($tomb, $tomb_row);
    }
    // Előformázott HTML-blokkot nyit a tömb áttekinthető kiírásához.
    echo "<pre>";
    // Kiírja a gyűjtőtömbbe mentett összes sort.
    print_r($tomb);
}else{
    // Jelzi, ha nem érkezett találat.
    echo "Nincs találat !";
}

// új raktár (Strore2) tábla készítése

$sql = "CREATE TABLE IF NOT EXISTS store2 (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            megnevezes VARCHAR(50),
            model VARCHAR(50),
            db INT(3),
            leltar_id VARCHAR(10),
            foglalt INT(3),
            ar INT)";

// Végrehajtja a táblalétrehozó utasítást, és siker vagy hiba szerint ad visszajelzést.
if($conn->query($sql) === TRUE){
    echo "<br>Sikeres tábla létrehozás!<br>";
}else{
    echo "<br>Hiba a tábla létrehozásánál: $conn->error <br>";
}

// DB store2 tábla feltöltése a mentett $tomb adatokkal
$sql_ok = 1;
// A mentett sorokat egyenként beszúrja; ismételt futtatás újra hozzáadja őket a meglévő táblához.
foreach($tomb as $t){
    // Hat mezőhöz hat paraméterhelyet ad meg; az ID-t a céladatbázis automatikusan generálja.
    $sql = "INSERT INTO store2 (megnevezes, model, db, leltar_id, foglalt, ar)
            VALUES (?,?,?,?,?,?)";
    // Előkészíti a paraméterezett beszúró utasítást.
    $stmt = $conn->prepare($sql);
    // A mentett sor 1–6 indexű elemeit szöveges paraméterként köti a kérdőjelekhez.
    $stmt->bind_param("ssssss", $t[1],$t[2],$t[3],$t[4],$t[5],$t[6]);
    // Beszúrja az aktuális sort, és ellenőrzi a végrehajtás sikerét.
    if($stmt->execute()){
        echo "<br>Sikeres adat rögzítés!<br>";
    }else{
        // Megjegyzi, hogy legalább egy beszúrás sikertelen volt.
        $sql_ok = 0;
        echo "Hiba az adatok feltöltésénél: $stmt->error";
    }
}

// Összesített visszajelzést ad; üres gyűjtőtömbnél is sikeresnek jelzi a műveletet.
if($sql_ok == 1){
    echo "<br>Sikeres adat rögzítés!<br>";
}else{
    echo "Hiba az adatok feltöltésénél!";
}

?>