<?php

// A húsz ügyfél neve; az index kapcsolja össze a nevet a bank tömb megfelelő egyenlegével.
$user = [
    "Anna",
    "Bence",
    "Csilla",
    "Daniel",
    "Eszter",
    "Ferenc",
    "Greta",
    "Hunor",
    "Ildiko",
    "Janos",
    "Kata",
    "Laszlo",
    "Mira",
    "Norbert",
    "Orsolya",
    "Peter",
    "Reka",
    "Sandor",
    "Tamas",
    "Viktoria",
];

// Az ügyfelek egyenlegeit tároló, kezdetben üres tömb.
$bank = [];

// Húsz kezdőegyenleget hoz létre, egyet minden ügyfélnek.
for ($i = 0; $i < 20; $i++) {
    // Új elemként hozzáfűz egy véletlen, 100–10000 közötti egész forintösszeget.
    $bank[] = rand(100, 10000);
}

// A kezdőállapot listájának címe.
echo "Kezdő adatok<br>";

// Meghívja a később definiált függvényt a nevek és az aktuális egyenlegek kiírásához.
adatokKiirasa($user, $bank);

// HTML-sortöréssel választja el a megjelenített blokkokat.
echo "<br>";
// A saját osszeg függvénnyel kiszámítja és kiírja a kezdőegyenlegek összegét.
echo "A bank kezdő összvagyona: " . osszeg($bank) . " Ft<br>";

// HTML-sortöréssel választja el a megjelenített blokkokat.
echo "<br>";
// A fizetésjóváírásokat bemutató rész címe.
echo "Fizetések kiosztása:<br>";

// Végiglépked az összes ügyfél egyenlegén.
for ($i = 0; $i < count($bank); $i++) {
    // 10000 és 100000 közötti, egész forintban megadott fizetést sorsol.
    $fizetes = rand(10000, 100000);
    // A jóváírás előtt eltárolja az ügyfél korábbi egyenlegét.
    $regiPenz = $bank[$i];

    // Hozzáadja a fizetést az aktuális ügyfél egyenlegéhez.
    $bank[$i] += $fizetes;

    // Kiírja az ügyfél nevét, majd a régi egyenlegét, fizetését és új egyenlegét.
    echo $user[$i] . ":<br>";
    echo "Régi vagyon: " . $regiPenz . " Ft<br>";
    echo "Fizetés: " . $fizetes . " Ft<br>";
    echo "Új vagyon: " . $bank[$i] . " Ft<br><br>";
}

// HTML-sortöréssel választja el a megjelenített blokkokat.
echo "<br>";
// A frissített ügyféllista címe.
echo "Új adatok:<br>";

// Meghívja a később definiált függvényt a nevek és az aktuális egyenlegek kiírásához.
adatokKiirasa($user, $bank);

// HTML-sortöréssel választja el a megjelenített blokkokat.
echo "<br>";
// Összeadja és kiírja a fizetésekkel növelt egyenlegeket.
echo "A bank új összvagyona: " . osszeg($bank) . " Ft<br>";

// Kezdetben az első ügyfelet tekinti a legnagyobb egyenleg tulajdonosának.
$legtobbIndex = 0;

// A második ügyféltől indulva megkeresi a legnagyobb egyenleg indexét.
for ($i = 1; $i < count($bank); $i++) {
    // Csak szigorúan nagyobb összegnél frissít, így holtversenynél az első ilyen ügyfél marad meg.
    if ($bank[$i] > $bank[$legtobbIndex]) {
        // Eltárolja az eddig talált legnagyobb egyenleg indexét.
        $legtobbIndex = $i;
    }
}

// HTML-sortöréssel választja el a megjelenített blokkokat.
echo "<br>";
// A legnagyobb egyenlegű ügyfél adatait bemutató rész címe.
echo "Legtöbb pénz a bankban:<br>";

// A megtalált index alapján kiírja az ügyfél nevét.
echo "Név: " . $user[$legtobbIndex] . "<br>";
// Kiírja a hozzá tartozó legnagyobb egyenleget.
echo "Vagyon: " . $bank[$legtobbIndex] . " Ft<br>";

// Saját összegző függvény: egy számtömb elemeinek összegével tér vissza.
function osszeg($tomb)
{
    // Nulláról indítja az összeggyűjtő változót.
    $szumma = 0;

    // Index szerint bejárja az összegzendő tömb minden elemét.
    for ($i = 0; $i < count($tomb); $i++) {
        // Az aktuális elemet hozzáadja a gyűjtött összeghez.
        $szumma += $tomb[$i];
    }

    // Visszaadja a kiszámított összeget a hívás helyére.
    return $szumma;
}

// Azonos index alapján párosítja és kiírja a neveket és egyenlegeket.
function adatokKiirasa($nevek, $penzek)
{
    // A nevek számának megfelelően végiglépked a két párhuzamos tömbön.
    for ($i = 0; $i < count($nevek); $i++) {
        // Egytől induló sorszámot, nevet és forintban megadott egyenleget ír ki.
        echo ($i + 1) . ". " . $nevek[$i] . ": " . $penzek[$i] . " Ft<br>";
    }
}

?>
