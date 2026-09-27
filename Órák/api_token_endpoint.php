<?php

// endpoint
// Az a token, amellyel a beérkező értéket összehasonlítja.
$helyesToken = "titkos123";

// header -ben küldött token
$headers = getallheaders();

// Ellenőrzi, hogy megérkezett-e az Authorization fejléc.
if(!isset($headers['Authorization'])){
    // 401-es HTTP-státuszt állít be: a kérés hitelesítése sikertelen.
    http_response_code(401);
    // JSON-formátumú hibaüzenetet küld vissza.
    echo json_encode(["hiba" => "Nincs token!"]);
    // Leállítja a szkriptet, így a sikeres válasz már nem fut le.
    exit;
}

// Eltávolítja a „Bearer ” szöveget a fejlécből, és eltárolja a maradékot.
$token = str_replace("Bearer ", "", $headers['Authorization']);

// Szigorú összehasonlítással ellenőrzi a token értékét és típusát.
if($helyesToken !== $token){
    // 401-es HTTP-státuszt állít be: a kérés hitelesítése sikertelen.
    http_response_code(401);
    // JSON-formátumú hibaüzenetet küld vissza.
    echo json_encode(["hiba" => "Érvénytelen token!"]);
    // Leállítja a szkriptet, így a sikeres válasz már nem fut le.
    exit;
}

// Sikeres hitelesítés esetén JSON-ként visszaadja az állapotot és a felhasználó nevét.
echo json_encode([
    "status" => "Sikeres hitelesítés!",
    "felhasznalo" => "István"
]);

?>