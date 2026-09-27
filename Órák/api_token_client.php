<?php

// client

// A szerver által elvárt hitelesítési token.
$token = "titkos123";

// Létrehozza a megadott URL-re irányuló cURL-kérést.
$ch = curl_init("http://localhost/api_token_endpoint.php");
    // A választ szövegként adja vissza, közvetlen kiírás helyett.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    // Beállítja a kéréshez küldött HTTP-fejléceket.
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
// Végrehajtja a HTTP-kérést, és eltárolja a választ; cURL-hiba esetén az érték false.
$response = curl_exec($ch);

// Lezárja a cURL-kezelőt.
curl_close($ch);

// Kiírja a kiszolgáló válaszát.
echo $response;



?>