<?php

// endpoint get
header('Content-Type: application/json');

// Három felhasználó adatai: azonosító, név és e-mail-cím.
$user = [
    ["id" => 1, "name" => "Kiss Anna", "email" => "kissanna@example.com"],
    ["id" => 2, "name" => "Nagy Béla", "email" => "nagybela@example.com"],
    ["id" => 3, "name" => "Tóth Csilla", "email" => "thothcsilla@example.com"]
];

// Csak GET-kérésnél lép a felhasználókat visszaadó ágba.
if($_SERVER['REQUEST_METHOD'] == "GET") {
    // JSON-formátumban kiírja a felhasználók tömbjét.
    echo json_encode($user);
} else {
    // Más HTTP-metódus esetén 405-ös, nem engedélyezett metódust jelző státuszt ad.
    http_response_code(405);
    // JSON-formátumú hibaüzenetet küld vissza.
    echo json_encode(["error" => "Method Not Allowed"]);
    // Leállítja a szkriptet, így az alábbi kiírás már nem történik meg.
    exit;
}

// GET esetén ismét kiírja ugyanazt a tömböt. A két egymás mellé írt JSON-tömb együtt nem érvényes JSON-dokumentum.
echo json_encode($user);

?>