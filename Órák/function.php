<?php
// Példa egész szám; a további kód nem használja fel.
$a = 10;
// A későbbi szamol hívás első argumentumának értéke.
$b = 20;

// Paraméter nélküli függvény, amely köszönést és HTML-sortörést ír ki.
function koszon(){
    echo "Hello<br>";
}

// A paraméterként kapott nevet beilleszti a köszönésbe.
function koszon2($nev){
    echo "Hello $nev<br>";
}

// Az első paraméterhez 100-at ad, az eredményt megszorozza a másodikkal, majd kiírja.
function szamol($x, $y){
    echo ($x + 100)* $y . "<br>";
}

// Visszaadja a két paraméter összegét; önmagában nem írja ki.
function szamol2($x, $y){
    return $x + $y;
}

// A Ma előtagot összefűzi a kapott szöveggel, majd sortöréssel kiírja.
function szoveg($t){
    // A függvényen belüli helyi változóban tárolja az előtagot.
    $text = "Ma ";
    echo $text . $t . "<br>";
}

// A Ma előtaggal kiegészített szöveget visszatérési értékként adja át.
function szoveg2($t){
    // A függvényen belüli helyi változóban tárolja az előtagot.
    $text = "Ma ";
    // A pont operátorral összefűzött szöveggel tér vissza.
    return $text . $t;
}

// Létrehoz és visszaad egy hat egész számot tartalmazó tömböt.
function tomb(){
    $tomb = [1,2,3,4,5,6];
    return $tomb;
}

function szoveg3($t = "hétvége van"){ // default paraméter érték
    // A függvényen belüli helyi változóban tárolja az előtagot.
    $text = "Ma ";
    // A pont operátorral összefűzött szöveggel tér vissza.
    return $text . $t;
}

// Meghívja a paraméter nélküli köszönőfüggvényt.
koszon();
// Csaba nevével hívja meg a köszönőfüggvényt.
koszon2("Csaba");
// A 20 és 2 argumentumokkal 240-et ír ki.
szamol($b, 2);
// A visszaadott összeget, 60-at eltárolja a változóban.
$szam = szamol2(20,40);
// Kiírja a Ma kedd van szöveget és egy HTML-sortörést.
szoveg("kedd van");
// Kiírja a függvény által visszaadott szöveget.
echo szoveg2("kedd van");
// HTML-sortörést jelenít meg.
echo "<br>";
// Eltárolja a függvény által visszaadott tömböt.
$t = tomb();
// Újra meghívja a függvényt, és olvasható formában kiírja a tömb kulcsait és értékeit.
print_r(tomb());
// HTML-sortörést jelenít meg.
echo "<br>";
// Argumentum nélkül hívja a függvényt, így a Ma hétvége van szöveget írja ki.
echo szoveg3();

?>