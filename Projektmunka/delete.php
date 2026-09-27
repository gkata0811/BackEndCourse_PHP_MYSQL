<?php

/*
| TANULÁSI SEGÉDLET – FONTOS PHP PARANCSOK EBBEN A FÁJLBAN
| require_once            -> egyszer tölti be a megadott PHP fájlt; hiba esetén leáll.
| $_SERVER                -> a kérés/kiszolgáló adatait tartalmazó szuperglobális tömb.
| $_POST                  -> a POST metódussal elküldött űrlapadatokat tartalmazza.
| ??                      -> null coalescing: ha bal oldalon nincs érték, a jobb oldalit használja.
| (int)                   -> egész számmá alakítja az értéket.
| header("Location: ...") -> HTTP átirányítást küld a böngészőnek.
| exit                    -> azonnal befejezi az aktuális PHP program futását.
| prepare()               -> előkészített SQL utasítást hoz létre.
| execute()               -> végrehajtja az SQL utasítást a megadott paraméterekkel.
*/


/*
|--------------------------------------------------------------------------
| PILATES WITH KATA
| JELENTKEZÉS TÖRLÉSE
|--------------------------------------------------------------------------
*/


require_once "config.php";


/*
|--------------------------------------------------------------------------
| CSAK POST KÉRÉS ENGEDÉLYEZETT
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header(
        "Location: jelentkezes.php#applications"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| JELENTKEZÉS ID LEKÉRÉSE
|--------------------------------------------------------------------------
*/

$id = (int) (
    $_POST["id"] ?? 0
);


/*
 * Hibás ID esetén visszalépünk.
 */
if ($id <= 0) {

    header(
        "Location: jelentkezes.php#applications"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| JELENTKEZÉS TÖRLÉSE
|--------------------------------------------------------------------------
*/

$sql = "
    DELETE FROM jelentkezesek
    WHERE id = :id
";


$stmt = $pdo->prepare($sql);


$stmt->execute([
    ":id" => $id
]);


/*
|--------------------------------------------------------------------------
| SIKERES TÖRLÉS
|--------------------------------------------------------------------------
*/

header(
    "Location: jelentkezes.php"
    . "?delete=success"
    . "#applications"
);

exit;