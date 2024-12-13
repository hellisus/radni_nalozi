<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="RS">

<head>
    <!--Import bootstrap.css-->
    <title>Sr Nalozi --- Greška</title>
    <meta charset="UTF-8">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../tailwind_o.css" rel="stylesheet">
    <script src="../src/js/funkcije.js"></script>
</head>

<body>

    <div class="grid grid-cols-1 grid-rows-1 items-center h-screen justify-items-center">
        <div
            class="mx-auto my-auto grid grid-cols-1 justify-items-center bg-neutral-300 px-5 py-8 rounded-lg font-sans shadow-2xl border-2 border-sky-300">
            <img src="../img/img.png" alt="SR" class="max-h-52 mx-auto">

            <h5 class="pt-6 text-4xl text-white font-semibold">SR NALOZI</h5>
            <h1 class="pt-3 text-xl font-semibold">Pogrešno korisničko ime ili lozinka</h1>
            <p class="pb-3 text-xl font-semibold">Pokušajte ponovo</p>
            <button
                class="px-4 py-1 bg-neutral-100 text-sm font-semibold rounded-full border  border-sky-300 hover:text-white hover:border-sky-300 hover:border-transparent hover:bg-sky-300 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2"
                onclick="to_hp()">Povratak na unos korisničkog imena i lozinke </button>
        </div>
    </div>




</body>

</html>