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
    <meta http-equiv="refresh" content="21600;url=../php/logout.php" />


    <title>RORP - Unos pacijenta</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../stylesheets/style.css" />

    <!-- Font Awesome JS 6 -->
    <script src="https://kit.fontawesome.com/e7c9d17f96.js" crossorigin="anonymous"></script>

    <!--Import jQuery before materialize.js-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/funkcije.js"></script>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php require_once 'sidebar.php' ?>

        <!-- Page Content  -->
        <div id="content">
            <!-- Topbar  -->
            <?php require_once 'topbar.php' ?>
            <div class="containter">

                <div class="d-flex flex-column justify-content-center align-items-center">

                    <h3 class="center sekcija">Izaberrite mesec <i class="fa-solid fa-calendar-days"></i></h3> <br>

                    <form method="POST" id="forma">

                        <div class="form-group row">
                            <div class="input-field col s12">
                                <label for="mesec" class="col-form-label">

                                    MESEC : </label>
                                <select class="form-control col s12" id="mesec" name="mesec">
                                    <option value="0" selected>IZABERITE</option>
                                    <option value="1">Januar</option>
                                    <option value="2">Februar</option>
                                    <option value="3">Mart</option>
                                    <option value="4">April</option>
                                    <option value="5">Maj</option>
                                    <option value="6">Jun</option>
                                    <option value="7">Jul</option>
                                    <option value="8">Avgust</option>
                                    <option value="9">Septembar</option>
                                    <option value="10">Oktobar</option>
                                    <option value="11">Novembar</option>
                                    <option value="12">Decembar</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-field col s6">
                                <div class="btn btn-success btn-lg ok" onclick="napravi_izvestaj_za_mesec()"> <i
                                        class="fas fa-plus-square"></i>
                                    Izaberi
                                </div>
                            </div>
                            <div class="input-field col s6">
                                <a href="mesto_troska.php" class="btn btn-danger btn-lg" onclick="back_main()"><i
                                        class="fas fa-ban"></i>
                                    Otkaži</a>
                            </div>
                        </div>
                    </form>





                    <div class="line"></div>
                    <div id="results"></div>




                </div><!-- containter -->
            </div> <!-- content -->


            <script type="text/javascript">
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });
            });
            </script>

</body>

</html>