<?php

// API-kulcs tárolása; az alábbi URL külön, közvetlenül beírt kulcsot használ.
$API_key = "ertdtgdrthr675675u56urf6zrft";
// A város neve; ebben a példában nem kerül bele a kérésbe.
$city = "Budapest";
// A kívánt mértékegységrendszer; a változót az URL jelenleg nem használja.
$units = "metric";
// A kívánt nyelv kódja; a változót az URL jelenleg nem használja.
$lang = "hu";

$url = "https://api.openweathermap.org/data/3.0/onecall?lat=33.44&lon=-94.04&exclude=hourly,daily&appid=472592791d5a17a11c6befc9f2ffbbfa";

//url magyarázat
//? paraméter lista kezdete
// paraméter  név=érték
// & jel a paraméterk kötéséhez

// Létrehozza a megadott URL-re irányuló cURL-kérést.
$ch = curl_init($url);
    // A választ szövegként adja vissza, közvetlen kiírás helyett.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Beállítja a kérés célcímét.
    curl_setopt($ch, CURLOPT_URL, $url);
// Végrehajtja a HTTP-kérést, és eltárolja a választ; cURL-hiba esetén az érték false.
$response = curl_exec($ch);
?>