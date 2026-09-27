<?php

/*
$nev1= "Anna ";
$nev2= "Csaba ";
$nev3= "Zsolt ";
$nev4= "Ildi ";

$kor1 = "25 ";
$kor2 = "30 ";
$kor3 = "29 ";
$kor4 = "22 ";

echo $nev1 . $kor1 . "éves.<br>";
echo $nev2 . $kor2 . "éves.<br>";
echo $nev3 . $kor3 . "éves.<br>";
echo $nev4 . $kor4 . "éves.<br>";
echo "<br>";

$atlag = $kor1 + $kor2 + $kor3 + $kor4;
$atlag = (int) $atlag;
echo "A diákok átlag életkora: " . $atlag / 4 . " év.<br>";
*/

// A diákok nevei; azonos indexen a többi tömbben ugyanannak a diáknak az adatai találhatók.
$nev = ["Anna ", "Csaba ", "Zsolt ", "Ildi "];
// A diákok életkorai.
$kor = [25, 30, 29, 22];
// A diákok lakóhelyei.
$varos = ["Pécs", "Sopron", "Szeged", "Eger"];

// Nulláról indítja a párhuzamos tömbök indexét.
$i = 0;
// Egyenként bejárja a neveket.
foreach ($nev as $n) {
    // A névhez azonos indexű kort és várost illeszti, majd kiírja a mondatot.
    echo $n . $kor[$i] . " éves és " . $varos[$i] . " lakosa.<br>";
    // A következő diák adatainak indexére lép.
    $i++;
}

// Az életkorok összegét az elemszámmal osztva kiírja a 26,5 éves átlagot.
echo "A diákok átlag életkora: " . array_sum($kor) / count($kor) . " év.<br>";

//_____________________________________________________________________________________________

// A szövegátalakítási példák három gyümölcsnevét tárolja.
$tomb = ["alma", "körte", "barack"];
// kezdő
$tomb[0] = "ALMA";
$tomb[1] = "KÖRTE";
$tomb[2] = "BARACK";

foreach ($tomb as $t) {
    // Kiírja az aktuális tömbelemet vesszővel és szóközzel.
    echo $t . ", ";
}
echo "<br>";

// haladó
foreach ($tomb as $t) {
    // Az ASCII-betűket nagybetűsíti és kiírja. Az ékezetes betűket nem kezeli Unicode szerint; itt a tömb már eleve nagybetűs.
    echo strtoupper($t) . ", ";
}
echo "<br>";

//pro
print_r(array_map(fn($e) => mb_strtoupper($e), $tomb));

//--------------





echo "<br>";
echo "<br>";
echo "_____________________________________________________________________________________";

// 100 véletlen szám egy tömbben

// Üres gyűjtőtömb a véletlen számokhoz.
$szamok = [];

// Százszor végrehajtja a tömbelem hozzáadását.
for ($i = 0; $i < 100; $i++) {
    // Egy 1–1000 közötti véletlen egész számot fűz a tömb végére; az értékek ismétlődhetnek.
    array_push($szamok, rand(1, 1000));
}

//echo "<pre>";
//print_r($szamok);

echo "<br>";
echo "<br>";
echo "_____________________________________________________________________________________";
echo "<br>";

// Felülírja a korábbi véletlenszám-tömböt egy háromszor három elemes kétdimenziós tömbbel.
$szamok = [
//   0 1 2
    [1,20,3], //0
    [4,5,6], //1
    [7,8,9] //2
];

// A külső ciklus egyenként veszi a kétdimenziós tömb sorait.
foreach ($szamok as $szam) {
    // A belső ciklus végiglépked az aktuális sor számain.
    foreach ($szam as $sz) {
        // Kiírja az aktuális számot vesszővel; minden sor elemei egymás után jelennek meg.
        echo $sz . ",  ";
    }
}

?>