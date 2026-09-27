<?php
// store felépítése:
// megnevezés | model | db | leltári szám | félretéve | ár
$store1 = [
    ["szék", "bársony", 26, "S1001/345", 4, 14500],
    ["asztal", "fekete kerek", 6, "S1002/325", 2, 39900],
    ["fotel", "kagyló", 12, "S1003/245", 6, 29900],
    ["komód", "fiókos", 9, "S1004/344", 3, 56500],
    ["gardrób", "PAX rendszer", 5, "S1005/145", 4, 123500],
    ["konyha szekrény", "elemes", 2, "S1005/145", 1, 210500]
];

// A második raktár készlete az elsővel azonos oszlopsorrendben.
$store2 = [
    ["szék", "bársony", 9, "S2001/345", 5, 14500],
    ["asztal", "fekete kerek", 3, "S2002/325", 2, 39900],
    ["fotel", "kagyló", 4, "S2003/245", 0, 29900],
    ["komód", "fiókos", 3, "S2004/344", 0, 56500],
    ["gardrób", "PAX rendszer", 2, "S2005/145", 1, 123500],
    ["konyha szekrény", "elemes", 4, "S2005/145", 1, 210500]
];

// Az áthelyezni kívánt termék neve.
$move_item_name = "szék";
// Az áthelyezni kívánt darabszám.
$move_item_count = 2;

//Functions
// Listázza a tételek darabszámát, és kiszámítja a teljes, illetve a félretett készlet értékét.
function osszesen($tomb, $nev){
    // A teljes készlet értékének gyűjtőváltozója.
    $ossz = 0;
    // A félretett készlet értékének gyűjtőváltozója.
    $felretett = 0;
    echo "<br>";
    // A megjelenített tételek sorszámlálója.
    $index = 0;
    // Kiírja az aktuális raktár nevét.
    echo "__________ $nev __________<br>";
    // Egyenként bejárja a raktár terméksorait.
    foreach($tomb as $t){
        // Növeli a megjelenített sorszámot.
        $index++;
        // A darabszám és az egységár szorzatát hozzáadja a teljes értékhez.
        $ossz = $ossz + $t[2] * $t[5];
        // A félretett darabszám és az egységár szorzatát hozzáadja a foglalt készlet értékéhez.
        $felretett = $felretett + $t[4] * $t[5];
      // Kiírja a sorszámot, a termék nevét és darabszámát.
      echo "$index. $t[0] - $t[2] db <br>";
    }
    // Kiírja a teljes készlet összegzett értékét.
    echo "<br>A raktár össz értéke: $ossz Ft.";
    // Kiírja a félretett készlet összegzett értékét.
    echo "<br>A raktár foglalt készletének össz értéke: $felretett Ft.<br>";
}

// Bemutatja az áthelyezés előtti és utáni darabszámokat. A tömbök és a ciklusváltozók érték szerint kerülnek átadásra, így az eredeti készleteket nem módosítja.
function move_store($store1, $store2, $move_item_name, $move_item_count){
    // készlet csökkentés
    echo "<br>Raktás módosítás (Store1)<br>";
      // Végigjárja az első raktár termékeit; az s az aktuális sor másolata.
      foreach($store1 as $s){
            // Névegyezést és elegendő teljes készletet ellenőriz; a félretett mennyiséget nem vonja le.
            if(($s[0] == $move_item_name) && ($s[2] >= $move_item_count)){
            // Kiírja a változtatás előtti darabszámot.
            echo "$s[0] aktuális darabszáma: $s[2] <br>";
            // Az aktuális sor helyi másolatában csökkenti a darabszámot.
            $s[2] = $s[2] - $move_item_count;
            // Kiírja a helyi másolatban módosított darabszámot.
            echo "$s[0] aktuális darabszáma módosítás után: $s[2] <br>";
        }
    }

    // készlet növelés
    echo "Raktás módosítás (Store2)<br>";
    // Végigjárja a második raktárt; ez az ág akkor is lefut, ha az elsőben nem történt csökkentés.
    foreach($store2 as $s){
        // A célraktárban név alapján keresi a terméket.
        if($s[0] == $move_item_name){
            // Kiírja a változtatás előtti darabszámot.
            echo "$s[0] aktuális darabszáma: $s[2] <br>";
            // Az aktuális sor helyi másolatában növeli a darabszámot.
            $s[2] = $s[2] + $move_item_count;
            // Kiírja a helyi másolatban módosított darabszámot.
            echo "$s[0] aktuális darabszáma módosítás után: $s[2] <br>";
        }
    }
}

echo "Készletnyilvántartó (lekérdezés) 3.0";
// 1. Írjuk ki a raktárak összértékét külön-külön.
// 2. Bővítsük az 1-es feladatot.
// Írjuk ki a raktárban található tételek darabszámát raktáronként.
// 3. Bővítsük az 2-es feladatot.
// Írjuk ki a két raktárban található félretett tételek összértékét is.
osszesen($store1, "Store1");
osszesen($store2, "Store2");

echo "<br>";
echo "<br>";

echo "Készletnyilvántartó (módosítás) 3.0";
// 1. Hozzunk át az első raktárból a másodikba 2 széket a megadott
// változók felhasználásával.
// 2. Bővítsük az 1-es feladatot.
// Írjunk ellenőrzést az 1. feladatban megadott raktár változásra.
// 3. Bővítsük az 2-es feladatot.
// Írjuk ki a változtatott tétel nevét és darabszámát mindkét raktárban
// a tranzakció előtt és után is.
move_store($store1, $store2, $move_item_name, $move_item_count);

echo "<br>";
echo "<br>";

echo "Készletnyilvántartó (beszerzés) 2.0";
// 1. Írjuk ki azokat az elemeket raktáronként, amelyek db száma kevesebb mint 5.
// a lista címe legyen "beszerzésre kijelölt termékek".
// 2. Bővítsük az 1-es feladatot.
// Amelyik termékből kevesebb van mint 3 , azt vastagon szedjük a listában.

?>