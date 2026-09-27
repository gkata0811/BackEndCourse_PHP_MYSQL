<?php

// A véletlen felhasználókhoz választható nevek listája.
$nevminta =  ["Zoltán", "Kata", "Gábor", "Csenge", "Luca", "Roland"];
// A véletlen felhasználókhoz választható városok listája.
$varosminta = ["Budapest", "Szeged", "Pécs", "Debrecen", "Miskolc", "Győr"];
// A generált nevek gyűjtőtömbje.
$nev = [];
// A generált életkorok gyűjtőtömbje.
$kor = [];
// A generált városok gyűjtőtömbje; azonos indexen ugyanannak a személynek az adatai találhatók.
$varos = [];
// A teljes felhasználói rekordok listája.
$users = [];
// Az aktuális felhasználó rekordjához használt tömb.
$user = [];

// Ötven felhasználót állít elő; a nevek és városok ismétlődhetnek.
for($i = 0; $i < 50; $i++) {
    // név tömb feltöltése
    $flag = rand(0, 5);
    array_push($nev, $nevminta[$flag]);

    // kor tömb feltöltése
    $kor_aktualis = rand(18, 45);
    array_push($kor, $kor_aktualis);

    // város tömb feltöltése
    $flag2 = rand(0, 5);
    array_push($varos, $varosminta[$flag2]);

    // assoc tömb készítése
    $user["nev"] = $nevminta[$flag];
    $user["kor"] = $kor_aktualis;
    $user["varos"] = $varosminta[$flag2];

    // A kész rekordot hozzáfűzi a felhasználói listához.
    array_push($users, $user);
}

//becho "<pre>";
// print_r($users);
echo "<br>";

// A teljes lista oszlopait jelző címsor.
echo "<h3>Név   kor  város</h3>";

foreach ($users as $u) {
    // $u = assoc tömb
    echo $u["nev"] . " , " . $u["kor"] . " , " . $u["varos"] . "<br>";
}

// minden budapesti user
echo "<h3>Budapesti felhasználók:</h3>";
foreach ($users as $u) {
    if($u["varos"] == "Budapest") {
        echo $u["nev"] . " , ";
    }
}

// minden budapesti user 2
echo "<h3>Budapesti felhasználók:</h3>";
// A városlista bejárásához és a hozzá tartozó név eléréséhez használt index.
$index = 0;
// Végiglépked a külön tárolt városokon.
foreach ($varos as $v) {
    if($v == "Budapest") {
        // Az aktuális városhoz tartozó nevet az azonos index alapján írja ki.
        echo $nev[$index] . " , ";
    }
    // Lépteti az indexet, hogy a név és város továbbra is ugyanahhoz a személyhez tartozzon.
    $index++;
}

// 30 évnél fiatalabbak
echo "<h3>30 évnél fiatalabbak:</h3>";
foreach ($users as $u) {
    if($u["kor"] < 30) {
        echo $u["nev"] . " , ";
    }
}

?>