<?php
require 'php/config.php';
?>

//indeks stranica izmena

<!DOCTYPE html>
<html lang="RS">

<head>
    <title>Radni Nalozi --- Prijava na sistem</title>
    <meta charset="UTF-8">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./tailwind_o.css" rel="stylesheet">
</head>

<body>

    <div class="grid grid-cols-1 grid-rows-1 items-center h-screen justify-items-center">
        <div class="mx-auto my-auto grid grid-cols-1 justify-items-center bg-neutral-300 px-5 py-8 rounded-lg font-sans shadow-2xl border-2 border-sky-300">
            <img src="./img/img.png" alt="SR" class="max-h-52 mx-auto">

            <h5 class="pt-6 text-4xl text-white font-semibold">RADNI NALOZI</h5>
            <p class="pt-4 text-white">Prijavite se na sistem</p>
            <p class="pb-3 text-white">Unesite svoje korisničko ime i lozinku</p>

            <form action="php/credproces.php" method="POST" class="w-full max-w-sm">
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label for="uid" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="uid">Nalog : </label>
                    </div>

                    <div class="md:w-2/3">
                        <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded
                            w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white
                            focus:border-blue-500" id="uid" name="uid" placeholder="Naziv naloga">
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label for="pwd" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">Lozinka :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input type="password"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            id="pwd" name="pwd" placeholder="Lozinka">
                    </div>
                </div>

                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Prijavi se
                        </button>
                    </div>
                </div>


            </form>
        </div>
    </div>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="dep/jquery/jquery-3.6.0.min.js"></script>



</body>

</html>