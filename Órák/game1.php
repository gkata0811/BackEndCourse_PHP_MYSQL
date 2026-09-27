<?php

// A sárkányokat tartalmazó mezők sorszámai.
$sarkany = [12, 34, 6, 9, 56, 70];
// A létrákat tartalmazó mezők sorszámai.
$letra= [11, 67, 90, 2, 4, 33];
// A játékos kezdőpozíciója.
$pozicio = 0;
// A lejátszott körök számlálója.
$loop = 0;
// A sárkánytalálatok számlálója.
$s_szam = 0;
// A létratalálatok számlálója.
$l_szam = 0;

// Kék színű címsort jelenít meg.
echo "<h4 style='color: blue'>Sárkány - létra játék 1.0</h4>";
// Addig játszik, amíg a kör elején a pozíció kisebb 100-nál; a 100-as mező túlléphető.
while($pozicio < 100){
        // Hatoldalú dobókockát szimulál: 1–6 közötti egész számot választ.
        $dob = rand(1,6);
        // Előrelép a dobott értékkel.
        $pozicio = $pozicio + $dob;

        // Végigellenőrzi a sárkánymezőket. A ciklus közben módosult pozícióra a későbbi elemek is hatással lehetnek.
        foreach($sarkany as $s){
            // Megvizsgálja, hogy a játékos az aktuális sárkánymezőn áll-e.
            if ($s == $pozicio){
                // Sárkánytalálatnál tíz mezőt visszalép.
                $pozicio = $pozicio - 10;
                // Eggyel növeli a sárkánytalálatok számát.
                $s_szam++;
                }
           }
        // A sárkányok feldolgozása utáni pozíciót ellenőrzi a létrák listájában.
        foreach($letra as $l){
            // Megvizsgálja, hogy a játékos az aktuális létramezőn áll-e.
            if ($l == $pozicio){
                // Létratalálatnál tíz mezőt előrelép.
                $pozicio = $pozicio + 10;
                // Eggyel növeli a létratalálatok számát.
                $l_szam++;
                }
           }
        // Az aktuális kör végén növeli a körszámlálót.
        $loop++;   
    }

// Kiírja a körök számát, majd a sárkány- és létratalálatok összesítését.
echo "A játék $loop körös volt.<br>";
echo "A sárkányok száma: $s_szam darab.<br>";
echo "A létrák száma $l_szam darab.<br>";

?>