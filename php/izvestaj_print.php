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


    <title>Štampanje naloga</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../stylesheets/style.css" />
    <link rel="stylesheet" href="../src/css/print.css" />
    <link href="../tailwind_o.css" rel="stylesheet">

    <!-- Font Awesome JS 6 -->
    <script src="https://kit.fontawesome.com/e7c9d17f96.js" crossorigin="anonymous"></script>

    <!--Import jQuery before materialize.js-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/funkcije.js"></script>

</head>

<body>
    <div id="d-print-none"><button  class="btn btn-success btn-lg ok d-print-none m-1" onclick="to_main()">Povratak</button></div>

    <div class="wrapper">

        <!-- Page Content  -->
        <div id="content">
            <!-- Topbar  -->


            <div class="containter">

                <div class="flex flex-grow flex-column justify-content-center align-items-center bg-white shadow-md rounded mx-auto pt-6 pb-8 mb-4 max-w-full">
                    <div> 
                        <img src="../img/logo.png" alt="Logo" class="max-h-32">
                    </div>
                    <h1 class="center sekcija text-xl p-5">NALOG BROJ <?php echo $_GET['id']; ?>

                    </h1>

                    <div class="print:text-black grid ">
                    <?php
                    $podatci = new CRUD();
                    $podatci->table = "nalozi";
                    $nalog = $podatci->select(['*'], ['*'], "SELECT * FROM `nalozi` WHERE br_naloga ='" . $_GET['id'] . "'"); ?>

                        <div class="form-group row">
                            <div class="input-field col s12 text-l">
                                <label for="tip_naloga" class="col-form-label"> Tip Naloga :</label>
                                <input class="form-control text-l" id="tip_naloga" name="tip_naloga" type="text" value=<?php
                                                                                                            echo "'" . $nalog[0]['tip_naloga']. "'";
                                                                                                            ?>>
                            </div>
                            <div class="input-field col s12 text-l">
                                <label for="direkcija" class="col-form-label">Direkcija :</label>
                                <input class="form-control text-l" id="direkcija" name="direkcija" type="text"  value=<?php echo "'" . $nalog[0]['direkcija']. "'";?>>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-field col s6 text-l">
                                <label for="adresa" class="col-form-label">Adresa lokacije :</label>
                                <input class="form-control text-l" id="adresa" name="adresa" type="text" value=<?php
                                                                                                     echo "'" . $nalog[0]['adresa']. "'";
                                                                                                    ?>>
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="input-field col s6 text-l">
                                <label for="region" class="col-form-label">Region :</label>
                                <input class="form-control text-l" id="region" name="region" type="text"  value=<?php
                                                                                                    echo "'" . $nalog[0]['region']. "'";
                                                                                                                            ?>>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="input-field col s12">
                                <label for="noapomena" class="col-form-label">NAPOMENA: </label>
                                <textarea class="form-control" id="noapomena" name="noapomena" rows="10" cols="40"><?php
                                                                                                               echo $nalog[0]['napomena'];
                                                                                                                ?></textarea>
                            </div>
                            </div>

                        <div class="form-group row">
      
                            <div class="input-field col s6 text-l">
                                <label for="ko_kreira" class="col-form-label">Nalog kreirao/la:</label>
                                <input class="form-control text-l" id="ko_kreira" name="ko_kreira" type="text"  value=<?php
                                                                                                    echo "'" . $nalog[0]['ko_kreira']. "'";
                                                                                                                            ?>>
                            </div>
               



                        <div class="form-group row">

                            </div>
                            <div class="input-field col s6">
                                <label for="kad_kreiran" class="col-form-label">Datum naloga :</label>
                                <input class="form-control text-l" id="kad_kreiran" name="kad_kreiran" type="text"   value=<?php
                                                                                                                            echo "'" . $nalog[0]['kad_kreiran']. "'";
                                                                                                                            ?>>
                            </div>
                        </div>




                  
                       
                    </div>



                </div><!-- containter -->
            </div> <!-- content -->


            <script type="text/javascript">
                $(document).ready(function() {
                    $('#sidebarCollapse').on('click', function() {
                        $('#sidebar').toggleClass('active');
                    });
                    window.print()
                });
            </script>
</body>

</html>