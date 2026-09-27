<?php

/*
| TANULÁSI SEGÉDLET – FONTOS PHP PARANCSOK EBBEN A FÁJLBAN
| function nev(...)       -> újra felhasználható függvényt hoz létre.
| return                  -> visszaad egy eredményt és befejezi a függvény futását.
| trim()                  -> eltávolítja a szöveg elejéről/végéről a felesleges szóközöket.
| filter_var()            -> a megadott szabály alapján ellenőriz vagy szűr egy értéket.
| prepare()               -> előkészít egy SQL-lekérdezést.
| execute()               -> végrehajtja az előkészített lekérdezést.
| fetchAll()              -> a lekérdezés összes találatát visszaadja.
| fetch()                 -> a következő egyetlen találatot olvassa ki.
| in_array(..., true)     -> szigorúan ellenőrzi, szerepel-e egy érték a tömbben.
| !== false               -> azt vizsgálja, hogy valóban érkezett-e találat.
*/


/*
|--------------------------------------------------------------------------
| PILATES WITH KATA
| SEGÉDFÜGGVÉNYEK
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| BEVITEL TISZTÍTÁSA
|--------------------------------------------------------------------------
*/

function cleanInput($data)
{
    return trim($data);
}


/*
|--------------------------------------------------------------------------
| E-MAIL CÍM ELLENŐRZÉSE
|--------------------------------------------------------------------------
*/

function validEmail($email)
{
    return filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    );
}


/*
|--------------------------------------------------------------------------
| ÓRATÍPUSOK LEKÉRÉSE
|--------------------------------------------------------------------------
*/

function getClassTypes($pdo)
{
    $sql = "
        SELECT id, nev
        FROM oratipusok
        ORDER BY id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll();
}


/*
|--------------------------------------------------------------------------
| NAPOK LEKÉRÉSE
|--------------------------------------------------------------------------
*/

function getDays($pdo)
{
    $sql = "
        SELECT id, nev
        FROM napok
        ORDER BY id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll();
}


/*
|--------------------------------------------------------------------------
| IDŐSÁVOK LEKÉRÉSE
|--------------------------------------------------------------------------
*/

function getTimeSlots($pdo)
{
    $sql = "
        SELECT id, idosav
        FROM idosavok
        ORDER BY id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll();
}


/*
|--------------------------------------------------------------------------
| TAPASZTALATI LEHETŐSÉGEK LEKÉRÉSE
|--------------------------------------------------------------------------
*/

function getExperiences($pdo)
{
    $sql = "
        SELECT id, valasz
        FROM tapasztalatok
        ORDER BY id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll();
}


/*
|--------------------------------------------------------------------------
| OPCIÓ LÉTEZÉSÉNEK ELLENŐRZÉSE
|--------------------------------------------------------------------------
*/

function optionExists($pdo, $table, $id)
{
    /*
     * Csak ezeket a táblákat
     * engedjük használni.
     */
    $allowedTables = [
        "oratipusok",
        "napok",
        "idosavok",
        "tapasztalatok"
    ];


    if (!in_array($table, $allowedTables, true)) {

        return false;
    }


    $sql = "
        SELECT id
        FROM $table
        WHERE id = :id
    ";


    $stmt = $pdo->prepare($sql);


    $stmt->execute([
        ":id" => $id
    ]);


    return $stmt->fetch() !== false;
}


/*
|--------------------------------------------------------------------------
| LEADOTT JELENTKEZÉSEK LEKÉRÉSE
|--------------------------------------------------------------------------
*/

function getApplications($pdo)
{
    $sql = "
        SELECT
            jelentkezesek.id,
            jelentkezesek.nev,
            jelentkezesek.email,

            oratipusok.nev AS oratipus,

            napok.nev AS nap,

            idosavok.idosav,

            tapasztalatok.valasz AS tapasztalat,

            jelentkezesek.letrehozva

        FROM jelentkezesek

        INNER JOIN oratipusok
            ON jelentkezesek.oratipus_id
            = oratipusok.id

        INNER JOIN napok
            ON jelentkezesek.nap_id
            = napok.id

        INNER JOIN idosavok
            ON jelentkezesek.idosav_id
            = idosavok.id

        INNER JOIN tapasztalatok
            ON jelentkezesek.tapasztalat_id
            = tapasztalatok.id

        ORDER BY jelentkezesek.letrehozva DESC
    ";


    $stmt = $pdo->prepare($sql);

    $stmt->execute();


    return $stmt->fetchAll();
}