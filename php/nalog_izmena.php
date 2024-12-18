<?php
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
    <link href="../tailwind_o.css" rel="stylesheet">

    <title>SR NALOG</title>


    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../stylesheets/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
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

            <div class="mx-auto bg-white p-16">
                <div class="col s12 center">
                    <div class="row main_content">
                        <h3 class="text-center text-3xl mb-5">SR NALOG <?php echo $_GET['nalog_id'] ?></h3>
                    </div>
                </div>

                <div>
                    <?php
                    $podatci2 = new CRUD();
                    $podatci2->table = "nalozi";
                    $nalog = $podatci2->select(['*'], ['*'], "SELECT * FROM `nalozi` WHERE br_naloga = '" . $_GET['nalog_id'] . "'");
                    $i = 0;
                    foreach ($nalog as $podatak_nalog) : ?>

                        <div id="accordion-collapse-body-<?php echo $podatak_nalog['br_naloga'] ?>" aria-labelledby="accordion-collapse-heading-<?php echo $podatak_nalog['br_naloga'] ?>">

                            <div class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-200 border-b-0">
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label for="tip_naloga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tip naloga</label>
                                        <input type="text" id="tip_naloga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $podatak_nalog['tip_naloga'] ?>" >
                                    </div>
                                    <div>
                                        <label for="direkcija" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direkcija</label>
                                        <input type="text" id="direkcija" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $podatak_nalog['direkcija'] ?>" >
                                    </div>
                                    <div>
                                        <label for="adresa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresa</label>
                                        <input type="text" id="adresa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $podatak_nalog['adresa'] ?>" >
                                    </div>
                                    <div>
                                        <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region</label>
                                        <input type="text" id="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $podatak_nalog['region'] ?>" >
                                    </div>
                                    <div>
                                        <label for="mejl_slanja" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mejl sa koga je poslat nalog</label>
                                        <input type="text" id="mejl_slanja" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $podatak_nalog['mejl_slanja'] ?>" disabled>
                                    </div>
                                    <div>
                                        <label for="vreme_prijema" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vreme prijema naloga</label>
                                        <input type="text" id="vreme_prijema" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php $datum_arr = explode("-", $podatak_nalog['vreme_prijema']);
                                                                                                                                                                                                                                                                                                                                                                    echo substr($datum_arr[2], 0, 2) . "." . $datum_arr[1] . "." . $datum_arr[0] . substr($datum_arr[2], 2, 9)
                                                                                                                                                                                                                                                                                                                                                                    ?>" disabled>
                                    </div>
                                    <div>
                                        <label for="vreme_kreiranja" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vreme kreiranja</label>
                                        <input type="text" id="vreme_kreiranja" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $podatak_nalog['kad_kreiran'] ?>" disabled>
                                    </div>
                                    <div>
                                        <label for="ko_kreira" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kreator naloga</label>
                                        <input type="text" id="ko_kreira" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $podatak_nalog['ko_kreira'] ?>" disabled>
                                    </div>
                                    <div>
                                        <label for="datum_zakazan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Datum zakazan</label>
                                        <input datepicker type="text" id="datum_zakazan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php
                                                                                                                                                                                                                                                                                                                                                                            $datumZaFormu_niz = explode("-", $podatak_nalog['datum_zakazan']);
                                                                                                                                                                                                                                                                                                                                                                            $datumZaFormu = $datumZaFormu_niz[1] . "/" . $datumZaFormu_niz[2] . "/" . $datumZaFormu_niz[0];
                                                                                                                                                                                                                                                                                                                                                                            echo $datumZaFormu ?>">
                                    </div>
                                    <div>
                                        <label for="vreme_zakazan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vreme zakazan</label>
                                        <input type="text" id="vreme_zakazan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $podatak_nalog['vreme_zakazan'] ?>">
                                    </div>
                                    <div>
                                        <label for="status_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status naloga</label>
                                        <select id="status_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                            <?php
                                            $podatci3 = new CRUD();
                                            $podatci3->table = "status_šifranik";
                                            $statusi = $podatci2->select(['*'], ['*'], "SELECT * FROM `status_šifranik` ");
                                            foreach ($statusi as $status) : ?>
                                                <option <?php if ($podatak_nalog['status_id'] == $status['id']) {
                                                            echo "selected";
                                                        }; ?> value="<?php echo $status['id']; ?>"><?php echo $status['opis']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="kome_zaduzen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zadužen na</label>
                                        <select id="kome_zaduzen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected value=0> --- </option>
                                            <?php
                                            $podatci3 = new CRUD();
                                            $podatci3->table = "korisnici";
                                            $korisnici = $podatci2->select(['*'], ['*'], "SELECT * FROM `korisnici` ");
                                            foreach ($korisnici as $korisnik) : ?>
                                                <option <?php if ($podatak_nalog['kome_zaduzen'] == $korisnik['id']) {
                                                            echo "selected";
                                                        }; ?> value="<?php echo $korisnik['id']; ?>"><?php echo $korisnik['ime'] . " " . $korisnik['prezime']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="napomena" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Napomena</label>
                                        <textarea cols="40" rows="5" id="napomena" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?php echo $podatak_nalog['napomena'] ?></textarea>
                                    </div>

                                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="snimi_izmene(<?php echo  $podatak_nalog['nalozi_id']; ?>)">Snimi izmene</button>
                                    <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="to_main()">Odustani</button>

                                </div>
                            </div>


                        </div>

                        <?php $i++; ?>
                        <!-- Kraj tela -->
                    <?php endforeach; ?>
                </div>

                <div id="rez"></div>

                <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
                <!--Import jQuery before materialize.js-->
                <script type="text/javascript" src="../src/jquery/jquery-3.2.1.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.js"></script>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#sidebarCollapse').on('click', function() {
                            $('#sidebar').toggleClass('active');
                        });



                    });
                </script>

            </div>
        </div>
    </div>

</body>