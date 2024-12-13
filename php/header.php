<?php

if (!isset($_SESSION['Ime'])) {
    header("location:index.php");
}
/**
 * Created by PhpStorm.
 * User: Josip
 * Date: 13.10.2017.
 * Time: 18.16
 */
?>
<!DOCTYPE html>
<html lang="RS">

<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <script type="text/javascript" src="../src/jquery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="../src/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
    <link href="../tailwind_o.css" rel="stylesheet">
    <title>Unisell</title>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="1440;url=http://unisell.rs/logout.php" />
    <script src="../src/js/funkcije.js"></script>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper blue lighten-5 z-depth-3">


                <ul class="left hide-on-mid-and-down">
                    <li id='Glavna'><a class="blue-text text-darken-5" href="main.php">Glavna</a></li>
                    <li id='Korisnici' class="<?php if ($_SESSION['tip'] == 4) {
                                                    echo "hide";
                                                } ?>"><a class="blue-text text-darken-5" href="korisnici.php">Korisnici</a></li>
                    <li id='Nalozi'><a class="blue-text text-darken-5" href="nalozi.php">Nalozi</a></li>
                    <li id='Magacin'><a class="blue-text text-darken-5" href="magacin.php">Magacin</a></li>
                    <li id='izvestaji' class="<?php if ($_SESSION['tip'] == 4) {
                                                    echo "hide";
                                                } ?>"><a class="blue-text text-darken-5" href="izvestaji.php">Izveštaji</a></li>
                    <li class="divider_h"> &nbsp; </li>
                    <li><span class="btn disabled">Ulogovan je : <?php echo (isset($_SESSION['Ime']) ? $_SESSION['Ime'] : "Neregistrovani korisnik"); ?> </span></li>
                    <li><a href="logout.php" class="btn">Izloguj se</a></li>
                    <li class="hide-on-small-only"><a href="javascript:history.go(-1)" class="btn red"><i class="material-icons">keyboard_backspace</i></a></li>
                </ul>
            </div>
        </nav>
    </div>