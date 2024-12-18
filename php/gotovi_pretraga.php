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

            <?php
            $od = $_GET['od'];
            $do = $_GET['do'];



            $podatci = new CRUD();
            $podatci->table = "nalozi";
            $nalog = $podatci->select(['*'], ['*'], "SELECT * FROM `nalozi` WHERE datum_zavrsen BETWEEN '" . $_GET['od'] . "' AND '" . $_GET['do'] .  "' AND status_id = 4 ORDER BY " . "datum_zavrsen DESC"); ?>

            <div class="containter relative overflow-x-auto shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left text-gray-500 " id="tabela">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">Broj naloga</th>
                            <th scope="col" class="px-6 py-3">Tip naloga</th>
                            <th scope="col" class="px-6 py-3">Vreme prijema</th>
                            <th scope="col" class="px-6 py-3">Datum završen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nalog as $podatak_nalog) : ?>
                            <tr class="bg-white border-2 border-black">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "> <?= $podatak_nalog['br_naloga'] ?> </th>
                                <th>
                                    <h4><?= $podatak_nalog['tip_naloga'] ?></h4>
                                </th>

                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    <h4><?= $podatak_nalog['vreme_prijema'] ?></h4>
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    <h4><?= $podatak_nalog['datum_zavrsen'] ?></h4>
                                </th>

                            </tr>
                        <?php endforeach; ?>


            </div>

            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" onclick='tableToExcel({table:document.getElementById("tabela"), worksheet:"Završeni nalozi",filename:"Završeni_nalozi.xls"});'>Snimi u eksel</button>







        </div>
        <div class="input-field col s12" id="rez">
        </div>
    </div> <!-- Page Content  -->


    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
            $('#pretraga_id').on('keypress', function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    var id_naloga = $('#pretraga_id').val();
                    window.location.replace(
                        "../php/nalog_izmena.php?nalog_id=" + "SR" + id_naloga
                    );
                }
            });



        });
    </script>
</body>

</html>