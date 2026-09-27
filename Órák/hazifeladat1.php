<?php

// A személyek nevei; azonos indexen a három tömbben ugyanannak a személynek az adatai szerepelnek.
$nev = ["Kata ", "Zoli ", "Zita ", "Ádám "];
// A nevek sorrendjéhez tartozó születési évek.
$szuletesiEv = [2000, 2001, 1997, 1998];
// A nevek sorrendjéhez tartozó születési helyek.
$varos = ["Budapest", "Szigethalom", "Nagykanizsa", "Szolnok"];

// A párhuzamos tömbök bejárásához használt index, nulláról indítva.
$i = 0;
// Egyenként bejárja a neveket; az aktuális név az n változóba kerül.
foreach ($nev as $n) {
    // Összefűzi és kiírja a nevet, az azonos indexű évet és várost, majd HTML-sortörést ad hozzá.
    echo $n . $szuletesiEv[$i] . "-en született és a születési helye " . $varos[$i] . ".<br>";
    // A következő személy adataihoz lépteti az indexet.
    $i++;
}
// Üres sort jelenít meg az adatsorok és az átlag között.
echo "<br>";

// Az array_sum összeadja az éveket, a count megszámolja őket; a hányados az átlagos születési év, 1999.
echo "Az átlag születési év: " . array_sum($szuletesiEv) / count($szuletesiEv) . ".<br>";

?>