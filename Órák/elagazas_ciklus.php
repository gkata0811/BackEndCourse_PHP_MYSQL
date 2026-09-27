<?php

// if
$szam = 10;
// Az érték 10, ezért a true feliratot írja ki.
if ($szam == 10) {
    echo "true<br>";
}else{
    echo "false<br>";
}
// A 10-et szövegként tárolja.
$text = "10";
// Az egész szám és a szöveg eltérő típusa miatt a feltétel hamis.
if ($szam === $text) {
    echo "true<br>";
}else{
    echo "false<br>";
}


// = értékadás, == érték összehasonlítás, === érték és típus összehasonlítás


// Az elágazásban vizsgált jegy értéke.
$jegy = 3;
// Sorban ellenőrzi az eseteket; itt a 3-hoz tartozó ág fut le.
if ($jegy == 1) {
    echo 1 ."<br>";
}elseif ($jegy == 2) {
    echo 2 ."<br>";
}elseif ($jegy == 3) {
    echo 3 ."<br>";
}else{
    // Ez az ág minden, az előző esetekhez nem illeszkedő értéknél lefut, nem csak 3-nál nagyobb számokra.
    echo "Nagyobb mint 3<br>";
}


// ==   !=   <   >   <=   >=
// &&   ||


// függvény visszatérő értékekre
$t = [1,2,3,4,5];
// A tömb elemszámát vizsgálja; öt elem esetén nem lép be az ágba.
if(count($t) > 10){
    echo "true<br>";
}
// A hosszvizsgálathoz használt szöveg.
$sz = "4343trete";
// A strlen bájtokban mért hosszt ad; ez az ASCII-szöveg kilenc karakteres, ezért a feltétel hamis.
if(strlen($sz) >= 10){
    echo "true<br>";
}


// switch case
$nap = 3;
switch ($nap) {
    case 1:
        echo "Hétfő<br>";
        // Kilép az aktuális switch szerkezetből vagy ciklusból.
        break;
    case 2:
        echo "Kedd<br>";
        // Kilép az aktuális switch szerkezetből vagy ciklusból.
        break;
    // A nap értéke 3, ezért a Szerda feliratot írja ki.
    case 3:
        echo "Szerda<br>";
        // Kilép az aktuális switch szerkezetből vagy ciklusból.
        break;
    case 4:
        echo "Csütörtök<br>";
        // Kilép az aktuális switch szerkezetből vagy ciklusból.
        break;
    case 5:
        echo "Péntek<br>";
        // Kilép az aktuális switch szerkezetből vagy ciklusból.
        break;
    // Ha egyik felsorolt eset sem illeszkedik, ezt az ágat hajtja végre.
    default:
        echo "Hétvége<br>";
}


// while elöl tesztelő ciklus
$szamlalo = 1;
// addig fut, amíg true a feltétel
while ($szamlalo <= 5) {
    // A szó szerinti i, szöveget írja ki, nem a számláló értékét.
    echo "i,<br>";
    // Eggyel növeli a számlálót; a while után 6, a do-while után 7 lesz.
    $szamlalo++;
}


// do while hátul tesztelő ciklus
do {
    // Egyszer kiírja a k, szöveget: a feltétel ellenőrzésekor a számláló már meghaladja az 5-öt.
    echo "k,<br>";
    // Eggyel növeli a számlálót; a while után 6, a do-while után 7 lesz.
    $szamlalo++;
} while ($szamlalo <= 5);


// for
// 0-tól 10-ig növeli a változót, mindkét határértéket kiírva.
for ($p = 0; $p <= 10; $p++) { 
    echo "p: ".$p."<br>";
}
// 100-tól 10-ig csökkenti a változót, mindkét határértéket kiírva.
for ($s = 100; $s >= 10; $s--) { 
    echo "s: ".$s."<br>";
}
$t = [1,2,3,4,5];
// A <= miatt az 5-ös indexet is megpróbálja elérni, pedig az ötelemű tömb indexei 0–4 közöttiek.
for ($q = 0; $q <= count($t); $q++) { 
    echo $t[$q]."<br>";
}
// A következő ciklus felső határa.
$v = 10;
// 0-tól indul, de a belső break miatt az 5 kiírása után leáll.
for ($z = 0; $z <= $v; $z++) { 
    echo $z."<br>";
    // Az 5-ös értéknél megszakítja a ciklust.
    if ($z == 5) {
        // Kilép az aktuális switch szerkezetből vagy ciklusból.
        break;
    }
}


// continue
$w = 10;
// 0-tól 10-ig halad; az 5-ös értéknél a continue átugorja a ciklustörzs hátralévő részét.
for ($a = 0; $a <= $w; $a++) {
    // A számot még a continue ellenőrzése előtt kiírja.
    echo $a;    
    if ($a == 5) {
            continue;
        }
        // Ez a felirat az 5-ös értéknél kimarad.
        echo "Itt vagyok!<br>";
    }


echo "<br>";
echo "<br>";


//___________________________ 1.
$tomb = ["kekjerwhe", "fgd-f.gd", "wejnfo@pejaken"];
// A tömbelemek megjelenített sorszáma 1-ről indul.
$h = 1;
// Egyenként bejárja a tömb szöveges elemeit.
foreach ($tomb as $tt) {
    // A @ jel helyét keresi. A > 0 feltétel a szöveg elején álló @ jelet nem tekinti találatnak.
    if (strpos($tt, "@") > 0) {
        echo $h . ". Tartalmaz @ jelet.<br>";
    }else{
        echo $h . ". Nem tartalmaz @ jelet.<br>";
    }
    // A következő elemhez növeli a sorszámot.
    $h++;
}


echo "<br>";
echo "<br>";


//___________________________ 2.
$szam = 10;
// A számláló 1-ről indul, ezért a végső értéke eggyel nagyobb lesz a ciklus lefutásainak számánál.
$i = 1;
// Addig ismétel, amíg a kisorsolt szám legalább 500 nem lesz.
while ($szam < 500) {
    // Számolja az újabb próbálkozást.
    $i++;
    // 0 és 600 közötti egész számot sorsol, a határokat is beleértve.
    $szam = rand(0,600);
}
// Kiírja a számlálót; az 1-es kezdőérték miatt ez nem pontosan a lefutások száma.
echo $i." ciklusra volt szükség!<br>";

?>