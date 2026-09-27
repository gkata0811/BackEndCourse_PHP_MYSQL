<?php

// A választható felsőruhák tömbje, 0-tól 3-ig terjedő indexekkel.
$felso = ["fehér póló", "kék pulcsi", "fekete ing", "csíkos garbó"];
// A választható nadrágok és szoknyák tömbje.
$also = ["fehér nadrág", "piros szoknya", "barna rövidnadrág", "rakott szoknya"];
// A választható lábbelik tömbje.
$cipo = ["fekete szandál", "piros körömcipő", "kék bakancs", "barna csizma"];

// Piros színű HTML-címsort ír ki.
echo "<h4 style='color: red;'>Szettek:</h4>";
// Tíz összeállítást generál; ugyanaz a kombináció többször is előfordulhat.
for( $i = 0; $i < 10; $i++ ) {
    // Véletlen indexet választ a felsőruhákhoz.
    $f = rand(0,3);
    // Véletlen indexet választ az alsóruhákhoz.
    $a = rand(0,3);
    // Véletlen indexet választ a lábbelikhez.
    $c = rand(0,3);

    // Pont operátorokkal összefűzi a kiválasztott ruhák nevét, és HTML-sortöréssel zárja a sort.
    echo $felso[$f] . " - " . $also[$a] . " - " . $cipo[$c] . "<br>";

    // A szoknya szó helyét keresi az alsóruha nevében. A > 0 csak a nullánál nagyobb pozíciót fogadja el, a szöveg elején lévő találatot nem.
    if( strpos($also[$a], "szoknya" ) > 0) {
        // Kiírja a feltételhez tartozó megjegyzést és egy HTML-sortörést.
        echo "Csak nőknek! <br>";
    }

    // A körömcipő szó nullánál nagyobb pozíciójú előfordulását ellenőrzi. A két külön if miatt mindkét üzenet megjelenhet.
    if( strpos($cipo[$c], "körömcipő" ) > 0) {
        // Kiírja a feltételhez tartozó megjegyzést és egy HTML-sortörést.
        echo "Csak nőknek! <br>";
    }
}

?>