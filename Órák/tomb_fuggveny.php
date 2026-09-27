<?php

// A példákban módosított neveket tartalmazó tömb.
$nev = ["Anna ", "Csaba ", "Zsolt ", "Ildi "];
// A rendezési példák életkorai.
$kor = [25, 30, 29, 22];
// Városnevek tömbje; a további példák nem használják fel.
$varos = ["Pécs", "Sopron", "Szeged", "Eger"];

// elemek száma
echo count($nev) . "<br>";

// elem hozzáadása a tömb végéhez
array_push($nev, "Péter ");
//print_r($nev);

// utolsó elem eltávolítása
$utolso = array_pop($nev);
// Kiírja az eltávolított utolsó elemet, Péter nevét.
echo $utolso ."<br>";
// Megjeleníti a neveket tartalmazó tömb aktuális állapotát.
print_r($nev);
echo "<br>";

// első elem eltávolítása
array_shift($nev);
// Megjeleníti a neveket tartalmazó tömb aktuális állapotát.
print_r($nev);
echo "<br>";

// elem hozzáadása az elejéhez
array_unshift($nev, "Anna ");
// Megjeleníti a neveket tartalmazó tömb aktuális állapotát.
print_r($nev);
echo "<br>";

// szerepel-e az érték a tömbben
echo in_array("Ildi ", $nev) . "<br>";

// megkeresi egy elem indexét
echo array_search("Ildi ", $nev) . "<br>";

// megkeres egy elem kulcsát
$diak = ["nev" => "Anna", "kor" => 28, "dolgozik" => true];
print_r(array_keys($diak));
echo "<br>";
// Visszaadja és kiírja az asszociatív tömb értékeit számozott indexekkel.
print_r(array_values($diak));
echo "<br>";

// sorrend
sort($kor);
// Kiírja az életkorok aktuális sorrendjét.
print_r($kor);
echo "<br>";

// Csökkenő sorrendbe rendezi az életkorokat, és újraindexeli a tömböt.
rsort($kor);
// Kiírja az életkorok aktuális sorrendjét.
print_r($kor);
echo "<br>";

//ertek szerint sorrend, kulcs marad
$szam = ["a" => 22, "b" => 11, "c" => 33];
asort($szam);
// Kiírja a kulcs–érték párok aktuális sorrendjét.
print_r($szam);
echo "<br>";

// Kulcs szerint növekvő sorrendbe rendezi a tömböt, az értékeket a kulcsukhoz kötve megtartva.
ksort($szam);
// Kiírja a kulcs–érték párok aktuális sorrendjét.
print_r($szam);
echo "<br>";

// tömbök összefűzése
$t1 = [1, 2];
$t2 = [3, 4];

$eredmeny = array_merge($t1, $t2);
// Kiírja az összefűzött tömböt: 1, 2, 3, 4.
print_r($eredmeny);
echo "<br>";

// duplikált értékek eltávolítása
$t3 = [1, 2, 2, 2, 3, 3, 4, 5, 6];
print_r(array_unique($t3));
echo "<br>";

// egy részt ad vissza
$resz = array_slice($t3, 1, 2);
// Kiírja a kivágott két elemet: 2 és 2.
print_r($resz);
echo "<br>";

?>