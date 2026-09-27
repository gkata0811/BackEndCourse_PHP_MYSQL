<?php
	
// Egész számot tároló változó, kezdetben 10.
$a = 10;
// Lebegőpontos számot tároló változó, értéke 12,5.
$b = 12.5;
// Az osztásban és más műveletekben használt egész szám.
$c = 2;

// Kiírja a b értékét, majd HTML-sortörést jelenít meg.
echo $b. "<br>";

// Összeadja a két számot, és kiírja a 22,5-ös eredményt.
echo $a + $b."<br>";
// Kivonja b-t a-ból; az eredmény -2,5.
echo $a - $b."<br>";
// A szorzatot, 125-öt írja ki.
echo $a * $b."<br>";
// Elosztja a-t c-vel; az eredmény 5.
echo $a / $c."<br>";
// Az egész osztás maradékát írja ki; 10 osztva 2-vel 0 maradékot ad.
echo $a % $c."<br>";
// A szorzatot, 125-öt írja ki.
echo $a ** $b."<br>";

// Eggyel növeli a értékét.
$a++;
// Eggyel csökkenti a értékét, így ismét 10 lesz.
$a--;

// A két szám összegét eltárolja.
$szam = $a + $b;
// A zárójelek szerinti sorrendben számol: összead, megszoroz c-vel, majd öttel oszt; az eredmény 9.
$szam2 =(($a + $b) * $c) / 5;

// Kiírja az eltárolt összeget.
echo $szam."<br>";
// Kiírja az összetett kifejezés eredményét.
echo $szam2."<br>";

// A pont operátorral két számértéket és elválasztó szöveget fűz össze.
echo $a." - ".$a."<br>";
// A szó szerinti a és b karaktert összefűzi c értékével: ab2.
echo "a"."b".$c."<br>";

// A termék forintban megadott ára.
$ar = 4000;

// Mondatba illeszti a termék árát, és sortörést tesz a végére.
echo "A termék ára: ".$ar." Ft"."<br>";

// Az összeadási példa első száma.
$x = 20;
// Az összeadási példa második száma.
$y = 30;

// Kiírja az összeadás tagjait és eredményét. PHP 8-ban a + előbb értékelődik ki, mint a szövegösszefűző pont operátor.
echo $x." + ".$y." = ".$x+$y."<br>";

// Felülírja x korábbi értékét 5-tel; a következő kiírás már ezzel számol.
$x =5;

// Kiírja az összeadás tagjait és eredményét. PHP 8-ban a + előbb értékelődik ki, mint a szövegösszefűző pont operátor.
echo $x." + ".$y." = ".$x+$y."<br>";

//________ szöveges változók
/*
Több
soros
komment
*/

// A szövegkezelő példák kiinduló szövege.
$sz = "Hello";
// Számszerű szöveg, amely összeadáskor számmá alakítható.
$text = "200";
// Számjegyekkel kezdődő, de betűt is tartalmazó szöveg.
$text2 = "20a";

// A számszerű szöveghez hozzáad 5-öt, és kiírja a 205-ös eredményt.
echo 5 + $text."<br>";
//echo 5 + $text2; hiba

$t = (int) $text; //számmá alakítunk

echo strlen($sz)."<br>"; //strlen() függvény megmondja egy szöveg hosszát
// Háromszor megismétli a ha szöveget: hahaha.
echo str_repeat("ha", 3)."<br>";
echo strtolower($sz)."<br>"; //strtolower() függvény kisbetűssé alakítja a szöveget
// A kisbetűssé alakított szöveget visszamenti a változóba.
$sz = strtolower($sz);
echo strtoupper($sz)."<br>"; //strtoupper() függvény nagybetűssé alakítja a szöveget
echo substr($sz,0,2)."<br>"; //substr() függvény visszaadja a szöveg egy részét
// Megkeresi a fa szöveg kezdőpozícióját az almafa szóban; a nulláról induló indexelés miatt az eredmény 4.
echo strpos("almafa","fa")."<br>";
echo str_replace("a","o","alma")."<br>"; //str_replace() függvény kicseréli a szöveg egy részét

?>