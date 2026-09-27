<?php

// Az előállított átlagok gyűjtőtömbje; a megjelenítés az eredmenyek tömböt használja.
$atlagok = [];
// Az értékpárokat, átlagukat és kategóriájukat tároló tömb.
$eredmenyek = [];

// Tíz véletlenszerű értékpárt állít elő.
for ($i = 0; $i < 10; $i++) {
    // Az első számot véletlenszerűen választja 1 és 20 között, a határokat is beleértve.
    $a = rand(1, 20);
    // A második számot szintén az 1–20 tartományból választja.
    $b = rand(1, 20);

    // Kiszámítja a két szám számtani átlagát.
    $atlag = ($a + $b) / 2;

    // Az átlagot új elemként hozzáfűzi a tömbhöz.
    $atlagok[] = $atlag;

    // Az aktuális értékpár adatait asszociatív tömbként menti el.
    $eredmenyek[] = [
        "a" => $a,
        "b" => $b,
        "atlag" => $atlag,
        // A feltételes operátor 10 fölött Magas, egyébként Alacsony kategóriát választ.
        "kategoria" => $atlag > 10 ? "Magas" : "Alacsony"
    ];
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <!-- UTF-8 karakterkódolás az ékezetes szövegekhez. -->
    <meta charset="UTF-8">
    <!-- A megjelenítési szélességet az eszközhöz igazítja, 1-es kezdeti nagyítással. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Átlagok</title>
    <style>
        /* Az egész dokumentum alapvető betűtípusát, szövegszínét és hátterét adja meg. */
        :root {
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            color: #203047;
            background: #dce7f3;
        }

        /* Az elemek méretébe a belső térköz és a szegély is beleszámít. */
        * {
            box-sizing: border-box;
        }

        /* Legalább képernyőmagasságú, középre rendezett oldalt és több színátmenetből álló hátteret hoz létre. */
        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 32px 18px;
            background:
                radial-gradient(circle at 12% 15%, rgba(255, 255, 255, 0.9), transparent 30%),
                radial-gradient(circle at 88% 85%, rgba(255, 218, 176, 0.7), transparent 30%),
                linear-gradient(135deg, #89c4f4, #d9c2f0);
        }

        /* A tartalomdoboz megjelenését állítja; a mobilos szabályban csak a belső térközt módosítja. */
        .content {
            width: min(100%, 760px);
            padding: 36px;
            text-align: center;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 18px;
            box-shadow: 0 20px 55px rgba(46, 64, 86, 0.2);
            backdrop-filter: blur(10px);
        }

        /* A főcím megjelenése; a mobilos szabály kisebb betűméretet állít be. */
        h1 {
            margin: 0 0 8px;
            color: #173b5f;
            font-size: 2.2rem;
        }

        /* A bevezető szöveg színét és alsó térközét állítja. */
        .intro {
            margin: 0 0 26px;
            color: #607086;
        }

        /* Keskeny helyen vízszintes görgetést enged, és lekerekíti a táblázat keretét. */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 12px;
        }

        /* Teljes szélességű, fehér hátterű táblázatot hoz létre összevont cellaszegélyekkel. */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        /* Közös beállítások a fejléc- és adatcellákhoz; mobilon kisebb térközzel és betűmérettel. */
        th,
        td {
            padding: 13px 16px;
            border-bottom: 1px solid #e4ebf2;
        }

        /* A fejléc kék hátterét, fehér szövegét és betűméretét adja meg. */
        th {
            color: #fff;
            font-size: 0.9rem;
            background: #286090;
        }

        /* Eltávolítja az utolsó adatsor celláinak alsó szegélyét. */
        tbody tr:last-child td {
            border-bottom: 0;
        }

        /* Az egérmutató alatti sort világos háttérrel emeli ki. */
        tbody tr:hover {
            background: #f3f8fc;
        }

        /* A magas átlag kategóriáját barna, félkövér szöveggel jelöli. */
        .high {
            color: #9a4c12;
            font-weight: 700;
        }

        /* Az alacsony átlag kategóriáját kék, félkövér szöveggel jelöli. */
        .low {
            color: #286090;
            font-weight: 700;
        }

        /* Legfeljebb 560 pixel széles nézetben tömörebb megjelenítést alkalmaz. */
        @media (max-width: 560px) {
            /* A tartalomdoboz megjelenését állítja; a mobilos szabályban csak a belső térközt módosítja. */
            .content {
                padding: 26px 14px;
            }

            /* A főcím megjelenése; a mobilos szabály kisebb betűméretet állít be. */
            h1 {
                font-size: 1.8rem;
            }

            /* Közös beállítások a fejléc- és adatcellákhoz; mobilon kisebb térközzel és betűmérettel. */
            th,
            td {
                padding: 11px 9px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Az oldal fő tartalma: cím, bevezető és az eredmények táblázata. -->
    <main class="content">
        <h1>Generált átlagok</h1>
        <p class="intro">Tíz véletlenszerű értékpár és azok átlaga</p>

        <div class="table-wrapper">
            <table>
                <!-- A táblázat oszlopneveit tartalmazó fejléc. -->
                <thead>
                    <tr>
                        <th>#</th>
                        <th>A érték</th>
                        <th>B érték</th>
                        <th>Átlag</th>
                        <th>Kategória</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Minden eredményhez egy táblázatsort készít; az index nulláról indul. -->
                    <?php foreach ($eredmenyek as $index => $eredmeny): ?>
                        <tr>
                            <!-- Az indexhez egyet adva 1-től kezdődő sorszámot jelenít meg. -->
                            <td><?php echo $index + 1; ?></td>
                            <!-- Kiírja a két generált számot és a kiszámított átlagot a következő három cellába. -->
                            <td><?php echo $eredmeny["a"]; ?></td>
                            <td><?php echo $eredmeny["b"]; ?></td>
                            <td><?php echo $eredmeny["atlag"]; ?></td>
                            <!-- Az átlag alapján választ CSS-osztályt, majd kiírja a hozzá tartozó kategóriát. -->
                            <td class="<?php echo $eredmeny["atlag"] > 10 ? "high" : "low"; ?>">
                                <?php echo $eredmeny["kategoria"]; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>