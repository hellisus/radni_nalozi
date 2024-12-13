<?php

/**
 * Created by PhpStorm.
 * User: josip
 * Date: 17.12.2018.
 * Time: 08:20
 */

require  'config.php';
if (!isset($_SESSION['Ime'])) {
    header("location:../index.php");
}


?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="../src/materialize/css/materialize.min.css">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../tailwind_o.css" rel="stylesheet">
    <script type="text/javascript" src="../src/jquery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="../src/css/style.css">
    <script src="../src/js/funkcije.js"></script>




    <title>SR NALOG</title>


    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../stylesheets/style.css" />
    <!-- Font Awesome JS 6 -->
    <script src="https://kit.fontawesome.com/e7c9d17f96.js" crossorigin="anonymous"></script>
    <!--Import jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../src/js/funkcije.js"></script>


</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php require_once 'sidebar.php' ?>

        <!-- Page Content  -->
        <div id="content">
            <!-- Topbar  -->
            <?php require_once 'topbar.php' ?>


            <div class="container main_content">
                <div class="col s12 center">
                    <div class="row main_content">
                        <h3 class="center sekcija">Nalozi tipa <?php echo $_GET['tip'] ?></h3>
                    </div>
                </div>


                <?php
                //selektuj sve unikatne brojeve pristilih naloga
                $podatci2 = new CRUD();
                $podatci2->table = "nalozi";
                $nalog = $podatci2->select(['*'], ['*'], "SELECT br_naloga, status_id, kome_zaduzen, tip_naloga, vreme_prijema, adresa, komentar, datum_zakazan, vreme_zakazan  FROM `nalozi` WHERE status_id = 1 AND tip_naloga ='" . $_GET['tip'] . "'");
                foreach ($nalog as $podatak_nalog) : ?>
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header blue text-white rounded-md"><?php echo "Nalog " . $podatak_nalog['br_naloga'] . " -  " . $podatak_nalog['tip_naloga'] . " - " . $podatak_nalog['adresa'] . " - Pristigao: " . $podatak_nalog['vreme_prijema'];
                                                                                        if ($podatak_nalog['kome_zaduzen'] > 0) {
                                                                                            $ko_korisnik = new CRUD();
                                                                                            $ko_korisnik->table = "korisnici";
                                                                                            $nadjen_korisnik = $ko_korisnik->select(['ime', 'prezime'], ['id' => $podatak_nalog['kome_zaduzen']]);
                                                                                            echo  " - dodeljen: " .  $nadjen_korisnik[0]['ime'] . " " . $nadjen_korisnik[0]['prezime'];
                                                                                        };
                                                                                        ?></div>
                            <div class="collapsible-body white rounded-md">

                                <div class="row">
                                    <form class="col s12">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">info</i>
                                                <input class="black-text" id="tip_naloga" type="text" value="<?php echo $podatak_nalog['tip_naloga']; ?>" disabled>
                                                <label for="tip_naloga">Vrsta naloga</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">account_circle</i>
                                                <input class="black-text" id="kupac" type="tel" value="<?php echo $podatak_nalog['kupac']; ?>" disabled>
                                                <label for="kupac">Kupac</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">update</i>
                                                <input class="black-text" id="datum_prijema" type="text" value="<?php echo $podatak_nalog['vreme_prijema']; ?>" disabled>
                                                <label for="datum_prijema">Vreme prijema</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">phone</i>
                                                <input class="black-text" id="telefoni" type="tel" value="<?php echo $podatak_nalog['telefon']; ?>" disabled>
                                                <label for="telefoni">Kontakt telefoni</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">event available</i>
                                                <input class="black-text datepicker" id="datum_zakazan<?php echo $podatak_nalog['br_naloga']; ?>" type="text" value="<?php echo $podatak_nalog['datum_zakazan']; ?>">
                                                <label for="datum_zakazan<?php echo $podatak_nalog['br_naloga']; ?>">Datum zakazan</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">notifications active</i>
                                                <input class="black-text timepicker" id="vreme_zakazan<?php echo $podatak_nalog['br_naloga']; ?>" type="text" value="<?php echo $podatak_nalog['vreme_zakazan']; ?>">
                                                <label for="vreme_zakazan<?php echo $podatak_nalog['br_naloga']; ?>">Vreme zakazan</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class=" col s12 z-depth-1 btn green darken-2 white-text waves-effect" onclick="snimi_zakazivanje(<?php echo $podatak_nalog['br_naloga']; ?>)"><i class="material-icons left">done</i>Snimi zakazano</div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">forward</i>
                                                <select onchange="selektujStatus(this.options[this.selectedIndex].value, <?php echo $podatak_nalog['br_naloga']  ?>)">
                                                    <option value="1" <?php if ($podatak_nalog['status_id'] == 1) {
                                                                            echo 'selected';
                                                                        }; ?>>Pristigao</option>
                                                    <option value="2" <?php if ($podatak_nalog['status_id'] == 2) {
                                                                            echo 'selected';
                                                                        }; ?>>U radu</option>
                                                    <option value="3" <?php if ($podatak_nalog['status_id'] == 3) {
                                                                            echo 'selected';
                                                                        }; ?>>Završen na terenu</option>
                                                    <option value="4" <?php if ($podatak_nalog['status_id'] == 4) {
                                                                            echo 'selected';
                                                                        }; ?>>Završen</option>
                                                    <option value="5" <?php if ($podatak_nalog['status_id'] == 5) {
                                                                            echo 'selected';
                                                                        }; ?>>Otkazan</option>
                                                </select>
                                            </div>
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">person outline</i>
                                                <select onchange="selektujKorisnika_prijem(this.options[this.selectedIndex].value, <?php echo $podatak_nalog['br_naloga']  ?>)">
                                                    <option value=0 <?php if ($podatak_nalog['kome_zaduzen'] == 0) {
                                                                        echo 'selected';
                                                                    }; ?>>Nije zadužen</option>
                                                    <option value=1 <?php if ($podatak_nalog['kome_zaduzen'] == 1) {
                                                                        echo 'selected';
                                                                    }; ?>>Josip Mihajlović</option>
                                                    <option value=7 <?php if ($podatak_nalog['kome_zaduzen'] == 7) {
                                                                        echo 'selected';
                                                                    }; ?>>Milorad Radonjić</option>
                                                    <option value=8 <?php if ($podatak_nalog['kome_zaduzen'] == 8) {
                                                                        echo 'selected';
                                                                    }; ?>>Tanja Đurić Radonjić</option>
                                                    <option value=9 <?php if ($podatak_nalog['kome_zaduzen'] == 9) {
                                                                        echo 'selected';
                                                                    }; ?>>Danka Mitrović</option>
                                                    <option value=11 <?php if ($podatak_nalog['kome_zaduzen'] == 11) {
                                                                            echo 'selected';
                                                                        }; ?>>Aleksandar Savić</option>
                                                    <option value=12 <?php if ($podatak_nalog['kome_zaduzen'] == 12) {
                                                                            echo 'selected';
                                                                        }; ?>>Marijana Jovičin</option>
                                                    <option value=13 <?php if ($podatak_nalog['kome_zaduzen'] == 13) {
                                                                            echo 'selected';
                                                                        }; ?>>Siniša Vidović</option>
                                                    <option value=14 <?php if ($podatak_nalog['kome_zaduzen'] == 14) {
                                                                            echo 'selected';
                                                                        }; ?>>Milan Popović</option>
                                                    <option value=15 <?php if ($podatak_nalog['kome_zaduzen'] == 15) {
                                                                            echo 'selected';
                                                                        }; ?>>Aleksandar Radivojević</option>
                                                    <option value=16 <?php if ($podatak_nalog['kome_zaduzen'] == 16) {
                                                                            echo 'selected';
                                                                        }; ?>>Borislav Nikolić</option>
                                                    <option value=17 <?php if ($podatak_nalog['kome_zaduzen'] == 17) {
                                                                            echo 'selected';
                                                                        }; ?>>Marko Bjelivuk</option>
                                                    <option value=19 <?php if ($podatak_nalog['kome_zaduzen'] == 19) {
                                                                            echo 'selected';
                                                                        }; ?>>Dražen Đurić</option>
                                                    <option value=20 <?php if ($podatak_nalog['kome_zaduzen'] == 20) {
                                                                            echo 'selected';
                                                                        }; ?>>Milko Grbić</option>
                                                    <option value=21 <?php if ($podatak_nalog['kome_zaduzen'] == 21) {
                                                                            echo 'selected';
                                                                        }; ?>>Miodrag Savić</option>
                                                    <option value=22 <?php if ($podatak_nalog['kome_zaduzen'] == 22) {
                                                                            echo 'selected';
                                                                        }; ?>>Milorad Delić</option>
                                                    <option value=23 <?php if ($podatak_nalog['kome_zaduzen'] == 23) {
                                                                            echo 'selected';
                                                                        }; ?>>Predrag Tepša</option>
                                                    <option value=25 <?php if ($podatak_nalog['kome_zaduzen'] == 25) {
                                                                            echo 'selected';
                                                                        }; ?>>Denis Vaštag</option>
                                                    <option value=26 <?php if ($podatak_nalog['kome_zaduzen'] == 26) {
                                                                            echo 'selected';
                                                                        }; ?>>Goran Janjoš</option>
                                                    <option value=27 <?php if ($podatak_nalog['kome_zaduzen'] == 27) {
                                                                            echo 'selected';
                                                                        }; ?>>Damir Ljubobratović</option>
                                                    <option value=28 <?php if ($podatak_nalog['kome_zaduzen'] == 28) {
                                                                            echo 'selected';
                                                                        }; ?>>Nikola Igrić</option>
                                                    <option value=29 <?php if ($podatak_nalog['kome_zaduzen'] == 29) {
                                                                            echo 'selected';
                                                                        }; ?>>Miloš Kalinić</option>
                                                    <option value=30 <?php if ($podatak_nalog['kome_zaduzen'] == 30) {
                                                                            echo 'selected';
                                                                        }; ?>>Goran Lalić</option>
                                                    <option value=31 <?php if ($podatak_nalog['kome_zaduzen'] == 31) {
                                                                            echo 'selected';
                                                                        }; ?>>Rade Simičić</option>
                                                    <option value=33 <?php if ($podatak_nalog['kome_zaduzen'] == 33) {
                                                                            echo 'selected';
                                                                        }; ?>>Radovan Živković</option>
                                                    <option value=37 <?php if ($podatak_nalog['kome_zaduzen'] == 37) {
                                                                            echo 'selected';
                                                                        }; ?>>Marko Bilač</option>
                                                    <option value=43 <?php if ($podatak_nalog['kome_zaduzen'] == 43) {
                                                                            echo 'selected';
                                                                        }; ?>>Ivan Papuga</option>
                                                    <option value=45 <?php if ($podatak_nalog['kome_zaduzen'] == 45) {
                                                                            echo 'selected';
                                                                        }; ?>>Marko Tomić</option>
                                                    <option value=47 <?php if ($podatak_nalog['kome_zaduzen'] == 47) {
                                                                            echo 'selected';
                                                                        }; ?>>Zoran Mirković</option>
                                                    <option value=48 <?php if ($podatak_nalog['kome_zaduzen'] == 48) {
                                                                            echo 'selected';
                                                                        }; ?>>Lazar Stevanovski</option>
                                                    <option value=50 <?php if ($podatak_nalog['kome_zaduzen'] == 50) {
                                                                            echo 'selected';
                                                                        }; ?>>Nikola Simić</option>
                                                    <option value=51 <?php if ($podatak_nalog['kome_zaduzen'] == 51) {
                                                                            echo 'selected';
                                                                        }; ?>>Nikola Radović</option>
                                                    <option value=53 <?php if ($podatak_nalog['kome_zaduzen'] == 53) {
                                                                            echo 'selected';
                                                                        }; ?>>Milan Pavlović</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">place</i>
                                                <input class="black-text" id="adreasa" type="text" value="<?php echo $podatak_nalog['adresa']; ?>" disabled>
                                                <label for="adreasa">Adresa</label>
                                            </div>

                                            <div class="row">
                                                <form class="col s12">
                                                    <div class="row">
                                                        <div class="input-field col s12 komentari">
                                                            <i class="material-icons prefix">format_align_left</i>
                                                            <textarea id="komentar_fix_<?php echo $podatak_nalog['br_naloga']; ?>" class="materialize-textarea komentari" disabled><?php echo $podatak_nalog['komentar']; ?></textarea>
                                                            <label for="komentar_fix_<?php echo $podatak_nalog['br_naloga']; ?>">Komentari</label>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="row">
                                                <form class="col s12">
                                                    <div class="row">
                                                        <div class="input-field col s12 komentar">
                                                            <i class="material-icons prefix">mode_edit</i>
                                                            <textarea id="komentar<?php echo $podatak_nalog['br_naloga']; ?>" class="materialize-textarea"></textarea>
                                                            <label for="komentar<?php echo $podatak_nalog['br_naloga']; ?>">Komentar unos</label>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                            <div class="row">
                                                <div class=" col s12 z-depth-1 btn green darken-2 white-text waves-effect" onclick="snimi_komentar(<?php echo "'" . $podatak_nalog['br_naloga'] . "','" . $_SESSION['Ime'] . "','" . $_SESSION['Prezime'] . "','" . date('Y-m-d H:i:s') . "'"; ?>)"><i class="material-icons left">done</i>Snimi komentar</div>
                                            </div>
                                            <div class="row">
                                                <form class="col s12">
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <i class="material-icons prefix">dehaze</i>
                                                            <textarea id="tekst_mejla" class="materialize-textarea tekst_mejla"><?php echo $podatak_nalog['info']; ?></textarea>
                                                            <label for="tekst_mejla">Sadržaj naloga</label>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                    </form>
                                </div>

                            </div>
                        </li>
                    </ul>
                <?php endforeach; ?>
            </div>


            <!--Import jQuery before materialize.js-->
            <script type="text/javascript" src="../src/jquery/jquery-3.2.1.min.js"></script>
            <script src="../src/materialize/js/materialize.min.js"></script>
            <!-- Replace the value of the key parameter with your own API key. -->

            <script>
                $('.datepicker').pickadate({
                    monthsFull: ['Januar', 'Februar', 'Mart', 'April', 'Maj', 'Jun', 'Jul', 'Avgust', 'Septembar', 'Oktobar', 'Novembar', 'Decembar'],
                    monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Avg', 'Sep', 'Okt', 'Nov', 'Dec'],
                    weekdaysFull: ['Nedelja', 'Ponedeljak', 'Utorak', 'Sreda', 'Četvrtak', 'Petak', 'Subota'],
                    weekdaysShort: ['Ned', 'Pon', 'Uto', 'Sre', 'Čet', 'Pet', 'Sub'],
                    labelMonthNext: 'Sledeći mesec',
                    labelMonthPrev: 'Predhodni mesec',
                    labelMonthSelect: 'Izaberi mesec',
                    labelYearSelect: 'Izaberi godinu',
                    format: 'dd/mm/yyyy',
                    max: false,
                    selectMonths: true, // Creates a dropdown to control month
                    today: 'Danas',
                    clear: 'Obriši',
                    close: 'Ok',
                    closeOnSelect: true, // Close upon selecting a date,
                    formatSubmit: 'Y-m-d'
                });
            </script>
            <script>
                $('.tekst_mejla').click(function() {
                    $(this).trigger('autoresize');
                });

                function rere() {
                    $('.komentari').trigger('autoresize');
                }

                $('.komentari').click(function() {
                    $(this).trigger('autoresize')
                });


                $(document).ready(function() {
                    $('select').material_select();
                    setTimeout(rere, 2000);
                });

                $('.timepicker').pickatime({
                    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
                    fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
                    twelvehour: false, // Use AM/PM or 24-hour format
                    donetext: 'OK', // text for done-button
                    cleartext: 'Obriši', // text for clear-button
                    canceltext: 'Otkaži', // Text for cancel-button
                    autoclose: true, // automatic close timepicker
                    ampmclickable: false // make AM PM clickable
                });
            </script>
</body>

</html>