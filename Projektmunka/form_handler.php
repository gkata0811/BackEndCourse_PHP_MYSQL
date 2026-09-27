<?php

/*
| TANULÁSI SEGÉDLET – FONTOS PHP PARANCSOK EBBEN A FÁJLBAN
| require_once            -> betölti a szükséges PHP fájlt, de ugyanazt csak egyszer.
| $_SERVER                -> többek között megmondja, milyen HTTP metódussal jött a kérés.
| $_POST                  -> a POST űrlapmezők értékeit tartalmazza.
| ??                      -> alapértéket ad, ha egy tömbelem nem létezik vagy null.
| (int)                   -> egész számmá alakítja a kapott értéket.
| if (...)                -> csak akkor futtatja a blokkot, ha a feltétel igaz.
| ||                      -> logikai VAGY; elég, ha valamelyik feltétel igaz.
| !                       -> logikai tagadás.
| header("Location: ...") -> átirányítja a böngészőt egy másik URL-re.
| urlencode()             -> URL-ben biztonságosan továbbítható formára kódol szöveget.
| prepare()/execute()     -> paraméterezett SQL-lekérdezést készít elő és hajt végre.
*/


/*
|--------------------------------------------------------------------------
| PILATES WITH KATA
| JELENTKEZÉSI ŰRLAP FELDOLGOZÁSA
|--------------------------------------------------------------------------
|
| Ez a fájl dolgozza fel a jelentkezési űrlapot.
| Ellenőrzi a megadott adatokat, majd sikeres
| kitöltés esetén elmenti azokat az adatbázisba.
|
*/


require_once "config.php";
require_once "functions.php";


/*
|--------------------------------------------------------------------------
| CSAK POST KÉRÉS ENGEDÉLYEZETT
|--------------------------------------------------------------------------
|
| Ha valaki közvetlenül próbálja megnyitni
| ezt a PHP fájlt, visszairányítjuk a főoldalra.
|
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header(
        "Location: jelentkezes.php#signup"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| ŰRLAPADATOK LEKÉRÉSE
|--------------------------------------------------------------------------
|
| A $_POST tömbből lekérjük a felhasználó
| által megadott adatokat.
|
*/


$nev = cleanInput(
    $_POST["name"] ?? ""
);


$email = cleanInput(
    $_POST["email"] ?? ""
);


$oratipusId = (int) (
    $_POST["classType"] ?? 0
);


$napId = (int) (
    $_POST["day"] ?? 0
);


$idosavId = (int) (
    $_POST["timeSlot"] ?? 0
);


$tapasztalatId = (int) (
    $_POST["experience"] ?? 0
);


/*
|--------------------------------------------------------------------------
| HIÁNYOS ŰRLAP ELLENŐRZÉSE
|--------------------------------------------------------------------------
|
| Ha bármelyik kötelező adat hiányzik,
| a jelentkezést nem mentjük el.
|
| Ehelyett visszairányítjuk a felhasználót
| a jelentkezési szekcióhoz, ahol piros
| hibaüzenet jelenik meg.
|
*/

if (
    $nev === ""
    ||
    $email === ""
    ||
    $oratipusId <= 0
    ||
    $napId <= 0
    ||
    $idosavId <= 0
    ||
    $tapasztalatId <= 0
) {

    header(
        "Location: jelentkezes.php"
        . "?status=error"
        . "&message="
        . urlencode(
            "Kérlek, tölts ki minden mezőt!"
        )
        . "#signup"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| E-MAIL CÍM ELLENŐRZÉSE
|--------------------------------------------------------------------------
|
| Megvizsgáljuk, hogy a megadott e-mail cím
| megfelelő formátumú-e.
|
*/

if (!validEmail($email)) {

    header(
        "Location: jelentkezes.php"
        . "?status=error"
        . "&message="
        . urlencode(
            "Kérlek, érvényes e-mail címet adj meg!"
        )
        . "#signup"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| ÓRATÍPUS ELLENŐRZÉSE
|--------------------------------------------------------------------------
|
| Ellenőrizzük, hogy a kapott óratípus ID
| valóban létezik-e az adatbázisban.
|
*/

if (
    !optionExists(
        $pdo,
        "oratipusok",
        $oratipusId
    )
) {

    header(
        "Location: jelentkezes.php"
        . "?status=error"
        . "&message="
        . urlencode(
            "A kiválasztott óratípus nem megfelelő."
        )
        . "#signup"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| NAP ELLENŐRZÉSE
|--------------------------------------------------------------------------
*/

if (
    !optionExists(
        $pdo,
        "napok",
        $napId
    )
) {

    header(
        "Location: jelentkezes.php"
        . "?status=error"
        . "&message="
        . urlencode(
            "A kiválasztott nap nem megfelelő."
        )
        . "#signup"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| IDŐSÁV ELLENŐRZÉSE
|--------------------------------------------------------------------------
*/

if (
    !optionExists(
        $pdo,
        "idosavok",
        $idosavId
    )
) {

    header(
        "Location: jelentkezes.php"
        . "?status=error"
        . "&message="
        . urlencode(
            "A kiválasztott idősáv nem megfelelő."
        )
        . "#signup"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| TAPASZTALAT ELLENŐRZÉSE
|--------------------------------------------------------------------------
*/

if (
    !optionExists(
        $pdo,
        "tapasztalatok",
        $tapasztalatId
    )
) {

    header(
        "Location: jelentkezes.php"
        . "?status=error"
        . "&message="
        . urlencode(
            "A kiválasztott válasz nem megfelelő."
        )
        . "#signup"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| JELENTKEZÉS MENTÉSE AZ ADATBÁZISBA
|--------------------------------------------------------------------------
|
| Prepared statement segítségével biztonságosan
| elmentjük a jelentkezést.
|
*/

$sql = "
    INSERT INTO jelentkezesek
    (
        nev,
        email,
        oratipus_id,
        nap_id,
        idosav_id,
        tapasztalat_id
    )

    VALUES
    (
        :nev,
        :email,
        :oratipus,
        :nap,
        :idosav,
        :tapasztalat
    )
";


$stmt = $pdo->prepare($sql);


$stmt->execute([

    ":nev" => $nev,

    ":email" => $email,

    ":oratipus" => $oratipusId,

    ":nap" => $napId,

    ":idosav" => $idosavId,

    ":tapasztalat" => $tapasztalatId

]);


/*
|--------------------------------------------------------------------------
| SIKERES JELENTKEZÉS
|--------------------------------------------------------------------------
|
| Sikeres mentés után visszairányítjuk a felhasználót
| a jelentkezési szekcióhoz.
|
| A status=success alapján a jelentkezes.php
| megjeleníti a zöld sikerüzenetet.
|
*/

header(
    "Location: jelentkezes.php"
    . "?status=success"
    . "#signup"
);

exit;