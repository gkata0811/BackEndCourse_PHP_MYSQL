<?php

/*
| TANULÁSI SEGÉDLET – FONTOS PHP PARANCSOK EBBEN A FÁJLBAN
| $valtozo = ertek;       -> változó létrehozása és értékadás.
| new PDO(...)            -> új PDO adatbázis-kapcsolat létrehozása.
| try { ... }             -> megpróbálja végrehajtani a benne lévő kódot.
| catch (...) { ... }     -> kezeli a try blokkban keletkező kivételt/hibát.
| ->                      -> egy objektum metódusának vagy tulajdonságának elérése.
| setAttribute(...)       -> PDO működési beállítást ad meg.
| die(...)                -> kiír egy üzenetet és azonnal leállítja a PHP futását.
*/


/*
|--------------------------------------------------------------------------
| PILATES WITH KATA
| ADATBÁZIS KAPCSOLAT
|--------------------------------------------------------------------------
|
| Ez a fájl kapcsolódik a MySQL adatbázishoz.
| A kapcsolat létrehozásához PDO-t használunk.
|
*/


$host = "localhost";
$dbname = "pilates_db";
$username = "root";
$password = "";


try {

    /*
     * PDO kapcsolat létrehozása.
     */
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );


    /*
     * Ha SQL-hiba történik,
     * a PHP Exception formájában jelezze.
     */
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );


    /*
     * A lekérdezések eredményeit
     * asszociatív tömbként kapjuk vissza.
     */
    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );


} catch (PDOException $e) {

    /*
     * Sikertelen adatbázis-kapcsolat esetén
     * leállítjuk a programot.
     */
    die(
        "Adatbázis kapcsolódási hiba: "
        . $e->getMessage()
    );
}