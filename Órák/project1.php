<?php

// Négy diák nevét külön változókban tárolja, a nevek végén szóközzel.
$nev1= "Anna ";
$nev2= "Csaba ";
$nev3= "Zsolt ";
$nev4= "Ildi ";

// Az életkorokat számszerű szövegként tárolja; az összeadás számként dolgozza fel őket.
$kor1 = "25 ";
$kor2 = "30 ";
$kor3 = "29 ";
$kor4 = "22 ";

// A következő négy sor a pont operátorral összefűzi és kiírja a nevet, kort és az éves szöveget.
echo $nev1 . $kor1 . "éves.<br>";
echo $nev2 . $kor2 . "éves.<br>";
echo $nev3 . $kor3 . "éves.<br>";
echo $nev4 . $kor4 . "éves.<br>";
echo "<br>";

// Összeadja az életkorokat; a változó itt még az összeget, 106-ot tartalmazza.
$atlag = $kor1 + $kor2 + $kor3 + $kor4;
//die("Itt a vége"); futás vége
// Egész számmá alakítja az összeg értékét.
$atlag = (int) $atlag;
// Az összeget néggyel osztva kiírja a 26,5 éves átlagot.
echo "A diákok átlag életkora: " . $atlag / 4 . " év.<br>";

//__________ 
// TÖMBÖK

echo "<br>";

// Üres tömböt hoz létre.
$szam = [];
// Öt egész számot tartalmazó tömböt hoz létre.
$szamok = [1,2,3,4,5];
//index 0 1 2 3 4
// A 4-es indexű, vagyis ötödik elemet írja ki.
echo $szamok[4]. "<br>";
// Az első tömbelemet 10-re módosítja.
$szamok[0] = 10;
// Kiírja a tömböt; a visszatérési értékhez fűzött br szöveget ez az utasítás nem írja ki.
print_r($szamok). "<br>";
echo "<br>";


// Három szöveges elemet tartalmazó tömb.
$szoveg = ["egy","kettő","három"];
// Kiírja az első szöveges elemet.
echo $szoveg[0]. "<br>";
// Megjeleníti a tömböt; a hozzáfűzött br itt sem kerül kiírásra.
print_r($szoveg). "<br>";
echo "<br>";
// Az első szöveges elemet egész számra cseréli; a PHP-tömb vegyes típusokat is tárolhat.
$szoveg[0] = 10;

// Logikai értékeket tartalmazó tömb.
$igaz = [true, false, true, true];


// több dimenziós tömb
$szamok = [
//   0 1 2
    [1,20,3], //0
    [4,5,6], //1
    [7,8,9] //2
];

// Előformázott HTML-blokkot nyit a tömbök áttekinthetőbb kiírásához.
echo "<pre>";
// Kiírja a teljes kétdimenziós tömböt.
print_r($szamok);
echo "<br>";
// Az első sor második elemét, 20-at írja ki.
echo $szamok[0][1]."<br>";
// Csak a kétdimenziós tömb első sorát írja ki.
print_r($szamok[0]);

//assoc tömb        kulcs-érték

$assoc =["egy" => 1, "kettő" => 2, "három" => 3];
// Egy diák nevét, korát és munkavégzési állapotát tároló rekord.
$diak = ["nev" => "Anna", "kor" => 28, "dolgozik" => true];

// Kiírja a diák teljes rekordját.
print_r($diak);
// A nev kulcshoz tartozó értéket jeleníti meg.
echo $diak["nev"];
echo "<br>";

// Három diák asszociatív tömbjét tartalmazó lista.
$diakok = [
    ["nev" => "Anna", "kor" => 28, "dolgozik" => true],
    ["nev" => "Csaba", "kor" => 30, "dolgozik" => true],
    ["nev" => "Zsolt", "kor" => 32, "dolgozik" => true]
    ];

// Kiírja a teljes diáklistát.
print_r($diakok);
// A második diák nevét, Csabát írja ki.
echo $diakok[1]["nev"];
echo "<br>";
// Az első diák nevét és életkorát összefűzve jeleníti meg.
echo $diakok[0]["nev"] . " " . $diakok[0]["kor"] . " éves.<br>";

//véletlen szám

$sz = rand(0,10);
// Kiírja a kisorsolt számot.
echo $sz . "<br>";

// Részletesen kiírja a diáklista szerkezetét, értékeit és adattípusait.
var_dump($diakok);

?>