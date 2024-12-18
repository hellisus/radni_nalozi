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
                        <h3 class="text-center text-3xl mb-5">Unesite adresu ili deo adrese za pretragu</h3>
                    </div>
                </div>

                <div>
                    <label for="pretraga_adresa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Termin za pretragu</label>
                    <input type="text" id="pretraga_adresa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-5" value="">
                </div>
                <div class="col-span-2">
                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="pretrazi_adresu()">Pretraži</button>
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

            </div>
        </div>
    </div>

</body>