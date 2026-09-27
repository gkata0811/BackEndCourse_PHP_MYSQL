<?php

// A sárkánymezők sorszámai; találatkor tíz mezőt kell visszalépni.
$sarkany = [12, 34, 6, 9, 56, 70];
// A létramezők sorszámai; találatkor tíz mezőt lehet előrelépni.
$letra = [11, 67, 90, 2, 4, 33];
// Az olajmezők sorszámai; találatkor öt mezőt kell visszalépni. Az 55 kétszer szerepel a listában.
$olaj = [14, 55, 36, 7, 55, 17];
// Az egyes befejezett játékok dobásszámát gyűjtő tömb.
$jatek = [];
// Az összes játék sárkánytalálatainak számlálója.
$ossz_sarkany = 0;
// Az összes játék létratalálatainak számlálója.
$ossz_letra = 0;
// Az összes játék olajtalálatainak számlálója.
$ossz_olaj = 0;
// A játékos kezdőpozíciója.
$pozicio = 0;
// Az aktuális játék dobásszámlálója.
$loop = 0;
// Az aktuális játék sárkánytalálatainak száma.
$s_szam = 0;
// Az aktuális játék létratalálatainak száma.
$l_szam = 0;
// Az aktuális játék olajtalálatainak száma.
$o_szam = 0;
// Tízezer teljes játékot szimulál.
$d_szam = 10000;

// Kék színű HTML-címsort jelenít meg.
echo "<h4 style='color: blue'>Sárkány - létra játék 2.0</h4>";

// játék körök száma:
for($i = 0; $i < $d_szam; $i++){

    // start
    while($pozicio < 100){
            // Hatoldalú dobókockát szimulál: 1–6 közötti egész számot sorsol.
            $dob = rand(1,6);
            // Előrelép a dobott értékkel; a játék célja a legalább 100-as pozíció elérése.
            $pozicio = $pozicio + $dob;

            // sárkány ellenőr    
            foreach($sarkany as $s){
                // Az aktuális sárkánymezőt összeveti a játékos pozíciójával.
                if ($s == $pozicio){
                    // Sárkánytalálatnál tíz mezőt visszalép. A módosult pozíciót a lista későbbi elemei is vizsgálják.
                    $pozicio = $pozicio - 10;
                    // Eggyel növeli az aktuális játék sárkánytalálatainak számát.
                    $s_szam++;
                }
            }

            // létra ellenőr
            foreach($letra as $l){
                // A sárkányok ellenőrzése után megvizsgálja az aktuális létramezőt.
                if ($l == $pozicio){
                    // Létratalálatnál tíz mezőt előrelép.
                    $pozicio = $pozicio + 10;
                    // Eggyel növeli az aktuális játék létratalálatainak számát.
                    $l_szam++;
                }
            }

            // olaj ellenőr
            foreach($olaj as $o){
                // A létrák ellenőrzése utáni pozíciót összeveti az aktuális olajmezővel.
                if ($o == $pozicio){
                    // Olajtalálatnál öt mezőt visszalép.
                    $pozicio = $pozicio - 5;
                    // Eggyel növeli az aktuális játék olajtalálatainak számát.
                    $o_szam++;
                }
            }

            // Az aktuális dobás végén növeli a dobásszámlálót.
            $loop++;   
        }

        // összegzés
        array_push($jatek, $loop);
        $ossz_sarkany = $ossz_sarkany + $s_szam;
        $ossz_letra = $ossz_letra + $l_szam;
        $ossz_olaj = $ossz_olaj + $o_szam;
        // változók nullázása
        $loop = 0;
        $pozicio = 0;
        $s_szam = 0;
        $l_szam = 0;
        $o_szam = 0;
    }

// A játékok dobásszámainak összegét elosztja a játékok számával.
$avg = array_sum($jatek) / count($jatek);

// Kiírja, hány játék alapján számolta az átlagos dobásszámot.
echo "A(z) $d_szam játékból az átlag dobások száma: $avg db volt.<br>";
// Kiírja az összes játékban előfordult sárkánytalálatok számát.
echo "A sárkányok száma: $ossz_sarkany darab.<br>";
// Kiírja az összes játékban előfordult létratalálatok számát.
echo "A létrák száma $ossz_letra darab.<br>";
// Kiírja az összes olajtalálatot; a PHP zárótag előtt az utolsó pontosvessző elhagyható.
echo "Az olajmezők száma $ossz_olaj darab.<br>"

?>