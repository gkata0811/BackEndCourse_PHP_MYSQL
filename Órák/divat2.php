<?php

// A választható felsőruhák tömbje, 0–3 indexekkel.
$felso = ["fehér póló", "kék pulcsi", "fekete ing", "csíkos garbó"];
// A választható alsóruhák tömbje.
$also = ["fehér nadrág", "piros szoknya", "barna rövidnadrág", "rakott szoknya"];
// A választható lábbelik tömbje.
$cipo = ["fekete szandál", "sportcipő", "kék bakancs", "barna csizma"];

// Piros színű címsort jelenít meg.
echo "<h4 style='color: red;'>Szettek:</h4>";
// Tíz véletlen összeállítást készít; a kombinációk ismétlődhetnek.
for( $i = 0; $i < 10; $i++ ) {
    // Véletlen indexet választ a felsőruhákhoz.
    $f = rand(0,3);
    // Véletlen indexet választ az alsóruhákhoz.
    $a = rand(0,3);
    // Véletlen indexet választ a lábbelikhez.
    $c = rand(0,3);

    // Megkeresi a szoknya szót. A > 0 feltétel a szöveg legelején, a 0. pozíción lévő találatot nem fogadná el.
    if( strpos($also[$a], "szoknya" ) > 0) {
        // Találat esetén aranyszínű címsorban írja ki az összefűzött ruhaneveket.
        echo "<h4 style='color: gold;'>" . $felso[$f] . " - " . $also[$a] . " - " . $cipo[$c] . "</h4><br>";
    } else {
        // Egyébként kék színnel jeleníti meg az összeállítást.
        echo "<h4 style='color: blue;'>" . $felso[$f] . " - " . $also[$a] . " - " . $cipo[$c] . "</h4><br>";
    }
}

?>