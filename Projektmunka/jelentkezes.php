<?php

/*
| TANULÁSI SEGÉDLET – PHP + HTML PARANCSOK EBBEN A FÁJLBAN
| require_once            -> betölti az adatbázis- és segédfüggvényeket tartalmazó fájlokat.
| <?= ... ?>              -> a PHP kifejezés eredményét közvetlenül kiírja a HTML-be.
| if (...): ... endif;    -> HTML-be ágyazható PHP feltételes szerkezet.
| foreach (...): ... endforeach; -> egy tömb minden elemén végigmegy.
| htmlspecialchars()      -> HTML-ben veszélyes speciális karaktereket átalakítja.
| count()                 -> megszámolja egy tömb elemeit.
| <section>               -> az oldal egy tematikus szakasza.
| class="..."            -> CSS-sel formázható osztályt rendel az elemhez.
| id="..."               -> egyedi azonosító; például #signup hivatkozhat rá.
| <form>                  -> űrlapot hoz létre; action=célfájl, method=küldési mód.
| <label>                 -> egy űrlapmező felirata; a for az input id-jához kapcsolja.
| <input>                 -> beviteli mező. A name neve kerül a $_POST tömbbe.
| <select>/<option>       -> legördülő lista és annak választható elemei.
| <table>                 -> táblázat; thead=fejléc, tbody=törzs, tr=sor, th/td=cella.
| aria-*                  -> akadálymentességet segítő információ a segédtechnológiáknak.
*/


/*
|--------------------------------------------------------------------------
| PILATES WITH KATA
| FŐOLDAL
|--------------------------------------------------------------------------
|
| A weboldal fő PHP fájlja.
|
| Localhost:
| http://localhost/pilates/jelentkezes.php
|
*/


require_once "config.php";
require_once "functions.php";


/*
|--------------------------------------------------------------------------
| ADATOK LEKÉRÉSE AZ ADATBÁZISBÓL
|--------------------------------------------------------------------------
|
| A jelentkezési űrlap legördülő listáinak
| tartalmát az SQL-adatbázisból kérjük le.
|
*/

$oratipusok = getClassTypes($pdo);

$napok = getDays($pdo);

$idosavok = getTimeSlots($pdo);

$tapasztalatok = getExperiences($pdo);


/*
 * A korábban leadott jelentkezések lekérése.
 */
$jelentkezesek = getApplications($pdo);

?>

<!DOCTYPE html>

<html lang="hu">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Pilates with Kata
    </title>


    <!-- Saját CSS fájl -->
    <link
        rel="stylesheet"
        type="text/css"
        href="styles.css?v=20260909-4"
    >


    <!-- Google Fonts -->
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap"
        rel="stylesheet"
    >

</head>


<body>



<!-- =========================================================
     FEJLÉC
========================================================= -->

<header class="site-header">

    <div class="container header-inner">


        <!-- Márkanév -->

        <div class="brand">

            Pilates with Kata

        </div>


        <!-- Hamburger menü gomb -->

        <button
            class="hamburger"
            id="menu-toggle"
            type="button"
            aria-label="Menü megnyitása"
            aria-expanded="false"
            aria-controls="main-nav"
        >

            <span></span>
            <span></span>
            <span></span>

        </button>


        <!-- Navigáció -->

        <nav
            class="main-nav"
            id="main-nav"
        >

            <a href="#home">
                Főoldal
            </a>

            <a href="#history">
                Rólam
            </a>

            <a href="#classes">
                Órák
            </a>

            <a href="#signup">
                Jelentkezés
            </a>

            <a href="#applications">
                Leadott jelentkezések
            </a>

            <a href="#contact">
                Kapcsolat
            </a>

        </nav>

    </div>

</header>



<main>



<!-- =========================================================
     HERO / FŐOLDAL
========================================================= -->

<section
    class="hero"
    id="home"
>

    <div class="hero-content">

        <div class="hero-circle">

            <span>

                Pilates

                <small>
                    with Kata
                </small>

            </span>

        </div>

    </div>

</section>



<!-- =========================================================
     RÓLAM
========================================================= -->

<section
    class="section"
    id="history"
>

    <div class="container">

        <div class="section-layout">


            <div class="section-content">

                <h2>
                    Rólam
                </h2>


                <h3>
                    Üdvözöllek!
                </h3>


                <p>
                    Gulyás Kata vagyok, okleveles Pilates-oktató,
                    és hiszek abban, hogy a mozgás nem csupán
                    a test formálásáról szól,
                    hanem a testi-lelki egyensúly megteremtéséről is.

                    A Pilates számomra sokkal több egy edzésformánál:
                    egy olyan módszer, amely segít tudatosabb kapcsolatot
                    kialakítani a testünkkel, javítani a tartásunkat,
                    növelni az erőnket és csökkenteni
                    a mindennapi stresszt.
                </p>


                <p>
                    Oktatóként célom, hogy minden vendégem biztonságos,
                    támogató környezetben fejlődhessen,
                    függetlenül attól, hogy teljesen kezdőként érkezik,
                    vagy már régóta mozog.

                    Az óráimon kiemelt figyelmet fordítok
                    a helyes kivitelezésre,
                    a tudatos légzésre és az egyéni igényekre.
                </p>


                <p>
                    Hiszem, hogy minden test más,
                    ezért a Pilates gyakorlatait mindig
                    az adott személy képességeihez és céljaihoz igazítom.

                    Legyen szó hátfájás megelőzéséről,
                    rehabilitációról, alakformálásról
                    vagy egyszerűen a jobb közérzetről,
                    örömmel segítek az úton.
                </p>


                <p>
                    Szeretettel várlak óráimon,
                    hogy együtt fedezzük fel
                    a Pilates jótékony hatásait!
                </p>

            </div>


            <div class="section-image">

                <img
                    src="mindbodysoul.jpeg"
                    alt="Body Mind Soul"
                >

            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     ÓRÁK
========================================================= -->

<section
    class="section"
    id="classes"
>

    <div class="container">


        <h2>
            Órák
        </h2>


        <h3>
            Melyik órát válasszam?
        </h3>


        <p>
            Minden Pilates óra más élményt nyújt,
            ezért érdemes átgondolni,
            milyen célokkal érkezel hozzánk.

            Akár most ismerkedsz a Pilates világával,
            akár új kihívást keresel,
            segítünk megtalálni
            a számodra legmegfelelőbb óratípust.
        </p>


        <div class="cards">


            <!-- MAT PILATES -->

            <article class="card">

                <h3>
                    Mat Pilates - A tökéletes alap
                </h3>


                <p>
                    Ha még soha nem próbáltad a Pilates-t,
                    a Mat Pilates a legjobb választás számodra.

                    Ezeken az órákon elsajátíthatod
                    a Pilates alapelveit,
                    megtanulhatod a helyes légzéstechnikát,
                    a tudatos mozgás kivitelezését és
                    a törzs stabilizáló izmainak aktiválását.
                </p>


                <p>
                    A Mat Pilates különösen ajánlott azoknak,
                    akik ülőmunkát végeznek,
                    hát- vagy derékfájással küzdenek,
                    illetve szeretnének fokozatosan
                    erősebbé és hajlékonyabbá válni.
                </p>

            </article>


            <!-- REFORMER PILATES -->

            <article class="card">

                <h3>
                    Reformer Pilates –
                    Dinamikus fejlődés és teljes testes erősítés
                </h3>


                <p>
                    A Reformer Pilates a Pilates egyik
                    legnépszerűbb formája.

                    A speciális gép rugós ellenállása lehetővé teszi,
                    hogy a gyakorlatok egyszerre legyenek
                    kíméletesek és intenzívek.
                </p>


                <p>
                    Az óra során szinte minden izomcsoport dolgozik,
                    különösen a mélyizmok,
                    a farizmok, a lábak és
                    a törzs stabilizáló izmai.
                </p>

            </article>


            <!-- HOT PILATES -->

            <article class="card">

                <h3>
                    Hot Pilates –
                    Intenzív kihívás felfűtött környezetben
                </h3>


                <p>
                    A Hot Pilates azoknak készült,
                    akik szeretik a lendületesebb
                    és intenzívebb órákat.
                </p>


                <p>
                    A magasabb hőmérséklet
                    és a dinamikus gyakorlatok kombinációja
                    fejleszti az erőt,
                    az állóképességet és a testkontrollt.
                </p>

            </article>


        </div>

    </div>

</section>



<!-- =========================================================
     JELENTKEZÉS
========================================================= -->

<section
    class="section"
    id="signup"
>

    <div class="container">

        <div class="section-layout">


            <div class="section-content">


                <h2>
                    Jelentkezés
                </h2>


                <p>
                    Töltsd ki az alábbi űrlapot,
                    hogy be tudjuk regisztrálni,
                    melyik órán szeretnél részt venni.
                </p>



                <!-- =================================================
                     SIKERES JELENTKEZÉS
                ================================================== -->

                <?php if (
                    isset($_GET["status"])
                    &&
                    $_GET["status"] === "success"
                ): ?>

                    <div class="form-message success-message">

                        <strong>
                            Sikeres jelentkezés!
                        </strong>

                        <br>

                        Jelentkezésedet sikeresen rögzítettük.

                    </div>

                <?php endif; ?>



                <!-- =================================================
                     SIKERTELEN JELENTKEZÉS
                ================================================== -->

                <?php if (
                    isset($_GET["status"])
                    &&
                    $_GET["status"] === "error"
                ): ?>

                    <div class="form-message error-message">

                        <strong>
                            Sikertelen jelentkezés!
                        </strong>

                        <br>

                        <?=
                            htmlspecialchars(
                                $_GET["message"]
                                ?? "Kérlek, ellenőrizd a megadott adatokat!"
                            )
                        ?>

                    </div>

                <?php endif; ?>



                <!-- =================================================
                     JELENTKEZÉSI ŰRLAP
                ================================================== -->

                <form
                    class="contact-form"
                    action="form_handler.php"
                    method="POST"
                >


                    <!-- NÉV -->

                    <label for="name">
                        Név
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Teljes név"
                        maxlength="150"
                    >



                    <!-- ÓRATÍPUS -->

                    <label for="classType">
                        Óratípus
                    </label>

                    <select
                        id="classType"
                        name="classType"
                    >

                        <option value="">
                            Válassz
                        </option>


                        <?php foreach (
                            $oratipusok
                            as $oratipus
                        ): ?>

                            <option
                                value="<?= (int) $oratipus["id"] ?>"
                            >

                                <?=
                                    htmlspecialchars(
                                        $oratipus["nev"]
                                    )
                                ?>

                            </option>

                        <?php endforeach; ?>

                    </select>



                    <!-- NAP -->

                    <label for="day">
                        Nap
                    </label>

                    <select
                        id="day"
                        name="day"
                    >

                        <option value="">
                            Válassz
                        </option>


                        <?php foreach (
                            $napok
                            as $nap
                        ): ?>

                            <option
                                value="<?= (int) $nap["id"] ?>"
                            >

                                <?=
                                    htmlspecialchars(
                                        $nap["nev"]
                                    )
                                ?>

                            </option>

                        <?php endforeach; ?>

                    </select>



                    <!-- IDŐSÁV -->

                    <label for="timeSlot">
                        Idősáv
                    </label>

                    <select
                        id="timeSlot"
                        name="timeSlot"
                    >

                        <option value="">
                            Válassz
                        </option>


                        <?php foreach (
                            $idosavok
                            as $idosav
                        ): ?>

                            <option
                                value="<?= (int) $idosav["id"] ?>"
                            >

                                <?=
                                    htmlspecialchars(
                                        $idosav["idosav"]
                                    )
                                ?>

                            </option>

                        <?php endforeach; ?>

                    </select>



                    <!-- TAPASZTALAT -->

                    <label for="experience">

                        Voltál-e már korábban
                        bármilyen Pilates órán?

                    </label>

                    <select
                        id="experience"
                        name="experience"
                    >

                        <option value="">
                            Válassz
                        </option>


                        <?php foreach (
                            $tapasztalatok
                            as $tapasztalat
                        ): ?>

                            <option
                                value="<?= (int) $tapasztalat["id"] ?>"
                            >

                                <?=
                                    htmlspecialchars(
                                        $tapasztalat["valasz"]
                                    )
                                ?>

                            </option>

                        <?php endforeach; ?>

                    </select>



                    <!-- E-MAIL -->

                    <label for="email">
                        E-mail cím
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="pelda@email.com"
                        maxlength="150"
                    >



                    <!-- KÜLDÉS -->

                    <button type="submit">

                        Küldés

                    </button>


                </form>

            </div>



            <!-- JELENTKEZÉS KÉPE -->

            <div class="section-image">

                <img
                    src="goodday.png"
                    alt="Pilates motiváció"
                >

            </div>


        </div>

    </div>

</section>



<!-- =========================================================
     LEADOTT JELENTKEZÉSEK
========================================================= -->

<section
    class="section applications-section"
    id="applications"
>

    <div class="container">


        <h2>
            Leadott jelentkezések
        </h2>


        <p>
            Az alábbi táblázatban
            az adatbázisban tárolt jelentkezések láthatók.
        </p>



        <!-- Sikeres törlés visszajelzése -->

        <?php if (
            isset($_GET["delete"])
            &&
            $_GET["delete"] === "success"
        ): ?>

            <div class="form-message success-message">

                <strong>
                    Sikeres törlés!
                </strong>

                <br>

                A jelentkezést sikeresen töröltük.

            </div>

        <?php endif; ?>



        <?php if (
            count($jelentkezesek) > 0
        ): ?>


            <div class="table-wrapper">


                <table class="applications-table">


                    <thead>

                        <tr>

                            <th>Név</th>

                            <th>E-mail</th>

                            <th>Óratípus</th>

                            <th>Nap</th>

                            <th>Idősáv</th>

                            <th>Tapasztalat</th>

                            <th>Dátum</th>

                            <th>Művelet</th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php foreach (
                            $jelentkezesek
                            as $jelentkezes
                        ): ?>


                            <tr>


                                <td>
                                    <?= htmlspecialchars($jelentkezes["nev"]) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($jelentkezes["email"]) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($jelentkezes["oratipus"]) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($jelentkezes["nap"]) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($jelentkezes["idosav"]) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($jelentkezes["tapasztalat"]) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($jelentkezes["letrehozva"]) ?>
                                </td>


                                <td>


                                    <form
                                        action="delete.php"
                                        method="POST"
                                        class="delete-form"
                                        onsubmit="
                                            return confirm(
                                                'Biztosan törölni szeretnéd ezt a jelentkezést?'
                                            );
                                        "
                                    >


                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= (int) $jelentkezes["id"] ?>"
                                        >


                                        <button
                                            type="submit"
                                            class="delete-button"
                                        >

                                            Törlés

                                        </button>


                                    </form>


                                </td>


                            </tr>


                        <?php endforeach; ?>


                    </tbody>


                </table>


            </div>


        <?php else: ?>


            <p>
                Jelenleg még nincs leadott jelentkezés.
            </p>


        <?php endif; ?>


    </div>

</section>



<!-- =========================================================
     KAPCSOLAT
========================================================= -->

<section
    class="section"
    id="contact"
>

    <div class="container">

        <div class="section-layout">


            <div class="section-image">

                <img
                    src="FITNESS.jpeg"
                    alt="Kapcsolat"
                >

            </div>


            <div class="section-content">


                <h2>
                    Kapcsolat
                </h2>


                <p>
                    Ha nem tudod, melyik óratípus lenne számodra
                    a legmegfelelőbb,
                    vagy bármi egyéb kérdés merült fel benned,
                    vedd fel velünk a kapcsolatot!

                    Szívesen segítünk kiválasztani azt az órát,
                    amely leginkább megfelel
                    jelenlegi állapotodnak,
                    céljaidnak és tapasztalati szintednek.
                </p>


                <p>
                    A legfontosabb,
                    hogy olyan mozgásformát találj,
                    amelyet örömmel végzel –
                    a Pilates pedig minden szinten
                    lehetőséget kínál a fejlődésre.
                </p>


                <p>

                    📧 E-mail:

                    <a href="mailto:hello@pilateswithkata.hu">

                        hello@pilateswithkata.hu

                    </a>

                </p>


                <p>

                    📞 Telefon:

                    <a href="tel:+36301234567">

                        +36 30 123 4567

                    </a>

                </p>


            </div>

        </div>

    </div>

</section>


</main>



<!-- =========================================================
     LÁBLÉC
========================================================= -->

<footer class="site-footer">

    <div class="container">

        <p>

            &copy;
            <?= date("Y") ?>

            Pilates with Kata.
            Minden jog fenntartva.

        </p>

    </div>

</footer>



<!-- =========================================================
     VISSZA A TETEJÉRE
========================================================= -->

<button
    class="back-to-top"
    id="back-to-top"
    type="button"
    aria-label="Vissza a tetejére"
>

    ↑

</button>



<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

    /*
     * HTML elemek lekérése.
     */

    const toggle =
        document.getElementById(
            "menu-toggle"
        );


    const nav =
        document.getElementById(
            "main-nav"
        );


    const backToTop =
        document.getElementById(
            "back-to-top"
        );


    const navLinks =
        document.querySelectorAll(
            ".main-nav a"
        );



    /*
    |--------------------------------------------------------------------------
    | HAMBURGER MENÜ
    |--------------------------------------------------------------------------
    */

    toggle.addEventListener(
        "click",
        function () {


            nav.classList.toggle(
                "open"
            );


            toggle.classList.toggle(
                "active"
            );


            const isOpen =
                nav.classList.contains(
                    "open"
                );


            toggle.setAttribute(
                "aria-expanded",
                isOpen
                    ? "true"
                    : "false"
            );

        }
    );



    /*
    |--------------------------------------------------------------------------
    | MOBIL MENÜ BEZÁRÁSA LINKRE KATTINTÁSKOR
    |--------------------------------------------------------------------------
    */

    navLinks.forEach(
        function (link) {


            link.addEventListener(
                "click",
                function () {


                    nav.classList.remove(
                        "open"
                    );


                    toggle.classList.remove(
                        "active"
                    );


                    toggle.setAttribute(
                        "aria-expanded",
                        "false"
                    );

                }
            );

        }
    );



    /*
    |--------------------------------------------------------------------------
    | VISSZA A TETEJÉRE GOMB
    |--------------------------------------------------------------------------
    */

    window.addEventListener(
        "scroll",
        function () {


            if (
                window.scrollY > 400
            ) {

                backToTop.classList.add(
                    "visible"
                );

            } else {

                backToTop.classList.remove(
                    "visible"
                );

            }

        }
    );



    /*
     * Oldal tetejére görgetés.
     */
    backToTop.addEventListener(
        "click",
        function () {

            window.scrollTo({

                top: 0,

                behavior: "smooth"

            });

        }
    );

</script>


</body>

</html>