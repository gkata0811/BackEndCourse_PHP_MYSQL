<?php

// A hitelesítéshez elküldendő API-kulcs.
$apiKey = "aieonrhpfvgnjaehr9";

// A szolgáltatás helykitöltő címe; működő kéréshez valódi API-végpont szükséges.
$url = "https://minta...";

// A kérés HTTP-fejléceinek listája.
$headers = [
    // A kulcsot Bearer hitelesítési adatként küldi el.
    "Authorization: Bearer $apiKey",
    // Jelzi, hogy a kliens JSON-formátumú választ vár.
    "Accept: application/json",
    // A kérés törzsének formátumát JSON-ként jelöli; ez a példa nem állít be törzset.
    "Content-Type: application/json",
    // Az alkalmazás nevét és verzióját jelzi a szervernek.
    "User-Agent: MyApp/1.0"
];

// Létrehozza a megadott URL-re irányuló cURL-kérést.
$ch = curl_init($url);
    // Beállítja a kérés célcímét.
    curl_setopt($ch, CURLOPT_URL, $url);
    // A választ szövegként adja vissza, közvetlen kiírás helyett.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Kikapcsolja a szerver TLS-tanúsítványának ellenőrzését; ez gyengíti a HTTPS-kapcsolat biztonságát.
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Beállítja a kéréshez küldött HTTP-fejléceket.
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// Végrehajtja a HTTP-kérést, és eltárolja a választ; cURL-hiba esetén az érték false.
$response = curl_exec($ch);

// A JSON-választ PHP-tömbbé alakítja; a true paraméter asszociatív tömböket kér.
$data = json_decode($response, true);

?>